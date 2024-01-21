<?php

require_once('config/db.php');


class Categorias
{

    private $Id;

    private $nombre_categoria;


    private $db;


    public function __construct()
    {

        $this->db = Database::conexion();
    }

    public function getId()
    {

        return  $this->Id;
    }

    public function setId($id)
    {

        $this->Id = $id;
    }


    public function getNombre_categoria()
    {
        return $this->nombre_categoria;
    }


    public function setNombre_categoria($nombre_categoria)
    {
        $this->nombre_categoria = $this->db->real_escape_string(trim($nombre_categoria));
    }

    public function mostrar_categorias()
    {
        $resultado = false;

        $sql = "SELECT * FROM Categorias ORDER BY Id asc";

        $categoria = $this->db->query($sql);

        if ($categoria && $categoria->num_rows >= 1) {

            $resultado = $categoria;
        }

        return $resultado;
    }


    public function Crear_categoria()
    {

        $categoria = false;

        $sql = "INSERT INTO Categorias (Nombre) VALUES ('{$this->nombre_categoria}')";

        $guardar = $this->db->query($sql);


        if ($guardar) {

            $categoria = true;
        }


        return $categoria;
    }


    public function mostrar_productos_x_categoria($solo = false)
    {

         if($solo == true){
            $sql = "SELECT a.Id AS Id_Producto, a.categoria_Id as categoria_producto, a.Nombre as nombre_producto, a.descripcion as descripcion_producto, a.Precio as precio_producto, a.Stock as producto_stock, a.Oferta as producto_oferta, " .
           " a.Imagen as imagen_producto, a.Fecha_Entrada as producto_fecha_entrada, b.id as ID_categoria, b.Nombre as nombre_categoria, b.FechaCreacion as Fecha_categoria from productos as a  ".
           " inner join categorias as b  ".
           " on a.Categoria_Id = b.Id where a.Categoria_Id = '{$this->getId()}' LIMIT 1 ";
         }else{
            $sql= "SELECT a.Id AS Id_Producto, a.categoria_Id as categoria_producto, a.Nombre as nombre_producto, a.descripcion as descripcion_producto, a.Precio as precio_producto, a.Stock as producto_stock, a.Oferta as producto_oferta, ".
            " a.Imagen as imagen_producto, a.Fecha_Entrada as producto_fecha_entrada, b.id as ID_categoria, b.Nombre as nombre_categoria, b.FechaCreacion as Fecha_categoria from productos as a  ".
            " inner join categorias as b ".
            " on a.Categoria_Id = b.Id where a.Categoria_Id = '{$this->getId()}' ";
         }
       
        $producto_x_categoria = $this->db->query($sql);

        $resultado = false;

        if ($producto_x_categoria && $producto_x_categoria->num_rows >= 1) {

            $resultado = $producto_x_categoria;
        }

        return $resultado;
    }
}
