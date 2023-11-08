<?php
    require_once "_RequireOnces.php";

    $rs = DAO::usuarioSelectAll();
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Usuarios</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?= navbarAdmin() ?>
        <h1>Usuarios</h1>
        <table>
            <tr>
                <th>Nickname</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Admin</th>
            </tr>
            <?php foreach ($rs as $usuario){ ?>
                <tr>
                    <td><?= $usuario->getNickname() ?></td>
                    <td><?= $usuario->getNombre() ?></td>
                    <td><?= $usuario->getEmail() ?></td>
                    <td><?= $usuario->getAdmin() ?></td>
                </tr>
            <?php } ?>
            </tr>
        </table>
        <br>
        <?php if ($_SESSION["nickname"] === "sara9"){ ?>
            <div class='funcionalidad'>
                <a href='UsuarioCreate.php'>
                    <button>Añadir un administrador</button>
                </a>
            </div>
        <?php } ?>
    </body>
</html>

