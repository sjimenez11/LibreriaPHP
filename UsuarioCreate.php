<?php
    require_once "_RequireOnces.php";
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Añadir administrador</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?= navbarAdmin() ?>
        <h2>Añadir un administrador</h2>
        <div class='formulario'>
            <form action='UsuarioStore.php'>
                <label for='nickname'>Nickname: </label>
                <input type='text' name='nickname'>
                <br><br>
                <label for='nombre'>Nombre: </label>
                <input type='text' name='nombre'>
                <br><br>
                <label for='email'>Email: </label>
                <input type='text' name='email'>
                <br><br>
                <label for='contrasenia'>Contraseña: </label>
                <input type='password' name='contrasenia'>
                <input type='hidden' name='admin' value='1'>
                <br><br>
                <input type='submit' value='AÑADIR'>
            </form>
            <div class='funcionalidad'>
                <a href='UsuarioIndex.php' id='cancelar'>
                    <button>CANCELAR</button>
                </a>
            </div>
        </div>
    </body>
</html>
