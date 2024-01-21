<?php if (!empty($nombre_categoria)) : ?>
  <?php while ($nombre = $nombre_categoria->fetch_object()) : ?>
    <h1>Categoria:<?= $nombre->nombre_categoria ?></h1>
  <?php endwhile; ?>
<?php endif; ?>

<div class="organizar-producto">

  <?php if (!empty($productos)) : ?>
    <?php while ($producto = $productos->fetch_object()) : ?>
      <div class="product">
        <a href="<?= Base_URL ?>Productos/ver&id=<?= $producto->Id_Producto ?>">
        <?php if($producto->imagen_producto != null): ?>
          <img src="<?= Base_URL ?>uploads/images/<?= $producto->imagen_producto ?>">
          <?php else: ?>
            <img src="<?= Base_URL ?>assets/img/camiseta.png" alt="camiseta sin nombre">
          <?php endif; ?>
          <h2><?= $producto->nombre_producto ?></h2>
          <p><?= $producto->precio_producto ?></p>
        </a>
        <?php if (isset($_SESSION['Admin'])) : ?>
          <a href="<?= Base_URL ?>Productos/Editar&id=<?= $producto->Id_Producto ?>" class="button">Editar articulo</a>
        <?php endif; ?>

        <br>
        <a href="<?= Base_URL ?>Productos/ver&id=<?= $producto->Id_Producto?>" class="button">Comprar</a>
      </div>
    <?php endwhile; ?>
  <?php else : ?>
    <h3>No hay Productos de esta categoria</h3>
  <?php endif; ?>

</div>