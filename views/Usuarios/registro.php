<h1>Registrarse</h1>

<?php if (isset($_SESSION['Register'])) : ?>
    <?php if($_SESSION['Register'] == 'Complete') : ?>
        <?= '<strong class="alert-green">El usuario se ha insertado correctamente </strong>'; ?>
    <?php elseif ($_SESSION['Register'] == 'Failed') : ?>
        <?= '<strong class="alert-red"> Registro Fallido, introduce la información correctamente </strong>'; ?>
    <?php endif; ?>
<?php else : ?>
    <?= ''; ?>
<?php endif; ?>

<!-- Usando la clase utils y el metodo delete_session para eliminar la session una vez muestre el mensaje -->
<?php utils::delete_session('Register'); ?>


<form action="<?= Base_URL ?>Usuarios/Guardar" method="post">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" id="apellidos" required>


    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>


    <label for="password">Contraseña</label>
    <input type="password" name="password" id="password" required>


    <input type="submit" value="Registrar">
</form>