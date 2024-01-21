<?php

require_once('models/Productos.php');


class ProductosController
{





    public function index()
    {

         $producto = new Productos();
         $mostrar = $producto->getRandon(6);

        // Renderizar vista  //
        require_once('views/Productos/destacados.php');
    }


    public function gestion()
    {
        require_once('helpers/Redireccion.php');

        $producto = new Productos();

        $todos = $producto->mostrar_productos();



        // Renderizar la vista //

        require_once('views/Productos/gestion.php');
    }

    public function Crear()
    {
        // Añadiendo la redireccion  //
        require_once('helpers/Redireccion.php');



        // Renderizar vista  //
        require_once('views/Productos/crear.php');
    }


    public function Guardar()
    {

        require_once('helpers/Redireccion.php');

        if (isset($_POST)) {

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;




            if ($nombre && $descripcion && $precio && $stock && $categoria) {

                $producto = new Productos();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);

                // Guardar la Imagen  //

                $file = $_FILES['imagen'];
                $filename = $file['name'];
                $minetypes = $file['type'];

                if ($minetypes == "image/jpg" || $minetypes == "image/jpeg" || $minetypes == "image/png" || $minetypes == "image/gif") {

                    // Almacenando las imagenes en un directorio //
                    if (!is_dir('uploads/images')) {
                        mkdir('uploads/images', 0777, true);
                    }

                    // ahora debemos mover el directorio a un ruta que queramos //
                    move_uploaded_file($file['tmp_name'], 'uploads/images' . $filename);
                    $producto->setImagen($filename);
                }

                $guardar =  $producto->guardar_productos();

                if ($guardar) {
                    $_SESSION['producto'] = 'Complete';
                } else {
                    $_SESSION['producto'] = 'Failed';
                }
            } else {
                $_SESSION['producto'] = 'Failed';
            }
        } else {
            $_SESSION['producto'] = 'Failed';
        }

        header('Location:' . Base_URL . 'Productos/Crear');
    }

    public function ver(){
        if (isset($_GET['id'])) {

            $Id = (int)$_GET['id'];
        }

        $producto = new Productos();
        $producto->setId($Id);
        $producto->mostrar_un_pro();

        $mostrar = $producto->mostrar_un_pro();

        $mostrar1 = $producto->mostrar_un_pro();

        require_once('views/Productos/ver.php');
    }


    public function Eliminar()
    {
        require_once('helpers/Redireccion.php');
        if (isset($_GET['id'])) {

            $Id =  (int)$_GET['id'];
        }

        $producto = new Productos();
        $producto->setId($Id);
        $eliminar =  $producto->Eliminar_producto();


        if ($eliminar) {

            $_SESSION['producto_eliminado'] = 'Complete';
        } else {
            $_SESSION['producto_eliminado'] = 'Failed';
        }

        header('Location:' . Base_URL . 'Productos/gestion');
    }


    public function Editar()
    {

        require_once('helpers/Redireccion.php');

        if (isset($_GET['id'])) {

            $Id =  (int)$_GET['id'];
        }

        $producto = new Productos();
        $producto->setId($Id);
        $producto->mostrar_un_pro();

        $mostrar = $producto->mostrar_un_pro();

        require_once('views/Productos/Editar.php');
    }


    public function Actualizar()
    {

        if (isset($_POST) && isset($_GET['Id']) && isset($_FILES)) {
            // enviados por el metodo post //

            $errores = array();

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio =  isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock =  isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
            $id = isset($_GET['Id']) ? (int)$_GET['Id'] : false;
            $files = isset($_FILES['imagen']) ? $_FILES['imagen'] : '';
            // Validando los datos //

            // validando nombre de producto //

            $nombre_valido = false;

            if (empty($nombre) || is_numeric($nombre) || preg_match("/[0-9]+/", $nombre)) {

                $nombre_valido = false;
                $errores['nombre'] = 'nombre producto';
                $error =  $errores['nombre'];
            } else {
                $nombre_valido = true;
            }

            // validando Descripcion de producto //

            $descripcion_valida = false;

            if (empty($descripcion) || is_numeric($descripcion) || preg_match("/[0-9]+/", $descripcion)) {

                $descripcion_valida = false;
                $errores['descripcion'] = 'descripcion producto';
                $error =  $errores['descripcion'];
            } else {
                $descripcion_valida = true;
            }

            // validando Precio de producto //

            $precio_valido = false;

            if (empty($precio) || preg_match("/[A-Z-a-z]+/", $precio)) {

                $precio_valido = false;
                $errores['precio'] = 'precio producto';
                $error = $errores['precio'];

            } else {
                $precio_valido = true;
            }

            // validando Precio de producto //

            $stock_valido = false;

            if (empty($stock) || preg_match("/[A-Z-a-z]+/", $stock)) {

                $stock_valido = false;
                $errores['stock'] = 'stock producto';
                $error = $errores['stock'];

                
            } else {
                $stock_valido = true;
            }



            // validando categoria de producto //

            $categoria_valido = false;

            if (empty($categoria)) {

                $categoria_valido = false;

                $errores['categoria_id'] = 'stock producto';
                $error = $errores['categoria_id'];
            } else {
                $categoria_valido = true;
            }

            if (count($errores) == 0) {


                if ($nombre_valido && $descripcion_valida && $precio_valido && $stock_valido && $categoria_valido) {

                    $producto = new Productos();
                    $producto->setId($id);
                    $producto->setNombre($nombre);
                    $producto->setDescripcion($descripcion);
                    $producto->setPrecio($precio);
                    $producto->setStock($stock);
                    $producto->setCategoria_id($categoria);

                    $filesname = $files['name'];
                    $files_tmp_name = $files['tmp_name']; // 'tmp_name hace referencia a la ruta temporal del archivo que luego podemos modfificar //
                    $filestype = $files['type'];

                    // Aqui verificamos que el archivo no este en blanco y si no esta actualizamos la imagen del producto //
                    if (!empty($filesname)) {

                        if($filestype == "image/jpg" || $filestype  == "image/jpeg" || $filestype  == "image/png" || $filestype  == "image/gif") {

                            // Almacenando las imagenes en un directorio //
                            if (!is_dir('uploads/images')) {
                                mkdir('uploads/images', 0777, true);
                            }

                            // Mover el archivo a un direcctorio que quieras //
                            move_uploaded_file($files_tmp_name, 'uploads/images/' . $filesname);
                            $producto->setImagen($filesname);

                            $guardar =  $producto->actualizar_producto(false);

                            if ($guardar) {
                                $_SESSION['actualizacion'] = 'Complete';
                            } else {
                                $_SESSION['actualizacion'] = 'Failed';
                            }
                        }
                    } elseif (empty($filesname)) {
                        // Aqui verificamos que el archivo este en blanco y si lo esta actualizamos la imagen  del producto //
                        $guardar =  $producto->actualizar_producto(true);

                        if ($guardar) {
                            $_SESSION['actualizacion'] = 'Complete';
                        } else {
                            $_SESSION['actualizacion'] = 'Failed';
                        }
                    }
                }
            } else {
                $_SESSION['errores_producto'] = $error;
            }

            header('Location:' . Base_URL . 'Productos/Editar&id=' . $id);
        }
    }
}
