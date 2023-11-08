<?php
    require_once "_RequireOnces.php";

    $idUsuario = $_SESSION["id"];

    if (isset($_GET["aumentar"])) {
        $idLibro = $_GET["idLibro"];
        DAO::carritoAumentarCantidad($idUsuario, $idLibro);
    }elseif (isset($_GET["disminuir"])) {
        $idLibro = $_GET["idLibro"];
        DAO::carritoDisminuirCantidad($idUsuario, $idLibro);
    }

    $productosEnCarrito = DAO::carritoSelectForUser($idUsuario);
    $total = DAO::carritoCalcularTotal($productosEnCarrito);
?>



<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Carrito de Compras</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?= navbarCliente() ?>
        <h1>Carrito</h1>

        <?php if (empty($productosEnCarrito)) { ?>
            <p style="text-align: center">Su carrito está vacío.</p>
            <div class='funcionalidad'>
                <a href='LibreriaIndex.php'>
                    <button>Ver libros</button>
                </a>
            </div>
        <?php } else { ?>
            <div class='carrito'>
                <?php foreach ($productosEnCarrito as $producto) {
                    $libro = DAO::LibroSelectForId($producto->getIdLibro());
                    ?>
                    <div class='libroCarrito'>
                        <img src='portadas/<?= $libro->getPortada() ?>' class='imgPortada' alt='Portada de <?= $libro->getTitulo() ?>'>
                        <div class='datosLibro'>
                            <h3><?= $libro->getTitulo() ?></h3>
                            <p>ISBN: <?= $libro->getIsbn() ?></p>
                            <p>Precio unitario: <?= $libro->getPrecio() ?>€</p>
                            <p>Precio total: <p id='precio'><?= ($libro->getPrecio() * $producto->getCantidad()) ?>€</p></p>
                            <div id='funcCarrito'>
                                <?php $disabled = ($producto->getCantidad() === 1) ? 'style="pointer-events: none"' : ''; ?>
                                <a href='Carrito.php?idLibro=<?=$producto->getIdLibro()?>&disminuir' <?= $disabled ?>>
                                    <button class='buttonCantidad'>-</button>
                                </a>
                                <?= $producto->getCantidad() ?>
                                <a href='Carrito.php?idLibro=<?=$producto->getIdLibro()?>&aumentar'>
                                    <button class='buttonCantidad'>+</button>
                                </a>
                            </div>
                            <div class='funcionalidad'>
                                <a href='CarritoEliminarProducto.php?idLibro=<?= $producto->getIdLibro() ?>'>
                                    <button>Eliminar</button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!--            VISUALIZACIÓN DEL TOTAL-->
            <p id='totalCarrito'>Total: <?php echo $total ?>€</p>

<!--            BOTONES (SEGUIR COMPRANDO O HACER PEDIDO)-->
            <div class='funcionalidad'>
                <a href='LibreriaIndex.php'>
                    <button>Seguir comprando</button>
                </a>
                <?php if(!isset($_GET["pedido"])){ ?>
                    <a href='Carrito.php?pedido'>
                        <button>Realizar pedido</button>
                    </a>
                <?php } ?>
            </div>

<!--            FORMULARIO PARA CONFIRMAR PEDIDO-->
            <?php if(isset($_REQUEST["pedido"])){ ?>
                <div class='formulario'>
                    <form action='PedidoRealizado.php' method='post'>
                        <label for='direccion'>Dirección: </label>
                        <input type='text' name='direccion' required>
                        <br><br>
                        <label for='codigoPostal'>Código postal: </label>
                        <input type='text' name='codigoPostal' required pattern='[0-9]{5}'>
                        <br>
                        <div class='funcionalidad'>
                            <button type="submit">Finalizar</button>
                        </div>
                    </form>
                    <div class='funcionalidad'>
                        <a href='Carrito.php'>
                            <button>Cancelar</button>
                        </a>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>

</body>
</html>

