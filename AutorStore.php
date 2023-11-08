<?php
    require_once "_RequireOnces.php";

    $nombre = $_REQUEST["nombre"];
    $nacionalidad = $_REQUEST["nacionalidad"];
    $biografia = $_REQUEST["biografia"];

    $rs = DAO::autorCreate(["nombre"=>$nombre, "nacionalidad"=>$nacionalidad, "biografia"=>$biografia]);

    if($rs !== null) redireccionar("AutorIndex.php");
?>