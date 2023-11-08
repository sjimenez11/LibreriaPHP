<?php
    require_once "_Varios.php";
    require_once "_Sesion.php";

    entrarSiSesionIniciada();

    $usuario = obtenerUsuarioPorContrasenia($_REQUEST["nickname"], $_REQUEST["contrasenia"], $_REQUEST["admin"]);

    if ($usuario) { // Equivale a if ($usuario != null)
        generarSesionRAM($usuario);

        if (isset($_REQUEST["recuerdame"])) {
            generarRenovarSesionCookie();
        }
        if($_SESSION["admin"]) redireccionar("LibroIndex.php");
        else redireccionar("LibreriaIndex.php");
    } else {
        redireccionar("SesionFormulario.php?error");
    }
?>