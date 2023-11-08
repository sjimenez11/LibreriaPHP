<?php
    require_once "_RequireOnces.php";
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Crear autor</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?= navbarAdmin() ?>
        <h2>Añadir un autor</h2>
        <div class='formulario'>
            <form action='AutorStore.php'>
                <label for='nombre'>Nombre: </label>
                <input type='text' name='nombre'>
                <br><br>
                <label for='nacionalidad'>Nacionalidad: </label>
                <input type='text' name='nacionalidad'>
                <br><br>
                <label for='biografia'>Biografia: </label>
                <br><br>
                <textarea name='biografia' id='biografia' rows='10' cols='40'></textarea>
                <br><br>
                <input type='submit' value='AÑADIR'>
            </form>
            <div class='funcionalidad'>
                <a href='AutorIndex.php' id='cancelar'>
                    <button>CANCELAR</button>
                </a>
            </div>
        </div>
    </body>
</html>
