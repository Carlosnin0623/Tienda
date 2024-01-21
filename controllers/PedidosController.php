<?php

require_once('models/Pedidos.php');


class PedidosController
{




    public function hacer()
    {

        require_once('views/Pedidos/hacer.php');
    }


    public function add()
    {

        if (isset($_SESSION['usuario'])) {
            // Recibiendo los datos //

            $Usuario_id = (int)$_SESSION['usuario']->Id;
            $provincia = isset($_POST['provincia']) ? trim($_POST['provincia']) : false;
            $localidad =  isset($_POST['localidad']) ? trim($_POST['localidad']) : false;
            $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : false;
            $stats = utils::statsCarrito();
            $coste = (float)$stats['Total'];


            if ($provincia && $localidad && $direccion) {

                // Guardar datos en la base de datos //

                $pedido = new Pedidos();
                $pedido->setUsuario_Id($Usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);
                $save =  $pedido->Save();

                /* Guardar Linea pedidos  */

                $save_linea = $pedido->SaveLinea();

                if ($save && $save_linea) {

                    $_SESSION['pedido'] = 'Complete';
                } else {
                    $_SESSION['pedido'] = 'Failed';
                }
            } else {
                $_SESSION['pedido'] = 'Failed';
            }

            header('Location:' . Base_URL . 'Pedidos/confirmado');
        } else {
            header('Location:' . Base_URL);
        }
    }


    public function confirmado()
    {
        // Renderizando la vista cuando se completa exitosamente el pedido //

        if (isset($_SESSION['usuario'])) {

            $usuario_id = $_SESSION['usuario']->Id;
        }


        $pedido = new Pedidos();

        $pedido->setUsuario_Id($usuario_id);
        $pedido = $pedido->mostrar_pedido_x_usuario();


        $pedido_productos = new Pedidos();
        $productos = $pedido_productos->mostrar_productos_x_pedido_id($pedido->Id);
        require_once('views/Pedidos/confirmado.php');
    }




    public function mis_pedidos()
    {

        utils::isusuario();

        $usuario_id = $_SESSION['usuario']->Id;

        $pedido = new Pedidos();

        $pedido->setUsuario_Id($usuario_id);
        $pedidos = $pedido->mostrar_pedidos_x_usuario();

        // Renderizando la vista de mis pedidos //
        require_once('views/Pedidos/mis_pedidos.php');
    }

    public function detalle()
    {

        utils::isusuario();

        if (isset($_GET['Id'])) {

            $Id = $_GET['Id'];

            // Sacar el pedido //

            $pedido = new Pedidos();
            $pedido->setId($Id);
            $pedido = $pedido->getOne();


            // Sacar los productos //

            $pedido_productos = new Pedidos();
            $productos = $pedido_productos->mostrar_productos_x_pedido_id($pedido->Id);


            require_once('views/Pedidos/detalle.php');
        } else {

            header('Location:' . Base_URL . 'Pedidos/mis_pedidos.php');
        }
    }

    public function gestion()
    {

        require_once('helpers/Redireccion.php');

        $gestion = true;

        $pedido = new Pedidos();

        $pedidos = $pedido->getALL();

        require_once('views/Pedidos/mis_pedidos.php');
    }

    public function estado()
    {

        require_once('helpers/Redireccion.php');

        if (isset($_POST)) {
            // UPDATE DEL PEDIDO //
            $Id = $_POST['Pedido_id'];
            $Estado = $_POST['estado'];

            $actualizarEstadoPedido = new Pedidos();
            $actualizarEstadoPedido->setId($Id);
            $actualizarEstadoPedido->setEstado($Estado);
            $pedido = $actualizarEstadoPedido->updateOne();

            if ($pedido) {
                header("Location:" . Base_URL . 'Pedidos/detalle&Id=' . $Id);
            } else {
                header("Location:" . Base_URL);
            }
        } else {

            header("Location:" . Base_URL);
        }
    }
}
