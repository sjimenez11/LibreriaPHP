<?php

    require_once "_RequireOnces.php";

    $id = $_REQUEST["id"];
    $nickname = $_REQUEST["nickname"];
    $nombre = $_REQUEST["nombre"];
    $email = $_REQUEST["email"];

    $filasAfectadas = DAO::usuarioEdit(["id"=>$id, "nickname"=>$nickname, "nombre"=>$nombre, "email"=>$email]);

    if($filasAfectadas != null) redireccionar("UsuarioPerfil.php");
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Fallo</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h3>Se ha producido un error al actualizar</h3>
        <a href='UsuarioPerfil.php'>
            <button>VOLVER AL PERFIL</button>
        </a>
    </body>
</html>
