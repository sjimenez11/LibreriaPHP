<?php
    require_once "_RequireOnces.php";

    $id = $_GET["id"];

    $autor = DAO::autorSelectForId($id);
    $libros = DAO:: libroSelectForAutor($id);
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Confirmacion</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?= navbarAdmin() ?>
        <h1>¿Estás seguro de que quieres eliminar a <?= $autor->getNombre() ?>?</h1>
        <?php if(!empty($libros)) {?>
            <h3>Por ende se eliminarán los libros siguientes libros: </h3>
            <?php foreach ($libros as $libro){ ?>
                <h4><?= $libro->getTitulo() ?></h4>
                <p>ISBN: <?= $libro->getIsbn() ?></p>
            <?php }
        }
        ?>

        <div class='funcionalidad'>
            <a href='AutorDelete.php?id=<?= $autor->getId() ?>'>
                <button>ELIMINAR</button>
            </a>
            <a href='AutorIndex.php'>
                <button>CANCELAR</button>
            </a>
        </div>
    </body>
</html>