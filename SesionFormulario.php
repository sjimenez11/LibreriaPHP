<?php
    require_once "_RequireOnces.php";

    entrarSiSesionIniciada();
?>



<html>
    <head>
        <meta charset='UTF-8'>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Iniciar Sesión</h1>
        <?php if (isset($_REQUEST["error"])) { ?>
            <p style='color: red; margin-left: 10px'>Error de autenticación, inténtelo de nuevo.</p>
        <?php } ?>

        <?php if (isset($_REQUEST["sesionCerrada"])) { ?>
            <p style='color: blue; text-align: center'>Se ha cerrado correctamente la sesión.</p>
        <?php } ?>

        <div class='formulario'>
            <form action='SesionComprobar.php' method='post'>
                <label for='nickname'>Nickname</label>
                <input type='text' name='nickname'>
                <br><br>
                <label for='contrasenia'>Contraseña</label>
                <input type='password' name='contrasenia'>
                <br><br>
                <input type='checkbox' name='recuerdame'>
                <label for='recuerdame' id='labelRecuerdame'>Recuérdame</label>
                <br><br>
                <input type='submit' value='Iniciar sesión'>
                <input type='submit' value='Registrarse' formaction='SesionRegistro.php'>
            </form>
        </div>
    </body>
</html>