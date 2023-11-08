<?php
    require_once "_RequireOnces.php";

    salirSiSesionFalla();


    $rs = DAO::libroSelectAll();
?>


<!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Libros</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php navbarAdmin(); ?>
        <h1>Libros</h1>
        <table>
            <tr>
                <th>Portada</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>ISBN</th>
                <th>Precio</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
            <?php foreach ($rs as $libro){ ?>
                <tr>
                    <td><img src='portadas/<?= $libro->getPortada() ?>' class='imgPortada'></td>
                    <td><?= $libro->getTitulo() ?></td>
                    <td><a href='AutorShow.php?id=<?= $libro->getIdAutor() ?>'><?= $libro->getNombreAutor() ?></a></td>
                    <td><?= $libro->getIsbn() ?></td>
                    <td><?= $libro->getPrecio() ?></td>
                    <td><a href='LibroEdit.php?id=<?= $libro->getId() ?>'>Edit</a></td>
                    <td><a href='LibroConfirmacionDelete.php?id=<?= $libro->getId() ?>'>X</a></td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <div class='funcionalidad'>
            <a href='LibroCreate.php'>
                <button>Añadir un libro</button>
            </a>
        </div>
    </body>
</html>
