<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Camisetas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= Base_URL ?>assets/css/styles.css">
</head>

<body>
    <!-- Contenedor -->
    <div id="container">

        <!-- Cabezera -->

        <header id="header">

            <div id="logo">

                <img src="<?= Base_URL ?>assets/img/camiseta.png" alt="camiseta logo">
                <a href="index.php">
                    Tienda de Camisetas
                </a>

            </div>


        </header> <!-- FIN Cabezera -->


        <!-- Menu -->

        <nav id="menu">
            <ul>
                <li>
                    <a href="<?=Base_URL?>">Inicio</a>
                </li>
                <?php $categoria = utils::Todas_las_categorias();
                while ($todas = $categoria->fetch_object()) : ?>
                    <li>
                        <a href=<?=Base_URL.'Categorias/productos_categoria&Id='.$todas->Id?>><?=$todas->Nombre?></a>
                    </li>
                <?php endwhile; ?>
            </ul>

        </nav> <!-- FIN Menu -->


        <div id="content"> <!-- Inicio content -->