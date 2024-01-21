<?php

require_once('config/db.php');

class Pedidos
{

    private $Id;

    private $usuario_Id;

    private $Provincia;


    private $Localidad;


    private $Direccion;

    private $Coste;

    private $Estado;

    private $Fecha_Envio;


    private $db;


    public function __construct()
    {

        $this->db = Database::conexion();
    }

    public function getId()
    {
        return $this->Id;
    }


    public function setId($Id)
    {
        $this->Id = $Id;
    }

    public function getUsuario_Id()
    {
        return $this->usuario_Id;
    }


    public function setUsuario_Id($usuario_Id)
    {
        $this->usuario_Id = $usuario_Id;
    }


    public function getProvincia()
    {
        return $this->Provincia;
    }


    public function setProvincia($Provincia)
    {
        $this->Provincia = $this->db->real_escape_string($Provincia);
    }


    public function getLocalidad()
    {
        return $this->Localidad;
    }


    public function setLocalidad($Localidad)
    {
        $this->Localidad = $this->db->real_escape_string($Localidad);
    }


    public function getDireccion()
    {
        return $this->Direccion;
    }


    public function setDireccion($Direccion)
    {
        $this->Direccion =  $this->db->real_escape_string($Direccion);
    }


    public function getCoste()
    {
        return $this->Coste;
    }


    public function setCoste($Coste)
    {
        $this->Coste = $Coste;
    }


    public function getEstado()
    {
        return $this->Estado;
    }


    public function setEstado($Estado)
    {
        $this->Estado = $Estado;
    }


    public function getFecha_Envio()
    {
        return $this->Fecha_Envio;
    }


    public function setFecha_Envio($Fecha_Envio)
    {
        $this->Fecha_Envio = $Fecha_Envio;
    }


    public function getALL()
    {

        $productos = $this->db->query("SELECT * FROM Pedidos ORDER BY Id DESC");

        return $productos;
    }

    public function getOne()
    {

        $productos = $this->db->query("SELECT * FROM Pedidos WHERE Id = '{$this->getId()}'; ");

        return $productos->fetch_object();
    }

    public function Save()
    {
        $usuario_id = $this->getUsuario_Id();
        $provincia = $this->getProvincia();
        $localidad = $this->getLocalidad();
        $direccion = $this->getDireccion();
        $coste = $this->getCoste();


        $sql = "INSERT INTO Pedidos (Usuario_Id, Provincia, Localidad, Direccion, Coste, Estado) Values ($usuario_id, '$provincia', '$localidad', '$direccion', $coste, 'Confirm');";

        $save = $this->db->query($sql);

        $resultado = false;

        if ($save) {
            $resultado = true;
        }

        return $resultado;
    }

    public function mostrar_pedido_x_usuario(){
        $sql = "SELECT p.Id as Id, p.coste as Coste FROM Pedidos as p ".
               "INNER JOIN Lineas_pedidos as lp ON lp.Pedido_Id = p.Id ".
                "WHERE p.Usuario_Id = {$this->getUsuario_Id()} ORDER BY Id DESC limit 1";

         $producto = $this->db->query($sql);

         return $producto->fetch_object();

    }

    public function mostrar_productos_x_pedido_id($id){
       
        $sql = "SELECT Pr.*, lp.Unidades as Unidades FROM productos as  pr ".
              "INNER JOIN Lineas_pedidos as lp ON  pr.Id = lp.Producto_Id ".
               "WHERE lp.Pedido_Id= {$id} ";

         $productos = $this->db->query($sql);

         return $productos;
         
    }

    public function mostrar_pedidos_x_usuario(){

        $sql = "SELECT * FROM Pedidos where Usuario_Id = {$this->getUsuario_Id()} ORDER BY Id DESC";

        $pedido = $this->db->query($sql);

        return $pedido;


    }

    public function SaveLinea()
    {

        $sql = "SELECT * FROM pedidos ORDER BY id DESC LIMIT 1;";

        $query = $this->db->query($sql);

        $pedido_id = $query->fetch_object();

        $cast_pedido_id = (int)$pedido_id->Id;

        foreach ($_SESSION['carrito'] as $elementos) {
            $producto = $elementos['Producto'];
            $producto_id = (int)$producto->Id;

            $insert = "INSERT INTO Lineas_pedidos(Pedido_Id, Producto_Id, Unidades) Values ({$cast_pedido_id}, {$producto_id}, {$elementos['Unidades']})";
            $save = $this->db->query($insert);
        }

        $result = false;
        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function updateOne(){

        $sql = "UPDATE Pedidos set Estado= '{$this->getEstado()}' WHERE Id = {$this->getId()}";

        $updateEstado = $this->db->query($sql);

        $result = false;

        if($updateEstado){
            $result = true;
        }


        return $result;
    }
}
