  <!-- Barra Lateral -->


  <aside id="lateral">

      <div id="carrito" class="block-aside">
          <h3>Mi carrito</h3>

          <ul>
            <?php ob_start(); $stats = utils::statsCarrito()?>
              <li><a href="<?= Base_URL ?>Carrito/index">Productos (<?= $stats['Count'] ?>)</a></li>
              <li><a href="<?= Base_URL ?>Carrito/index">Total: RD$(<?= $stats['Total'] ?>) </a></li>
              <li><a href="<?= Base_URL ?>Carrito/index">Ver Carrito</a></li>
           
          </ul>

      </div>
      <!-- Bloque Login -->
      <div id="login" class="block-aside">
          <?php if (!isset($_SESSION['usuario'])) : ?>
              <h3>Entrar a la web</h3>
              <form action="<?= Base_URL ?>Usuarios/Login" method="post" enctype="multipart/form-data">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email">

                  <label for="password">Contraseña</label>
                  <input type="password" name="password" id="password">


                  <input type="submit" value="Enviar">
              </form>

          <?php else : ?>
              <h3><?= $_SESSION['usuario']->Nombre . ' ' . $_SESSION['usuario']->Apellidos ?></h3>
              <h3>Rol: <?= $_SESSION['usuario']->Rol ?></h3>
          <?php endif;  ?>




          <ul>
              <?php if (isset($_SESSION['Admin'])) : ?>
                  <li><a href="<?= Base_URL ?>Categorias/index">Gestionar Categorias</a></li>
                  <li><a href="<?= Base_URL ?>Productos/gestion">Gestionar Productos</a></li>
                  <li><a href="<?= Base_URL ?>Pedidos/gestion">Gestionar pedidos</a></li>
              <?php endif; ?>

              <?php if (isset($_SESSION['usuario'])) : ?>
                  <li><a href="<?= Base_URL ?>Pedidos/mis_pedidos">Mis pedidos</a></li>
                  <li><a href="<?= Base_URL ?>Usuarios/Logout">Cerrar Sessión</a></li>
              <?php else : ?>
                  <li><a href="<?= Base_URL ?>Usuarios/Registro">Registrate Aquí</a></li>
              <?php endif; ?>
          </ul>


      </div>

  </aside> <!-- FIN Barra Lateral -->

  <div id="central"> <!-- Contenido central -->

