<?php if (isset($_SESSION['usuario'])) : ?>
    <h1>Hacer Pedido</h1>
    <p>
        <a href="<?= Base_URL ?>Carrito/index">Ver los productos y el precio del pedido</a>
    </p>

    <h3>Dirección para el envio</h3>

    <br>

    <form action="<?= Base_URL ?>Pedidos/add" method="post">
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" id="provincia" required>

        <label for="localidad">Localidad</label>
        <input type="text" name="localidad" id="localidad" required>

        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" id="direccion" required>


        <input type="submit" value="Confirmar el pedido" required>

    </form>

<?php else : ?>
    <h5>Necesitas estar loqueado en la web para poder realizar tu pedido</h5>
<?php endif; ?>