<?php
    require_once "_RequireOnces.php";

    $direccion = $_POST["direccion"];
    $codigoPostal = $_POST["codigoPostal"];

    $idPedido = DAO::pedidoCreate(["idUsuario"=>$_SESSION["id"], "direccion"=>$direccion, "codigoPostal"=>$codigoPostal]);

    $productosAnnadidos = DAO::detallesPedidoAnnadir($_SESSION["id"], $idPedido);

    if($productosAnnadidos != 0)
        DAO::carritoReset($_SESSION["id"]);

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?= navbarAdmin() ?>
        <h2>¡Pedido realizado con éxito!</h2>
        <h4 style='text-align: center'>Muchas gracias por confiar en nosotros</h4>
        <p style='text-align: center'>Puede ver su pedido pulsando el siguiente botón:</p>
        <div class='funcionalidad'>
            <a href='UsuarioPerfil.php'>
                <button>Ver mi pedido</button>
            </a>
        </div>
    </body>
</html>
