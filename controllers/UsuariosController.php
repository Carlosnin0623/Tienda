<?php


require_once('models/Usuarios.php');


class UsuariosController
{



    public function index()
    {
        echo "Controlador Usuarios, Acción index";
    }

    public function Registro()
    {

        // Requerimos la vista para el registro de usuarios //

        require_once('views/Usuarios/registro.php');
    }

    public function Guardar()
    {
        require_once('helpers/Redireccion.php');
        // Aqui se reciben los datos que nos llegaran por el metodo Registro de arriba //

        // Capturando los datos //

        if (isset($_POST)) {
            $usuario = new Usuarios();

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            if ($nombre && $apellidos && $email && $password) {

                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                $guardar = $usuario->Guardar();

                if ($guardar) {
                    $_SESSION['Register'] = 'Complete';
                } else {
                    $_SESSION['Register'] = 'Failed';
                }
            }else{
                $_SESSION['Register'] = 'Failed';
            }
        } else {
            $_SESSION['Register'] = 'Failed';
        }

        header('Location:'.Base_URL.'Usuarios/Registro');
    }



    public function Login(){
        require_once('helpers/Redireccion.php');
        if(isset($_POST)){
            // Identificar el usuario  //

            //Consulta a la base de datos //

            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            $usuario = new Usuarios();
          
            $identidad = $usuario->login($email, $password);

            if($identidad && is_object($identidad)){
                $_SESSION['usuario'] = $identidad;

                  if($identidad->Rol == 'admin'){
                     $_SESSION['Admin'] = True;
                  }

            }else{
                $_SESSION['error_login'] = 'Identificacion fallida';
            }

        }

        header('Location:'.Base_URL);
    }


    public function logout(){
        require_once('helpers/Redireccion.php');

        if(isset($_SESSION['usuario'])){
             $_SESSION['usuario'] = null;
             unset($_SESSION['usuario']);
             session_destroy();
           
        }
        
        header('Location:'.Base_URL);

    }
}
