<?php 

require_once "config.php";
require_once RAIZ ."/login/conexao.php";

$select = "SELECT * FROM posts ORDER BY date DESC";
$result = mysqli_query($conexao, $select);
$row = mysqli_num_rows($result);
$titulo = "Site";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav class="cab">
            <div class="input-group pesquisa">
                <input class="form-control" aria-label="Search" type="search" name="" id="" placeholder="Pesquise aqui">
                <div class="input-group-append">
                    <div class="input-group-text" style="background-color: #FFF"><i class="fas fa-search"></i></div>
                </div>
            </div>
        </nav>
        <nav class="cab2">
            <div class="menu">
                <ul>
                    <li><a href="<?= $SITE_RAIZ ?>">Página Inicial</a></li>
                    <li><a href="<?= $SITE_RAIZ ?>noticias.php">Notícias</a></li>
                    <li><a href="<?= $SITE_RAIZ ?>contato.php">Contato</a></li>
                    <li><a href="<?= $SITE_RAIZ ?>sobre.php">Sobre</a></li>
                </ul>
            </div>
        </nav>
    </header>