<?php
    require_once "_RequireOnces.php";

    $id = $_GET["id"];

    $autor = DAO::libroSelectForId($id);
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirmación</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>¿Estás seguro de que quieres borrar <?= $autor->getTitulo() ?>?</h2>
    <div class='funcionalidad'>
        <a href='LibroDelete.php?id=<?= $autor->getId() ?>'>
            <button>ELIMINAR</button>
        </a>
        <a href='LibroIndex.php'>
            <button>CANCELAR</button>
        </a>
    </div>
</body>
</html>
