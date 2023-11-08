<?php
    require_once "_RequireOnces.php";


    // Se recogen los datos del formulario de la request, Y NO VIENE id (no tiene que venir).


    $nombre = $_REQUEST["nombre"];
    $email = $_REQUEST["email"];
    $nickname = $_REQUEST["nickname"];
    $contrasenia = $_REQUEST["contrasenia"];
    $admin = $_REQUEST["admin"];

    DAO::usuarioCreate(["nickname"=>$nickname, "nombre"=>$nombre, "email"=>$email, "contrasenia"=>$contrasenia, "admin"=>$admin, "codigoCookie"=>null, "caducidadCodigoCookie"=>null]);

    redireccionar('SesionFormulario.php');

?>



<html>
    <head>
        <meta charset='UTF-8'>
    </head>
    <body>
        <h1>Inserción completada</h1>
    </body>
</html>