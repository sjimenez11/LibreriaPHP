<?php
    require_once "_RequireOnces.php";

    $id = $_GET["id"];

    $rs = DAO::autorDelete($id);

    if($rs != null) redireccionar("AutorIndex.php");
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Error al borrar</title>
    </head>
    <body>
        <h2>Se ha producido un error</h2>
        <a href='AutorIndex.php'>
            <button>Volver al listado de autores</button>
        </a>
    </body>
</html>
