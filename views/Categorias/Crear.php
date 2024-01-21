<h1>Crear Categoria</h1>

<?php if (isset($_SESSION['Categoria'])) : ?>
    <?php if ($_SESSION['Categoria'] == 'La categoria fue creada con exito') : ?>
        <?= '<strong class="alert-green">La  Categoria se ha insertado correctamente </strong>'; ?>
    <?php endif; ?>
<?php else : ?>
    <?= '' ?>
<?php endif; ?>


<?php if (isset($_SESSION['Error'])) : ?>
    <?php if($_SESSION['Error']['nombre'] == 'El nombre de categoria no es valido') : ?>
        <?= '<strong class="alert-red">Registro Fallido, por favor introduce un nombre de categoría válido </strong>'; ?>
    <?php endif; ?>
<?php else : ?>
    <?= '' ?>
<?php endif; ?>


<?php if(isset($_SESSION['Categoria'])) : ?>
    <?php utils::delete_session_categoria('Categoria'); ?>
<?php elseif(isset($_SESSION['Error'])) : ?>
    <?php utils::delete_session_Error('Error'); ?>
<?php endif;?>




<form action="<?= Base_URL ?>Categorias/Guardar" method="post">

    <label for="nombre">Nombre Categoria</label>
    <input type="text" name="nombre" id="nombre" required>

    <input type="submit" value="Crear categoria">
</form>