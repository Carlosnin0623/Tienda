<?php


class Usuarios
{

    private $Id;

    private $Nombre;
    private $Apellidos;

    private $Email;

    private $Password;

    private $Rol;

    private $Imagen;

    private $db;


    public function __construct()
    {
        $this->db = Database::conexion();
    }

   
    public function setId($Id)
    {
        $this->Id = $Id;
    }
    

    
    public function setNombre($Nombre)
    {
        $this->Nombre = $this->db->real_escape_string($Nombre);
    }

    public function setApellidos($Apellidos)
    {
        $this->Apellidos = $this->db->real_escape_string($Apellidos);
    }

    public function setEmail($Email)
    {
        $this->Email = $this->db->real_escape_string($Email);
    }

    public function setPassword($password)
    {
        $this->Password = password_hash($this->db->real_escape_string($password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    
    public function setRol($Rol)
    {
        $this->Rol = $Rol;
    }

    public function setImagen($Imagen)
    {
        $this->Imagen = $Imagen;
    }

    public function getId()
    {
        return $this->Id;
    }


    public function getNombre()
    {

        return $this->Nombre;
    }

    public function getApellidos()
    {
        return $this->Apellidos;
    }

 
    public function getEmail()
    {
        return $this->Email;
    }


    public function getPassword($password)
    {
        return $this->Password;
    }


    public function getRol()
    {
        return $this->Rol;
    }


    public function getImagen()
    {
        return $this->Imagen;
    }


    public function Guardar()
    {

        $sql = "INSERT INTO Usuarios (Nombre, Apellidos, Email, Password, Rol, Imagen) VALUES ('{$this->Nombre}','{$this->Apellidos}','{$this->Email}','{$this->Password}', 'user', null)";
        $guardar = $this->db->query($sql);

        $resultado = false;

        if ($guardar) {
            $resultado = true;
        }

        return $resultado;
    }

    public function login($email, $password)
    {
        $result = false;
   
        // Comprobar si existe el usuario //
        $sql = $this->db->query("SELECT * FROM Usuarios where Email = '$email';");
        $login = $sql;

        if ($login && $login->num_rows == 1) {

            $usuario = $login->fetch_object();

            // verificar la contraseña //

            $verify = password_verify($password, $usuario->Password);

            if ($verify) {

                $result = $usuario;

            } else {

            }
        } else {
            echo 'El usuarios no esta registrado';
        }

        return $result;
    }
}
