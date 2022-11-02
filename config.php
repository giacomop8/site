<?php

/* VARIÁVEL RAIZ */
$SITE_RAIZ = "http://" . $_SERVER["SERVER_NAME"] . dirname($_SERVER['REQUEST_URI']."?") . "/";

/* CONSTANTE RAIZ */
define('RAIZ', __DIR__);