<h1>Productos destacados</h1>
<div class="organizar-producto">


  <?php if (!empty($mostrar)) : ?>
    <?php while ($productos = $mostrar->fetch_object()) : ?>
      <div class="product">
        <a href="<?= Base_URL ?>Productos/ver&id=<?= $productos->Id ?>">
          <?php if ($productos->Imagen != null) : ?>
            <img src="<?= Base_URL ?>uploads/images/<?= $productos->Imagen ?>" alt="<?= $productos->Nombre ?>" srcset="">
          <?php elseif($productos->Imagen == null):  ?>
            <img src="<?= Base_URL ?>assets/img/camiseta.png" alt="Camiseta no disponible" srcset="">
            <?php endif; ?>
          <h2> <?= $productos->Nombre ?></h2>
        </a>
        <p><?= $productos->Precio ?></p>
        <?php if (isset($_SESSION['Admin'])) : ?>
          <a href="<?= Base_URL ?>Productos/Editar&id=<?= $productos->Id ?>" class="button">Editar articulo</a>
        <?php endif; ?>
        <br>
        <a href="<?= Base_URL ?>Productos/ver&id=<?= $productos->Id?>" class="button">Comprar</a>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>


</div>