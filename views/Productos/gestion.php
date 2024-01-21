<h1>Gestión de Productos</h1>

<a href="<?= Base_URL ?>Productos/Crear" class="button button-small">
  Crear Producto
</a>

<?php if (isset($_SESSION['producto_eliminado']) && $_SESSION['producto_eliminado'] == 'Complete') : ?>
  <?= '<strong class="alert-green">El producto se ha eliminado correctamente </strong>'; ?>
<?php elseif (isset($_SESSION['producto_eliminado']) && $_SESSION['producto_eliminado'] == 'Failed') : ?>
  <?= '<strong class="alert-red"> Ocurrio un error al eliminar el producto </strong>'; ?>
<?php endif; ?>


<table>
  <tr>
    <th>ID</th>
    <th>NOMBRE</th>
    <th>Precio</th>
    <th>Stock</th>
    <th>Acciones</th>
  </tr>

  <?php if (!empty($todos)) : ?>
    <?php while ($productos = $todos->fetch_object()) : ?>
      <tr>
        <td><?= $productos->Id ?></td>
        <td><?= $productos->Nombre ?></td>
        <td><?= $productos->Precio ?></td>
        <td><?= $productos->Stock ?></td>
        <td>
          <a href="<?= Base_URL ?>Productos/Editar&id=<?= $productos->Id ?>" class="button button-gestion">Editar</a>
          <a href="<?= Base_URL ?>Productos/Eliminar&id=<?= $productos->Id ?>" class="button button-gestion button-red">Eliminar</a>
        </td>
      </tr>
    <?php endwhile; ?>
  <?php endif; ?>
</table>


<?php utils::delete_session('producto_eliminado'); ?>