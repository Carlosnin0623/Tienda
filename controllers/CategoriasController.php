<?php


require_once('models/Categorias.php');



class CategoriasController
{




    public function index()
    {

        // Requiendo el modelo para mostrar todas las categorias //


        $categorias = new Categorias();
        $categorias->mostrar_categorias();

        $todos =  $categorias->mostrar_categorias();

        // renderisando la vista index //

        require_once('views/Categorias/index.php');
    }

    public function productos_categoria(){

        if(isset($_GET['Id'])){
            $Id = (int)$_GET['Id'];
        }

        $producto = new Categorias();
        $producto->setId($Id);
        $productos = $producto->mostrar_productos_x_categoria(false);
        $nombre_categoria = $producto->mostrar_productos_x_categoria(true);

         // Renderizar la vista  //

         require_once('views/Categorias/ver_productos_x_categoria.php');
    }


    public function Crear()
    {

        require_once('helpers/Redireccion.php');
        // Renderizando la vista //

        require_once('views/Categorias/Crear.php');
    }


    public function Guardar()
    {

        require_once('helpers/Redireccion.php');
        
        $errores = array();

        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';

        // Verificar el nombre de categoria //

        $nombre_valido = false;

        if(empty($nombre) OR is_numeric($nombre) OR preg_match("/[0-9]+/",$nombre)){
            
            $nombre_valido = false;
            $errores['nombre'] = 'El nombre de categoria no es valido';

        }else{
            $nombre_valido = true;
        }

        if(count($errores) == 0){
            $guardar = new Categorias();

            $guardar->setNombre_categoria($nombre);

            $resultado = $guardar->Crear_categoria();

            if($resultado){
                $_SESSION['Categoria'] = 'La categoria fue creada con exito';
            }else{
                $_SESSION['Error']= 'Ocurrio un error al insertar';
            } 

        }else{

            $_SESSION['Error']['nombre'] = $errores['nombre'];
        }


        header('Location:'.Base_URL.'Categorias/Crear');

    }
}
