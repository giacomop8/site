<?php

include_once "config.php";
include_once RAIZ . "/conexao.php";
include_once RAIZ . "/class/User.php";
include_once RAIZ . "/class/Post.php";

session_start();

$message = array();

/* VERIFICANDO SE ESTÁ LOGADO */

if(!isset($_SESSION["logado"])) {
    header("Location: login.php");
    die();  
}
else {
    /* VERIFICANDO SE HÁ UMA TENTATIVA DE CADASTRO DE USUARIO DO SISTEMA */
    if(isset($_POST["newuser"])){
    
        $nome = filter_input(INPUT_POST, "nome");
        $email = filter_input(INPUT_POST, "email");
        $usuario = filter_input(INPUT_POST, "usuario");        
        $adm = filter_input(INPUT_POST, "tipoUsuario");        
        $senha = filter_input(INPUT_POST, "senha");
        $confirmaSenha = filter_input(INPUT_POST, "confirmaSenha");        
        if (!($nome && $email && $usuario && $senha && $adm)) {            
            $message[] = "Preencha todos os campos para conseguir cadastrar um usuário.";
            print_r(end($message));
        }
        else {
            if($senha == $confirmaSenha) {
                $senhaCrip = password_hash($senha, PASSWORD_DEFAULT);
                $user = new User;
                $user->createUser($nome, $email, $usuario, $senhaCrip, $adm);
                $_POST = null;
            } else {
                $message[] = "As senhas devem ser iguais.";
                print_r(end($message));
            }                
        }
    }

    /* VERIFICANDO SE HÁ UMA TENTATIVA DE CADASTRO DE POST */
    else if(isset($_POST["newpost"])){
        $title = strval(filter_input(INPUT_POST, "titulo"));
        $description = strval(filter_input(INPUT_POST, "descricao"));
        $text = strval(filter_input(INPUT_POST, "texto"));

        /* VERIFICANDO SE O FORMULARIO DA POSTAGEM ESTÁ VAZIO */
        if (empty($title) || empty($description) || empty($text)) {            
            $message[] = "Preencha todos os campos para conseguir criar uma postagem.";
            print_r(end($message));
        }

        /* CASO O FORMULÁRIO ESTEJA PREENCHIDO */
        else {
            $image = $_FILES['imagem'];
            $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
            echo $extension;
        
            if(($extension == 'jpg') || ($extension == 'png') || ($extension == 'jpeg')) {
                $post = new Post;
                $post->createPost($title, $description, $text, $image);
            }
            else {
                $message[] = "Insira uma imagem JPEG ou PNG";
                print_r(end($message));
            }                
        }        
    }

    /* VERIFICANDO SE AS INFORMAÇÕES DE LOGIN ESTÃO CORRETAS */
    else if (isset($_POST["login"])){
        
        $usuario = filter_input(INPUT_POST, "usuario");        
        $senha = filter_input(INPUT_POST, "senha");    
        if (empty($usuario) || empty($senha)) {        
            $message[] = "Preencha o usuário e senha para realizar o login.";
            print_r(end($message));
        }
        else {        
            $user = new User;
            $user->loginUser($usuario, $senha);
            header("Location: newuser.php");
            die();
        }
    }
        
    else if(isset($_POST["editpost"])){
        $id = strval(filter_input(INPUT_POST, "id"));
        $title = strval(filter_input(INPUT_POST, "titulo"));
        $description = strval(filter_input(INPUT_POST, "descricao"));
        $date = strval(filter_input(INPUT_POST, "data"));
        $text = strval(filter_input(INPUT_POST, "texto"));

        /* VERIFICANDO SE O FORMULARIO DA POSTAGEM ESTÁ VAZIO */
        if (empty($title) || empty($description) || empty($text)) {            
            $message[] = "Preencha todos os campos para conseguir criar uma postagem.";
            print_r(end($message));
        }

        /* CASO O FORMULÁRIO ESTEJA PREENCHIDO */
        else {
            $image = $_FILES['imagem'];
            $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
            var_dump($image);
        
            if((($extension == 'jpg') || ($extension == 'png') || ($extension == 'jpeg')) || ($image['type'] == '')) {
                $post = new Post;
                $post->editPost($id, $title, $description, $date, $text, $image);
            }
            else {
                
                $message[] = "Insira uma imagem JPEG ou PNG";
                print_r(end($message));
            }                
        }        
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- BOOTSTRAP -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- Trumbowyg -->
    <link rel="stylesheet" href="dist/ui/trumbowyg.min.css">
</head>
<body>
    <div class="content">
        <header>
            <nav>
                <div class="sessao">
                    <div class="nome">
                        Usuário: <?=$_SESSION["usuario"]?> <br>
                        <a href="http://localhost/projetos/site_raiz/" target="_blank"  >Visitar Site</a>
                    </div>
                    <div class="sair">
                        <a href="<?=$SITE_RAIZ?>logout.php">                        
                            <button class="btn btn-danger">Sair</button>
                        </a>
                    </div>
                </div>
                <ul>
                    <a href="listposts.php">
                        <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                            <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                        </svg>
                        
                        <div id="itensMenu">
                            postagens
                        </div>
                        </li>
                    </a>
                    <a href="newpost.php">
                        <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="svg-item bi bi-file-plus" viewBox="0 0 16 16">
                            <path d="M8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z"/>
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                        </svg>
                        
                        <div id="itensMenu">

                            nova postagem
                        </div>
                        </li>
                    </a>
                    <a href="newuser.php">
                        <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                        
                        <div id="itensMenu">
                            novo usuário
                        </div>
                        </li>
                    </a>
                    <a href="newuser.php">
                        <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                        </svg>
                        
                        <div id="itensMenu">
                            imagens

                        </div>
                        </li>
                    </a>
                    <a href="newuser.php">
                        <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
                            <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                        </svg>
                        
                        <div id="itensMenu">
                            documentos
                        </div>
                        </li>
                    </a>
                    <a href="">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-columns" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 0 .5Zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm-13 2A.5.5 0 0 1 .5 2h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm-13 2A.5.5 0 0 1 .5 4h10a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5Zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm-13 2A.5.5 0 0 1 .5 6h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm-13 2A.5.5 0 0 1 .5 8h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm-13 2a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm-13 2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5Zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm-13 2a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5Zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Z"/>
                            </svg>
                            
                            <div id="itensMenu">

                                agenda
                            </div>
                        </li>
                    </a>
                    <a href="">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg>
                            
                            <div id="itensMenu">
                                
                                lixeira
                            </div>
                        </li>
                    </a>
                </ul>
            </nav>
        </header>
