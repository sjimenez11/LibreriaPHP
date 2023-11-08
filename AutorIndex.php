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
        <?php navbarAdmin(); ?>
        <h1>Autores</h1>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Nacionalidad</th>
                <th>Biografía</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
            <?php foreach ($rs as $autor) { ?>
                <tr>
                    <td>
                        <a href='AutorShow.php?id=<?= $autor->getId() ?>'><?= $autor->getNombre() ?></a>
                    </td>
                    <td><?= $autor->getNacionalidad() ?></td>
                    <td><?= $autor->getBiografia() ?></td>
                    <td><a href='AutorEdit.php?id=<?= $autor->getId() ?>'>Edit</a></td>
                    <td><a href='AutorConfirmacionDelete.php?id=<?= $autor->getId() ?>'>X</a></td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <div class='funcionalidad'>
            <a href='AutorCreate.php'>
                <button>Añadir un autor</button>
            </a>
        </div>
    </body>
</html>


