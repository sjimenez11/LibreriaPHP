<?php
    require_once "_Varios.php";
    require_once "_Sesion.php";

    entrarSiSesionIniciada();
?>



<html>
    <head>
        <meta charset='UTF-8'>
        <title>Registrarse</title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
        <h1>¡Regístrate!</h1>
        <?php if (isset($_REQUEST["error"])) { ?>
            <p style="color: red">Error de autenticación, inténtelo de nuevo.</p>
        <?php } ?>
        <?php if (isset($_REQUEST["sesionCerrada"])) { ?>
            <p style="color: blue">Se ha cerrado correctamente la sesión.</p>
        <?php } ?>

        <div class='formulario'>
            <form action='SesionGuardarRegistro.php' method='post'>
                <label for='nickname'>Nickname</label>
                <input type='text' name='nickname'>
                <br><br>
                <label for='nombre'>Nombre</label>
                <input type='text' name='nombre'>
                <br><br>
                <label for='email'>Email</label>
                <input type='text' name='email'>
                <br><br>
                <input type='hidden' name='admin' value='0'>
                <label for='contrasenia'>Contraseña</label>
                <input type='password' name='contrasenia'>
                <br><br>
                <input type='submit' value='Registrarse'>
                <input type='submit' value='Iniciar sesión' formaction='SesionFormulario.php'>
            </form>
        </div>
    </body>

</html>