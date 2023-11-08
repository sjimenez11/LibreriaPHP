<?php
    require_once "_RequireOnces.php";

    $eliminado = DAO::carritoEliminarProducto($_SESSION["id"], $_REQUEST["idLibro"]);

    if($eliminado != null) redireccionar("Carrito.php");
?>
