<?php
    require_once "_RequireOnces.php";

    $rs = DAO::autorSelectAll();
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Crear autor</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?= navbarAdmin() ?>
        <h2>Añadir un libro</h2>
        <div class='formulario'>
            <form action='LibroStore.php'>
                <label for='titulo'>Titulo: </label>
                <input type='text' name='titulo' required>
                <br><br>
                <label for='isbn'>Isbn: </label>
                <input type='text' name='isbn' pattern='^[0-9]{13}$' required>
                <br><br>
                <label for='precio'>Precio: </label>
                <input type='text' name='precio' pattern='^[0-9]{1,2}\.? ?[0-9]{1,2}$' required>
                <br><br>
                <label for='autor'>¿Quién lo escribió?</label>
                <select name='autor' id='autor'>
                    <?php foreach ($rs as $autor){?>
                        <option value='<?= $autor->getId() ?>'><?= $autor->getNombre() ?></option>
                    <?php } ?>
                </select>
                <br><br>
                <label for='portada'>Portada*:</label>
                <input type='file' name='portada' id='portada' required>
                <br><br>
                <input type='submit' value='AÑADIR'>
            </form>
            <p style='font-size: small'>*Asegúrate de que la imagen implementada se encuentra dentro de la carpeta "portadas"</p>
            <div class='funcionalidad'>
                <a href='LibroIndex.php'>
                    <button>CANCELAR</button>
                </a>
            </div>
        </div>
    </body>
</html>

