<h1>Crear nuevos Productos</h1>

<?php if(isset($_SESSION['producto'])) : ?>
    <?php if ($_SESSION['producto'] == 'Complete') : ?>
        <?= '<strong class="alert-green">El producto se ha insertado correctamente </strong>'; ?>
    <?php elseif ($_SESSION['producto'] == 'Failed') : ?>
        <?= '<strong class="alert-red"> Registro Fallido, introduce la información correctamente </strong>'; ?>
    <?php endif; ?>
<?php else: ?>
    <?= ''; ?>
<?php endif; ?>

<div class="form_container">
    <form action="<?= Base_URL ?>Productos/Guardar" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion" id="descripcion"></textarea>

        <label for="precio">Precio</label>
        <input type="text" name="precio" id="precio" required>

        <label for="stock">Stock</label>
        <input type="text" name="stock" id="stock" required>

        <label for="categoria">Elige la categoria</label>
        <select name="categoria" id="categoria">
            <?php $categoria = utils::Todas_las_categorias();
            while ($categorias = $categoria->fetch_object()) : ?>
                <option value="<?= $categorias->Id ?>"><?= $categorias->Nombre ?></option>
            <?php endwhile; ?>
        </select>


        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" id="imagen">


        <input type="submit" value="Guardar">
    </form>


    <?php utils::delete_session('producto'); ?>

</div>