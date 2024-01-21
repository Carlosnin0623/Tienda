<h1>Carrito de compra </h1>


<?php if (isset($carrito)) : ?>
   <table class="table">
      <thead>
         <tr>
            <th>Imagen Producto</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Eliminar</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($carrito as $indice => $elemento) :
            $producto = $elemento['Producto'];

         ?>
            <tr>
               <td>
                  <?php if ($producto->Imagen != null) : ?>
                     <img src="<?= Base_URL ?>uploads/images/<?= $producto->Imagen ?>" alt="" srcset="" class="img_carrito">
                  <?php else : ?>
                     <img src="<?= Base_URL ?>assets/img/camiseta.png" alt="camiseta" srcset="" class="img_carrito">
                  <?php endif; ?>
               </td>

               <td>
                  <a href="<?= Base_URL ?>Productos/ver&id=<?= $producto->Id ?>">
                     <?= $producto->Nombre ?>
                  </a>

               </td>

               <td><?= $producto->Precio ?></td>
               <td>
                  <div class="updown-unidades">
                     <a href="<?= Base_URL ?>Carrito/up&index=<?= $indice ?>" class="button button-carrito button-red">Aumentar</a>
                     <?= $elemento['Unidades'] ?>
                     <a href="<?= Base_URL ?>Carrito/down&index=<?= $indice ?>" class="button button-carrito button-red">Disminuir</a>
                  </div>

               </td>

               <td>

                  <a href="<?= Base_URL ?>Carrito/Remove&index=<?= $indice ?>" class="button button-carrito button-red">Eliminar Producto</a>

               </td>
            </tr>
         <?php endforeach; ?>
      </tbody>

   </table>
   <?php ob_start();
   $stats = utils::statsCarrito() ?>

   <div class="delete-carrito">
      <a href="<?= Base_URL ?>Carrito/DeleteAll" class="button button-delete button-red">Vaciar Carrito</a>
   </div>
   <br>

   <div class="total-carrito">
      <h3 class="pedido-precio">Total: RD$<?= $stats['Total']; ?></h3>
      <a href="<?= Base_URL ?>Pedidos/hacer" class="button button-pedido">Hacer pedido </a>
   </div>

<?php else : ?>
   <?= 'No hay nada en el carrito' ?>
<?php endif; ?>