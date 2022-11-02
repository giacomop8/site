<?php

class User {

    private $nome;
    private $email;
    private $usuario;
    private $senha;
    private $adm;

    public function createUser($nome, $email, $usuario, $senha, $adm) {
        include RAIZ ."/conexao.php";

        $this->nome = $nome;
        $this->email = $email;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->adm = $adm;

        $insert = "INSERT INTO users (name_user, email_user, user, password, adm)
                    VALUES ('$nome', '$email', '$usuario', '$senha', '$adm')";

        $result = mysqli_query($conexao, $insert);
        mysqli_close($conexao);
        header("Location: newuser.php");

    }

    public function loginUser($usuario, $senha) {
        include RAIZ ."/conexao.php";

        $this->usuario = $usuario;
        $this->senha = $senha;
        
        $search = "SELECT * FROM users WHERE user='$usuario'";
        $result = mysqli_query($conexao, $search);
        
        /* COMPARANDO O USUARIO COM O BANCO DE DADOS */
        if(mysqli_num_rows($result) > 0) {
            $this->verifyPassword($result, $senha);
        }
        else {
            echo "Usuário ou senha não conferem /// USUARIO ERRADO OU NAO CONFERE";
        }
    }

    private function verifyPassword($result, $senha) {
        include RAIZ ."/conexao.php";
        $dados = mysqli_fetch_row($result);
        $password = $dados[4];

        if ($dados && password_verify($senha, $password)) {
            $_SESSION["logado"] = true;
            $_SESSION["usuario"] = $dados[3];
            mysqli_close($conexao);
            header("Location:http://localhost/projetos/site_raiz/login/newuser.php");
        } else {
            echo "Usuário ou senha não conferem /// SENHA ERRADA <br>";
        }
    }
}