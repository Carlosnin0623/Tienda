<h1>Gestionar categorias</h1>


<a href="<?=Base_URL?>Categorias/Crear" class="button button-small">
  Crear Categoria
</a>


<table>
 <tr>
   <th>ID</th>
   <th>NOMBRE</th>
 </tr>
 
<?php if (!empty($todos)) : ?>
    <?php while ($categorias = $todos->fetch_object()) : ?>
          <tr>
            <td><?= $categorias->Id ?></td>
            <td><?= $categorias->Nombre ?></td>
          </tr>
    <?php endwhile; ?>
<?php endif; ?>
</table>