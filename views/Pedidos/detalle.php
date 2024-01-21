<h1>Detalle del pedido</h1>


<?php if (isset($pedido)) : ?>
    <?php if (isset($_SESSION['Admin'])) : ?>
        <h3>Cambiar de estado del pedido </h3>

        <form action="<?= Base_URL ?>Pedidos/Estado" method="post">
        <input type="hidden" value="<?= $pedido->Id ?>" name='Pedido_id'>
            <select name="estado" id="estado">
                <option value="confirm" <?= $pedido->Estado == 'confirm' ? 'Selected' : '' ?>>Pendiente</option>
                <option value="preparation" <?= $pedido->Estado == 'preparation' ? 'Selected' : '' ?>>En Preparación</option>
                <option value="prepare to send" <?= $pedido->Estado == 'prepare to send' ? 'Selected' : '' ?>>Preparado para enviar</option>
                <option value="sended"<?= $pedido->Estado == 'sended' ? 'Selected' : '' ?>>Enviado</option>
            </select>

            <input type="submit" value="Cambiar Estado">
        </form>
        <br>
    <?php endif; ?>




    <h3>Dirección de envio: </h3>
    Provincia: <?= $pedido->Provincia ?> <br>
    Localidad: <?= $pedido->Localidad ?> <br>
    Direccion: <?= $pedido->Direccion ?><br> <br>


    <h3>Datos del pedido:</h3>
    Estado del pedido:  = <?=  $estado = utils::showStatus($pedido->Estado)?> <br>
    ID de Pedido: <?= $pedido->Id ?> <br>
    Total a pagar: <?= $pedido->Coste ?> <br> <br>
    Productos:
    <table border="1">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <?php while ($producto = $productos->fetch_object()) : ?>
            <tbody>
                <tr>
                    <td>
                        <?php if ($producto->Imagen != null) : ?>
                            <img src="<?= Base_URL ?>uploads/images/<?= $producto->Imagen ?>" alt="<?= $producto->Nombre ?>" srcset="" width="80px" height="80px">
                        <?php else : ?>
                            <img src="<?= Base_URL ?>assets/img/camiseta.png" alt="Imagen camiseta" srcset="">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= Base_URL ?>Productos/ver&id=<?= $producto->Id ?>">
                            <?= $producto->Nombre ?>
                        </a>

                    </td>
                    <td><?= $producto->Unidades ?></td>
                </tr>

            </tbody>

        <?php endwhile; ?>

    </table>

<?php endif; ?>