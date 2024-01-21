<?php if (isset($_SESSION['errores_producto'])) : ?>
    <?php if ($_SESSION['errores_producto'] == 'nombre producto') : ?>
        <?php $nombre = '<strong class="alert-red alert-small"> Se ha producido un error, nombre de producto invalido no puede contener números * </strong>'; ?>
    <?php elseif ($_SESSION['errores_producto'] == 'descripcion producto') : ?>
        <?php $descripcion = '<strong class="alert-red alert-small"> Se ha producido un error, La descripcion no es valida no puede contener números * </strong>'; ?>
    <?php elseif ($_SESSION['errores_producto'] == 'precio producto') : ?>
        <?php $precio = '<strong class="alert-red alert-small"> Se ha producido un error, Este campo solo permite números * </strong>'; ?>
    <?php elseif ($_SESSION['errores_producto'] == 'stock producto') : ?>
        <?php $stock = '<strong class="alert-red alert-small"> Se ha producido un error, Este campo solo permite números * </strong>'; ?>
    <?php endif; ?>
<?php else : ?>
    <?= '' ?>
<?php endif; ?>





<?php if (!empty($mostrar)) : ?>
    <?php while ($producto = $mostrar->fetch_object()) : ?>
        <h1>Editar Producto <?= $producto->Nombre ?></h1>
        <div class="form_container">
            <form action="<?= Base_URL ?>Productos/Actualizar&Id=<?= $producto->Id ?>" method="post" enctype="multipart/form-data">


                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="<?= $producto->Nombre ?>" required>

                 <?php if(isset($_SESSION['errores_producto'])) : ?>
                       <?php if($_SESSION['errores_producto'] == 'nombre producto') : ?>
                        <?= $nombre ?>
                       <?php else: ?>
                        <?= $nombre = '' ?>
                        <?php endif; ?>
                     <?php else: ?>
                        <?= '' ?>
                <?php endif; ?>



                <label for="descripcion">Descripcion</label>
                <textarea name="descripcion" id="descripcion"><?= $producto->Descripcion; ?></textarea>

                <?php if(isset($_SESSION['errores_producto'])) : ?>
                       <?php if($_SESSION['errores_producto'] == 'descripcion producto') : ?>
                        <?= $descripcion ?>
                       <?php else: ?>
                        <?= $descripcion = '' ?>
                        <?php endif; ?>
                     <?php else: ?>
                        <?= '' ?>
                <?php endif; ?>



                <label for="precio">Precio</label>
                <input type="text" name="precio" id="precio" value="<?= $producto->Precio ?>" required>

                <?php if(isset($_SESSION['errores_producto'])) : ?>
                       <?php if($_SESSION['errores_producto'] == 'precio producto') : ?>
                        <?= $precio ?>
                       <?php else: ?>
                        <?= $precio= '' ?>
                        <?php endif; ?>
                     <?php else: ?>
                        <?= '' ?>
                <?php endif; ?>

                <label for="stock">Stock</label>
                <input type="text" name="stock" id="stock" value="<?= $producto->Stock ?>" required>

                <?php if(isset($_SESSION['errores_producto'])) : ?>
                       <?php if($_SESSION['errores_producto'] == 'stock producto') : ?>
                        <?= $stock ?>
                       <?php else: ?>
                        <?= $stock = '' ?>
                        <?php endif; ?>
                     <?php else: ?>
                        <?= '' ?>
                <?php endif; ?>

                <label for="categoria">Elige la categoria</label>
                <select name="categoria" id="categoria">
                    <?php $todasLasCategorias = utils::Todas_las_categorias();
                    while ($categorias = $todasLasCategorias->fetch_object()) :
                        $selected = ($categorias->Id == $producto->Categoria_Id) ? 'selected="selected"' : '';
                    ?>
                        <option value="<?= $categorias->Id ?>" <?= $selected ?>><?= $categorias->Nombre ?></option>
                    <?php endwhile; ?>
                </select>
                <label for="imagen">Imagen</label>

                <img src="<?= Base_URL ?>/uploads/images/<?= $producto->Imagen ?>" alt="<?= $producto->Nombre ?>" width="100px" height="100px">
                <br>
                <input type="file" name="imagen" id="imagen">

                <input type="submit" value="Guardar">
            </form>
        <?php endwhile; ?>
    <?php endif; ?>

    <?php utils::delete_session('errores_producto'); ?>

        </div>