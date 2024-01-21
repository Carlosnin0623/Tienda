<?php


class Database{
    
    private static $hostname = 'localhost';
    private static $username = 'root';
    private  static $password = '';
    private static $database = 'tienda_master';
    private static $port = 3306;



    public static function conexion(){
           $host = self::$hostname;
           $usuario = self::$username;
           $contraseña = self::$password;
           $base_de_datos = self::$database;
           $puerto = self::$port;
           $conexion = new mysqli("$host","$usuario","$contraseña","$base_de_datos","$puerto");
           
           if($conexion->errno){
              echo 'Ha ocurrido un error de conexion'.$conexion->errno;
           }else{
              $conexion->query("SET NAMES 'utf8'");
           }

           return $conexion;
      
    }


}

