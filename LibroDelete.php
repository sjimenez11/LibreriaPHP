<?php
    require_once "_RequireOnces.php";

    $id = $_GET["id"];

    $rs = DAO::libroDelete($id);
    if($rs != null) redireccionar("LibroIndex.php");
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Eliminar</title>
    </head>
    <body>
        <h2>HA OCURRIDO UN ERROR AL BORRAR EL LIBRO</h2>
    </body>
</html>
