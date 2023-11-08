<?php function navbarAdmin(){ ?>
    <nav class="menu">
        <ul id="ulMenu">
            <li><a href="LibroIndex.php">Libros</a></li>
            <li><a href="AutorIndex.php">Autores</a></li>
            <li><a href='UsuarioIndex.php'>Usuarios</a></li>
            <li id='perfil'><a href='UsuarioPerfil.php'>Mi perfil</a></li>
        </ul>
    </nav>
<?php } ?>

<?php function navbarCliente(){ ?>
<!--    <nav class="menu">-->
<!--        <ul id="ulMenu">-->
<!--            <li><a href="LibroIndex.php">Libros</a></li>-->
<!--            <li class="submenu">-->
<!--                <a href="">Tienda</a>-->
<!--                <ul id="ulSubmenu">-->
<!--                    <li class="producto"><a href="">Producto 1</a></li>-->
<!--                    <li class="producto"><a href="">Producto 2</a></li>-->
<!--                    <li class="producto"><a href="">Producto 3</a></li>-->
<!--                </ul>-->
<!--            </li>-->
<!--            <li><a href="">Carrito</a></li>-->
<!--            <li><a href="">Perfil</a></li>-->
<!--        </ul>-->
<!--    </nav>-->
    <nav class="menu">
        <ul id="ulMenu">
            <li><a href="LibreriaIndex.php">Libreria</a></li>
            <li><a href="AutorIndexClientes.php">Autores</a></li>
            <li><a href='Carrito.php'>Carrito</a></li>
            <li id='perfil'><a href='UsuarioPerfil.php'>Mi perfil</a></li>
        </ul>
    </nav>
<?php } ?>
