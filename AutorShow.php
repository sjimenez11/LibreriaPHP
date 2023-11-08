<?php
    require_once "_RequireOnces.php";

    $idAutor = $_REQUEST["id"];

    $rsAutor = DAO::autorSelectForId($idAutor);
    $rsLibro = DAO::libroSelectForAutor($idAutor);
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?= $rsAutor->getNombre() ?></title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php if($_SESSION["admin"]) navbarAdmin();
        else navbarCliente();?>

        <h1><?= $rsAutor->getNombre() ?></h1>
        <p style='text-align: center'><?= $rsAutor->getBiografia() ?></p>

        <div class='contenedor'>
            <?php foreach ($rsLibro as $libro){ ?>
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
        <div class='funcionalidad'>
            <?php $redireccion = ($_SESSION["admin"]) ? 'AutorIndex.php' : 'AutorIndexClientes.php'; ?>
            <a href='<?= $redireccion ?>'>
                <button>Listado de autores</button>
            </a>
        </div>
    </body>
</html>

