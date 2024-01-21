<?php

require_once('config/db.php');


class Productos
{

    private $id;

    private $categoria_id;

    private $nombre;


    private $Descripcion;


    private $precio;

    private $stock;


    private $oferta;


    private $imagen;

    private $db;




    public function __construct()
    {
        $this->db = Database::conexion();
    }


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }


    public function getCategoria_id()
    {
        return $this->categoria_id;
    }


    public function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }


    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string(trim($nombre));
    }


    public function getDescripcion()
    {
        return $this->Descripcion;
    }


    public function setDescripcion($Descripcion)
    {
        $this->Descripcion = $this->db->real_escape_string(trim($Descripcion));
    }


    public function getPrecio()
    {
        return $this->precio;
    }


    public function setPrecio($precio)
    {
        $this->precio = $this->db->real_escape_string(trim($precio));
    }


    public function getStock()
    {
        return $this->stock;
    }


    public function setStock($stock)
    {
        $this->stock = $this->db->real_escape_string(trim($stock));
    }


    public function getOferta()
    {
        return $this->oferta;
    }


    public function setOferta($oferta)
    {
        $this->oferta = $oferta;
    }

    public function getImagen()
    {
        return $this->imagen;
    }


    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }


    public function mostrar_productos()
    {

        $sql = "SELECT * FROM Productos ORDER BY Id asc";

        $producto = $this->db->query($sql);

        return $producto;
    }

    public function guardar_productos()
    {

        $sql = "INSERT INTO Productos (Categoria_id, Nombre, Descripcion, Precio, Stock, Oferta, Imagen) VALUES ('{$this->getCategoria_id()}','{$this->getNombre()}', '{$this->getDescripcion()}', '{$this->getPrecio()}', '{$this->getStock()}', '{$this->getOferta()}', '{$this->getImagen()}');";

        $guardar = $this->db->query($sql);

        $resultado = false;

        if ($guardar) {
            $resultado = true;
        } else {
            $resultado = false;
        }

        return $resultado;
    }


    public function Eliminar_producto()
    {

        $sql = "DELETE FROM Productos where Id = '{$this->getId()}'";

        $eliminar = $this->db->query($sql);

        $eliminar_producto = false;

        if ($eliminar) {
            $eliminar_producto = true;
        }

        return $eliminar_producto;
    }

    public function getRandon($limit)
    {

        $producto = $this->db->query("SELECT * FROM Productos ORDER BY RAND() limit $limit");

        return $producto;
    }

    public function mostrar_un_pro()
    {

        $sql = "SELECT * FROM Productos where Id = '{$this->getId()}';";

        $producto = $this->db->query($sql);

        $resultado = false;

        if ($producto && $producto->num_rows == 1) {

            $resultado = $producto;
        }

        return $resultado;
    }

    public function actualizar_producto($vacio = false)
    {
        if ($vacio == false) {
            $sql = "UPDATE Productos SET Categoria_Id = '{$this->getCategoria_id()}',  Nombre = '{$this->getNombre()}', Descripcion = '{$this->getDescripcion()}', Precio = '{$this->getPrecio()}', Stock = '{$this->getStock()}', Imagen = '{$this->getImagen()}' WHERE Id = '{$this->getId()}';";;
        } elseif ($vacio == true) {
            $sql = "UPDATE Productos SET Categoria_Id = '{$this->getCategoria_id()}',  Nombre = '{$this->getNombre()}', Descripcion = '{$this->getDescripcion()}', Precio = '{$this->getPrecio()}', Stock = '{$this->getStock()}' WHERE Id = '{$this->getId()}';";
        }

        $actualizar = $this->db->query($sql);

        $actualizacion = false;

        if ($actualizar) {
            $actualizacion = true;
        } else {
            $actualizacion = false;
        }

        return $actualizacion;
    }

}
