<?php
    require_once "_RequireOnces.php";
    $idUsuario = $_SESSION["id"];

    $usuario = DAO::usuarioSelectForId($idUsuario);

    $pedidos = DAO::pedidoSelectForIdUsuario($_SESSION["id"]);
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Mi perfil</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php if($_SESSION["admin"]) navbarAdmin();
        else navbarCliente();?>

        <h1><?= $usuario->getNombre() ?></h1>
        <div class='formulario'>
            <form action='UsuarioEdit.php'>
                <input type='hidden' name='id' value='<?= $usuario->getId() ?>'>
                <label for='nickname'>Nickname: </label>
                <input type='text' name='nickname' value='<?= $usuario->getNickname() ?>'>
                <br><br>
                <label for='nombre'>Nombre: </label>
                <input type='text' name='nombre' value='<?= $usuario->getNombre() ?>'>
                <br><br>
                <label for='email'>Email: </label>
                <input type='text' name='email' value='<?= $usuario->getEmail() ?>'>
                <br><br>
                <input type='submit' value='Guardar cambios'>
            </form>
            <div class='funcionalidad'>
                <a href='SesionCerrar.php'>
                    <button>Cerrar sesión</button>
                </a>
            </div>
        </div>
        <div class='pedidos'>
            <?php if (!empty($pedidos)){ ?>
                <h3>Pedidos</h3>
                <?php foreach ($pedidos as $pedido) {
                        $fechaPedido = $pedido["fechaPedido"];
                        echo "<p style='text-align: center'>" . date("d M Y -- H:i:s", strtotime($fechaPedido)) . "</p>";
                    ?>
                    <div class="carrito">
                        <?php $detalles = DAO::detallesPedidoSelectForIdPedido($pedido["id"]); ?>
                        <?php foreach ($detalles as $libro) { ?>
                            <div class='libroCarrito'>
    <!--                    [0]=> string(13) "El resplandor" ------- titulo
                            [1]=> string(13) "9788490328729" ------- isbn
                            [2]=> float(8.21) ---------------------- precio
                            [3]=> int(1) --------------------------- cantidad
                            [4]=> string(16) "ElResplandor.jpg" ---- portada
                            -->
                                <img src='portadas/<?= $libro[4] ?>' class='imgPortada' alt='Portada de <?= $libro[0] ?>'>
                                <div class='datosLibro'>
                                    <h3><?= $libro[0] ?></h3>
                                    <p>ISBN: <?= $libro[1] ?></p>
                                    <p>Precio unitario: <?= $libro[2] ?>€</p>
                                    <p>Cantidad: <?= $libro[3] ?></p>
                                    <p>Precio total: <p id='precio'><?= ($libro[2] * $libro[3]) ?>€</p></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php }
            } ?>
        </div>

    </body>
</html>
