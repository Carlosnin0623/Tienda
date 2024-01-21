<?php

session_start();
require_once('autoload.php');
require_once('config/db.php');
require_once('config/parameters.php');
require_once('helpers/utils.php');

// Aqui despues del autoload que carga los controladores,  incluimos el header que tenemos en la carpeta views //

require_once('views/layouts/header.php');

// Luego incluimos el sidebar //

require_once('views/layouts/sidebar.php');




function show_Error()
{
    $error = new ErrorController();
    echo $error->index();
}


if (isset($_GET['controlador'])) {

    $nombre_controlador = trim($_GET['controlador'] . 'Controller');
} elseif (!isset($_GET['controlador']) && !isset($_GET['action'])) {

    $nombre_controlador = controlador_default;
} else {
    show_Error();
    exit();
}


if (class_exists($nombre_controlador)) {

    $controlador = new $nombre_controlador();


    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = trim($_GET['action']);
        $controlador->$action();
    } elseif (!isset($_GET['controlador']) && !isset($_GET['action'])) {
        $action_default = action_default;
        $controlador->$action_default();
    } else {
        show_Error();
    }
} else {
    show_Error();
}

// Aqui incluimos el footer //


require_once('views/layouts/footer.php');

