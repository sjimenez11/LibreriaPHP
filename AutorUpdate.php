<?php
    require_once "_RequireOnces.php";

    $id = $_REQUEST["id"];
    $nombre = $_REQUEST["nombre"];
    $nacionalidad = $_REQUEST["nacionalidad"];
    $biografia = $_REQUEST["biografia"];

    $rs = DAO::autorEdit(["id"=>$id, "nombre"=>$nombre, "nacionalidad"=>$nacionalidad, "biografia"=>$biografia]);

    if($rs != null) redireccionar("AutorIndex.php");
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Confirmar editar</title>
    </head>
    <body>
        <h2>Se ha producido un error</h2>
        <a href='AutorIndex.php'>
            <button>Volver al listado de autores</button>
        </a>
    </body>
</html>
