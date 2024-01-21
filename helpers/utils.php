<?php


class utils
{

    public static function delete_session($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }

        return $name;
    }


    public static function delete_session_categoria($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
            header('refresh:2;' . Base_URL . 'Categorias/Crear');
        }
    }

    public static function delete_session_Error($error)
    {
        if (isset($_SESSION[$error])) {
            $_SESSION[$error] = null;
            unset($_SESSION[$error]);
            header('refresh:2;' . Base_URL . 'Categorias/Crear');
        }
    }


    public static function Todas_las_categorias()
    {
        require_once('models/Categorias.php');

        $categorias = new Categorias();
        $categorias->mostrar_categorias();

        $todas =  $categorias->mostrar_categorias();


        return $todas;
    }

    public static function getProductoById($id)
    {

        require_once('models/Productos.php');

        $producto = new Productos();
        $producto->setId($id);
        $producto->mostrar_un_pro();

        $mostrar =  $producto->mostrar_un_pro();

        if ($mostrar && $mostrar->num_rows == 1) {

            $klk = $mostrar->fetch_object();
        }

        return $klk;
    }

    public static function statsCarrito()
    {

        $stats = array(
            'Count' => 0,
            'Total' => 0
        );

        if (isset($_SESSION['carrito'])) {
            $stats['Count'] = count($_SESSION['carrito']);

            foreach ($_SESSION['carrito'] as $producto) {
                $stats['Total'] += $producto['Precio'] * $producto['Unidades'];
            }
        }

        return $stats;
    }


    public static function isusuario()
    {

        if (!isset($_SESSION['usuario'])) {
            header('Location:' . Base_URL);
        } else {
            return true;
        }
    }

    public static function showStatus($status)
    {

        $value = 'Pendiente';

        if ($status == 'confirm') {
            $value = 'Pendiente';
        } elseif ($status == 'preparation') {
            $value = 'En preparación';
        } elseif ($status == 'prepare to send') {
            $value = 'Preparado para enviar';
        } elseif($status == 'sended') {
            $value = 'Enviado';
        }

        return $value;
    }
}
