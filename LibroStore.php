<?php
    require_once "_RequireOnces.php";

    $titulo = $_REQUEST["titulo"];
    $isbn = $_REQUEST["isbn"];
    $precio = $_REQUEST["precio"];
    $idAutor = $_REQUEST["autor"];
    $portada = $_REQUEST["portada"];

    $rs = DAO::libroCreate(["titulo"=>$titulo, "isbn"=>$isbn, "precio"=>$precio, "idAutor"=>$idAutor, "portada"=>$portada]);

    if($rs !== null) redireccionar("LibroIndex.php");
?>