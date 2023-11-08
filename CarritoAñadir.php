<?php

    require_once "_RequireOnces.php";

    $idUsuario = $_SESSION["id"];
    $idLibro = $_REQUEST["idLibro"];

    $annadido = DAO::carritoAnnadir(["idUsuario"=>$idUsuario, "idLibro"=>$idLibro]);


    if($annadido != null) redireccionar("Carrito.php");
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Error añadir al carrito</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h3>No se ha podido añadir al carrito</h3>
        <a href='LibroIndex.php'>
            <button>LISTA LIBROS</button>
        </a>
    </body>
</html>
