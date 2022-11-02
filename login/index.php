<?php 

session_start();

require_once "config.php";
require_once RAIZ . "/conexao.php";
require_once RAIZ . "/class/User.php";

if(isset($_SESSION['logado'])) {
    header('Location: newpost.php');
}

$message = array();

$select = "SELECT * FROM users";
$query = mysqli_query($conexao, $select);

if(mysqli_num_rows($query) == 0) {
    $hash = password_hash('admin', PASSWORD_DEFAULT);

    $insert = "INSERT INTO users (id_user, name_user, email_user, user, password, adm)
                    VALUES (1, 'admin', '-', 'admin', '$hash', 1)";
    
    $query = mysqli_query($conexao, $insert);
}

if (isset($_POST["login"])){
    
    $usuario = filter_input(INPUT_POST, "usuario");        
    $senha = filter_input(INPUT_POST, "senha");

    if (empty($usuario) || empty($senha)) {        
        $message[] = "Preencha o usuário e senha para realizar o login.";
        print_r(end($message));
    }
    else {        
        $user = new User;
        $user->loginUser($usuario, $senha);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet">
    
    <!-- BOOTSTRAP -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    
    <style>
        *{
            font-family: Roboto;
        }
        body{
            background-color: #e2e2e2;
        }
        .container{
            height: 100vh;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }
        .login{
            margin: auto;
            background-color: #fff;
            border: 1px solid black;
            display: block;
            padding: 50px;
            border-radius: 15px;
            border: 2px solid #cccccc;
        }
        label{
            font-size: 1.3em;
        }
        .form-group input{
            width: 300px;
        }
        button{
            width: 300px;
        }
        .login a{
            text-decoration: none;
            color: #6e6e6e;
            font-weight: bold;
        }
        .login a:hover{
            text-decoration: none;
            color: black;
        }
    </style>
</head>


<body>
    <div class="container">
        <center>
            <div class="login">
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Usuário</label>
                        <input type="text" name="usuario" class="form-control" placeholder="Digite o usuário">
                    </div><br>
    
                    <div class="form-group">
                        <label>Senha</label>
                        <input  type="password" name="senha" class="form-control" placeholder="Digite a senha">
                    </div><br>
            
                    <button type="submit" name="login" class="btn btn-primary" >Login</button>
                </form>
                <br>
                <p>
                    <a href="">Perdeu a senha?</a>
                </p>
            </div>
        </center>
    </div>
</body>
</html>