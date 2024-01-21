<?php if (!empty($mostrar)) : ?>
    <?php while ($producto = $mostrar->fetch_object()) : ?>
        <h1><?= $producto->Nombre ?></h1>
    <?php endwhile; ?>
<?php endif; ?>



<?php if (!empty($mostrar1)) : ?>
    <?php while ($productos = $mostrar1->fetch_object()) : ?>
        <div class="product contenedor-imagen">

            <div class="contenedor-info">

                <?php if ($productos->Imagen != null) : ?>
                    <img src="<?= Base_URL ?>uploads/images/<?= $productos->Imagen ?>" class="Imagen-producto" alt="<?= $productos->Nombre ?>" srcset="">
                <?php elseif ($productos->Imagen == null) :  ?>
                    <img src="<?= Base_URL ?>assets/img/camiseta.png" alt="Camiseta no disponible" srcset="">
                <?php endif; ?>

            </div>

            <div class="contenedor-enlaces">

                <h2><?= $productos->Nombre ?></h2>


                <h4><?= $productos->Descripcion ?></h4>
                <br>


                <p>RD$<?= $productos->Precio ?></p>
                <?php if (isset($_SESSION['Admin'])) : ?>
                    <a href="<?= Base_URL ?>Productos/Editar&id=<?= $productos->Id ?>" class="button">Editar </a>
                <?php endif; ?>
                <br>
                <a href="<?= Base_URL ?>Carrito/Add&id=<?= $productos->Id ?>" class="button">Comprar</a>

            </div>

        </div>
    <?php endwhile; ?>
<?php endif; ?>
