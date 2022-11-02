<?php

$url = "http://localhost/projetos/site_raiz/login/index.php";

session_start();
session_destroy();
header("Location:$url"); /* PRECISA DE DIRECIONAR AO LINK CERTO POR SER SUBPASTA DO SITE */