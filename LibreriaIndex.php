<?php
    require_once "_RequireOnces.php";

    salirSiSesionFalla();

    $rs = DAO::libroSelectAll();
?>


<!doctype html>
<html lang="en">
    <head>
        <title>Librería</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php navbarCliente(); ?>
        <h1>Librería</h1>
        <div class='contenedor'>
            <?php foreach ($rs as $libro){ ?>
                <div class='rs'>
                    <img src='portadas/<?= $libro->getPortada() ?>' class='imgPortada' alt='portada'>
                    <h3><?= $libro->getTitulo() ?></h3>
                    <p><a href='AutorShow.php?id=<?= $libro->getIdAutor() ?>'><?= $libro->getNombreAutor() ?></a></p>
                    <p>ISBN: <?= $libro->getIsbn() ?></p>
                    <p id='precio'><?= $libro->getPrecio() ?> €</p>
                    <div class='funcionalidad'>
                        <a href='CarritoAñadir.php?idLibro=<?= $libro->getId() ?>'>
                            <button>Añadir al carrito</button>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </body>
</html>


