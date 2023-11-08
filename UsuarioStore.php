<?php
    require_once "_RequireOnces.php";

    $nickname = $_REQUEST["nickname"];
    $nombre = $_REQUEST["nombre"];
    $email = $_REQUEST["email"];
    $contrasenia = $_REQUEST["contrasenia"];
    $admin = $_REQUEST["admin"];

    $rs = DAO::usuarioCreate(["nickname"=>$nickname, "nombre"=>$nombre, "email"=>$email, "contrasenia"=>$contrasenia, "admin"=>$admin]);

    if($rs !== null) redireccionar("UsuarioIndex.php");
?>