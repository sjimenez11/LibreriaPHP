<?php
    require_once "_RequireOnces.php";

    $id = $_GET["id"];

    $autor = DAO::autorSelectForId($id);
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?= navbarAdmin() ?>
        <h1>Editar <?= $autor->getNombre() ?></h1>
        <div class='formulario'>
            <form action='AutorUpdate.php'>
                <input type='hidden' name='id' value='<?= $autor->getId() ?>'>
                <label for='nombre'>Nombre: </label>
                <input type='text' name='nombre' value='<?= $autor->getNombre() ?>'>
                <br><br>
                <label for='nacionalidad'>Nacionalidad: </label>
                <input type='text' name='nacionalidad' value='<?= $autor->getNacionalidad() ?>'>
                <br><br>
                <label for='biografia'>Biografia: </label>
                <br><br>
                <textarea type='text' name='biografia' id='biografia' rows='10' cols='40'><?= $autor->getBiografia() ?></textarea>
                <br><br>
                <input type='submit' value='Editar'>
            </form>
            <div class='funcionalidad'>
                <a href='AutorIndex.php'>
                    <button>Cancelar</button>
                </a>
            </div>
        </div>
    </body>
</html>
