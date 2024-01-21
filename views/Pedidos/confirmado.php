<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'Complete') : ?>

    <h1>Tu pedido se ha confirmado</h1>

    <p>Tu pedido ha sido guardado con exito, una vez que realices la transferencia bancaria
        a la cuenta 7873987934243212 con el coste del pedido, este será procesado y enviado.
    </p>

    <br>


    <?php if (isset($pedido)) : ?>
        <h3>Datos del pedido:</h3>

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
                            <?php if($producto->Imagen != null) : ?>
                                <img src="<?=Base_URL?>uploads/images/<?=$producto->Imagen?>" alt="<?= $producto->Nombre ?>" srcset="" width="80px" height="80px">
                            <?php else: ?>
                                <img src="<?=Base_URL?>assets/img/camiseta.png" alt="Imagen camiseta" srcset="">
                            <?php endif; ?>
                        </td>
                        <td><?= $producto->Nombre ?></td>
                        <td><?= $producto->Unidades ?></td>
                    </tr>
                    
                </tbody>

            <?php endwhile; ?>

        </table>

    <?php endif; ?>



<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'Complete') : ?>

    <p>Tu pedido ha podido completarse</p>

<?php endif; ?>