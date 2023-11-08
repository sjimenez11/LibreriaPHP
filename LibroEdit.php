<?php
    require_once "_RequireOnces.php";

    $id = $_GET["id"];

    $libro = DAO::libroSelectForId($id);
    $rsAutor = DAO::autorSelectAll();
?>



<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Editar <?= $libro->getTitulo() ?></title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?= navbarAdmin() ?>
        <h1>Editar <?= $libro->getTitulo() ?></h1>
        <div class='formulario'>
            <form action='LibroUpdate.php'>
                <input type='hidden' name='id' value='<?= $libro->getId() ?>'>
                <label for='titulo'>Titulo: </label>
                <input type='text' name='titulo' value='<?= $libro->getTitulo() ?>'>
                <br><br>
                <label for='isbn'>Isbn: </label>
                <input type='text' name='isbn' pattern='^[0-9]{13}$' value='<?= $libro->getIsbn() ?>'>
                <br><br>
                <label for='precio'>Precio: </label>
                <input type='text' name='precio' pattern='^[0-9]{1,2}\.? ?[0-9]{1,2}$' value='<?= $libro->getPrecio() ?>'>
                <br><br>
                <label for='autor'>¿Quién lo escribió?</label>
                <select name='autor' id='autor'>
                    <?php foreach ($rsAutor as $autor){
                        $posibleSelected = ($libro->getIdAutor() == $autor->getId()) ? "selected" : "";
                        ?>
                        <option value='<?= $autor->getId() ?>' <?= $posibleSelected ?>><?= $autor->getNombre() ?></option>
                    <?php } ?>

                </select>
                <br><br>
                <input type='submit' value='GUARDAR'>
                <div class='funcionalidad'>
                    <a href='LibroIndex.php'>
                        <button>CANCELAR</button>
                    </a>
                </div>
            </form>
        </div>
    </body>
</html>

