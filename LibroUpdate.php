<?php
    require_once "_RequireOnces.php";

    $id = $_GET["id"];
    $titulo = $_GET["titulo"];
    $isbn = $_GET["isbn"];
    $precio = $_GET["precio"];
    $idAutor = $_GET["autor"];

    $rs = DAO::libroEdit(["id"=>$id, "titulo"=>$titulo, "isbn"=>$isbn, "precio"=>$precio, "idAutor"=>$idAutor]);

    if($rs != null) redireccionar("LibroIndex.php");

?>



<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <h1>HA OCURRIDO UN ERROR</h1>
    </body>
</html>
