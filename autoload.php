<?php



function cargar_controladores($controllers){

    require_once 'controllers/'. $controllers .'.php';
}



spl_autoload_register('cargar_controladores');












