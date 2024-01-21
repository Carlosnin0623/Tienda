<?php

require_once('models/Productos.php');

class CarritoController
{




    public function index()
    {
        if (isset($_SESSION['carrito'])) {
            $carrito = $_SESSION['carrito'];
        }

        
        require_once('views/Carrito/ver.php');

       
    }


    public function Add()
    {

        if(isset($_GET['id'])) {
            $Producto_id = (int)$_GET['id'];
        } else {
            header('Location:' . Base_URL);
        }

        if (isset($_SESSION['carrito'])) {

            $counter = 0;

            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                 if($elemento['Producto_id'] == $Producto_id){
                    $_SESSION['carrito'][$indice]['Unidades']++;
                    $counter++;
                 }
                
            }
        }else{

             echo 'No hay nada en el carrito de compras';
        }

        if (!isset($counter) || ($counter == 0)) {

            // Conseguir producto  //
            $producto = new Productos();

            $producto->setId($Producto_id);
            $productos = $producto->mostrar_un_pro();
            $carrito = $productos->fetch_object();


            if (is_object($carrito)) {
                $_SESSION['carrito'][] = array(
                    'Producto_id' => $carrito->Id,
                    'Precio' => $carrito->Precio,
                    'Unidades' => 1,
                    'Producto' => $carrito
                );

            }
        }


    header('Location:'.Base_URL.'Carrito/index');
    }

    public function Remove()
    {
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
            header('Location:'.Base_URL.'Carrito/index');
        }
    }

    public function up()
    {
        if(isset($_GET['index'])){
            $index = $_GET['index'];
             $_SESSION['carrito'][$index]['Unidades']++;
            header('Location:'.Base_URL.'Carrito/index');
        }
       
    }

    
    public function down()
    {
        if(isset($_GET['index'])){
            $index = $_GET['index'];
             $_SESSION['carrito'][$index]['Unidades']--;
             if($_SESSION['carrito'][$index]['Unidades'] == 0){
                unset($_SESSION['carrito'][$index]);
             }
        }

        header('Location:'.Base_URL.'Carrito/index');
       
    }

    public function DeleteAll()
    {
        if (isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = null;
            unset($_SESSION['carrito']);
            header('Location:'.Base_URL.'Carrito/index');
        }
       
    }
}
