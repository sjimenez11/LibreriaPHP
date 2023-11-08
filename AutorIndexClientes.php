<?php
    require_once "_RequireOnces.php";

    $rs = DAO::autorSelectAll();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Autores</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php navbarCliente(); ?>
        <h1>Autores</h1>
        <div class='contenedor'>
            <?php foreach ($rs as $autor) { ?>
                <div class='rs'>
                    <h3><a href='AutorShow.php?id=<?= $autor->getId() ?>' style='text-decoration: underline'><?= $autor->getNombre() ?></a></h3>
                    <p><?= $autor->getNacionalidad() ?></p>
                    <p><?= $autor->getBiografia() ?></p>
                </div>
            <?php } ?>
        </div>
    </body>
</html>
