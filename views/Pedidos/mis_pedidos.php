<?php if(isset($gestion)) : ?>
    <h1>Gestionar Pedidos</h1>
<?php else: ?>
    <h1>Mis pedidos</h1>
<?php endif; ?>


<?php if(!empty($pedidos)) : ?>
    <table class="table">
        <thead>
            <tr>
                <th>N de Pedido</th>
                <th>Coste de Pedido</th>
                <th>Fecha</th>
                <th>Estados</th>
            </tr>
        </thead>
        <tbody>
            <?php while($pet = $pedidos->fetch_object()) : ?>
                <tr>
                    <td>
                       <a href="<?= Base_URL ?>Pedidos/detalle&Id=<?=$pet->Id?>"><?= $pet->Id ?></a> 
                    </td>

                    <td>
                        <?= $pet->Coste ?>
                    </td>

                    <td>
                        <?= $pet->Fecha_Envio ?>
                    </td>

                    <td>
                        <?= $estado = utils::showStatus($pet->Estado) ?>
                    </td>

                </tr>
            <?php endwhile; ?>

        </tbody>

    </table>
<?php else : ?>
    <?= 'No hay nada en el carrito' ?>
<?php endif; ?>