<?php

    require_once "_Clases.php";
    require_once "_Varios.php";

    class DAO
    {
        private static ?PDO $conn = null;

        private static function obtenerPdoConexionBD(): PDO
        {
            $servidor = "localhost";
            $bd = "libreria";
            $identificador = "root";
            $contrasenia = "";
            $opciones = [
                PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode for "real" prepared statements
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
            ];

            try {
                $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenia, $opciones);
            } catch (Exception $e) {
                error_log("Error al conectar: " . $e->getMessage());
                echo "\n\nError al conectar:\n" . $e->getMessage();
                header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            }

            return $pdo;
        }

        private static function garantizarConexion()
        {
            if (Self::$conn == null) {
                Self::$conn = Self::obtenerPdoConexionBd();
            }
        }

        //lo tengo que poner en publico para que la funcion obtenerUsuarioPorContrasenia de _Sesion pueda funcionar
        public static function ejecutarConsulta(string $sql, array $parametros): array
        {
            Self::garantizarConexion();

            $select = Self::$conn->prepare($sql);
            $select->execute($parametros);
            return $select->fetchAll(); // Se devuelve "el $rs"
        }

        //Devuelve el id autogenerado, si ha habido un error, entonces 'null'
        private static function ejecutarInsert(string $sql, array $parametros): ?int
        {
            Self::garantizarConexion();

            $insert = Self::$conn->prepare($sql);
            $sqlConExito = $insert->execute($parametros);

            if (!$sqlConExito) return null;
            else return Self::$conn->lastInsertId();
        }

        //devuelve el número de filas afectadas; devolverá 'null' si ha habido un error
        private static function ejecutarUpdel(string $sql, array $parametros): ?int
        {
            Self::garantizarConexion();

            $updel = Self::$conn->prepare($sql);
            $sqlConExito = $updel->execute($parametros);

            if (!$sqlConExito) return null;
            else return $updel->rowCount();
        }


        //--------------------USUARIO--------------------
        public static function usuarioSelectAll(): array
        {
            $sql = "SELECT * FROM usuario ORDER BY admin DESC";
            $rs = Self::ejecutarConsulta($sql, []);

            $datos = [];
            foreach ($rs as $fila) {
                $usuario = Self::usuarioCrearDesdeFila($fila);
                array_push($datos, $usuario);
            }

            return $datos;
        }

        public static function usuarioSelectForId(int $id): Usuario
        {
            $sql = "SELECT * FROM usuario WHERE id=?";
            $rs = Self::ejecutarConsulta($sql, [$id]);

            return Self::usuarioCrearDesdeFila($rs[0]);
        }

        private static function usuarioCrearDesdeFila(array $fila): Usuario
        {
            return new Usuario($fila["id"], $fila["nickname"], $fila["nombre"], $fila["email"], $fila["contrasenia"], $fila["admin"]);
        }

        public static function usuarioCreate(array $fila): ?int
        {
            $sql = "INSERT INTO usuario (nickname, nombre, email, contrasenia, admin, codigoCookie, caducidadCodigoCookie) VALUES(?, ?, ?, ?, ?, ?, ?)";
            return Self::ejecutarInsert($sql, [$fila["nickname"], $fila["nombre"], $fila["email"], $fila["contrasenia"], $fila["admin"], $fila["codigoCookie"], $fila["caducidadCodigoCookie"]]);
        }

        public static function usuarioEdit(array $fila): ?int
        {
            $sql = "UPDATE usuario SET nickname=?, nombre=?, email=? WHERE id=?";

            return Self::ejecutarUpdel($sql, [$fila["nickname"], $fila["nombre"], $fila["email"], $fila["id"]]);

        }





        //--------------------AUTOR--------------------
        public static function autorSelectAll(): array
        {
            $sql = "SELECT * FROM autor";
            $rs = Self::ejecutarConsulta($sql, []);

            $datos = [];
            foreach ($rs as $fila) {
                $autor = Self::autorCrearDesdeFila($fila);
                array_push($datos, $autor);
            }

            return $datos;
        }

        //no hay que devolver un array porque solo se busca devolver 1 autor
        public static function autorSelectForId(int $id): Autor
        {
            $sql = "SELECT * FROM autor WHERE id=?";
            $rs = Self::ejecutarConsulta($sql, [$id]);

            return Self::autorCrearDesdeFila($rs[0]);
        }

        private static function autorCrearDesdeFila(array $fila): Autor
        {
            return new Autor($fila["id"], $fila["nombre"], $fila["nacionalidad"], $fila["biografia"]);
        }

        public static function autorCreate(array $fila): ?int
        {
            $sql = "INSERT INTO autor (nombre, nacionalidad, biografia) VALUES(?, ?, ?)";
            return Self::ejecutarInsert($sql, [$fila["nombre"], $fila["nacionalidad"], $fila["biografia"]]);
        }

        //devuelve el número de filas afectadas; devolverá 'null' si ha habido un error
        public static function autorDelete($id): ?int
        {
            $sql = "DELETE FROM autor WHERE id=?";
            return Self::ejecutarUpdel($sql, [$id]);
        }

        public static function autorEdit(array $fila): ?int
        {
            $sql = "UPDATE autor SET nombre=?, nacionalidad=?, biografia=? WHERE id=?";
            return Self::ejecutarUpdel($sql, [$fila["nombre"], $fila["nacionalidad"], $fila["biografia"], $fila["id"]]);
        }





        //--------------------LIBRO--------------------
        public static function libroSelectAll(): array
        {
            $sql = "SELECT * FROM libro";
            $rs = Self::ejecutarConsulta($sql, []);

            $datos = [];
            foreach ($rs as $fila) {
                $libro = Self::libroCrearDesdeFila($fila);
                array_push($datos, $libro);
            }

            return $datos;
        }

        private static function libroCrearDesdeFila(array $fila): Libro
        {
            return new Libro($fila["id"], $fila["titulo"], $fila["isbn"], $fila["precio"], $fila["idAutor"], $fila["portada"]);
        }

        public static function libroCreate(array $fila): ?int
        {
            $sql = "INSERT INTO libro (titulo, isbn, precio, idAutor, portada) VALUES(?, ?, ?, ?, ?)";

            return Self::ejecutarInsert($sql, [$fila["titulo"], $fila["isbn"], $fila["precio"], $fila["idAutor"], $fila["portada"]]);
        }

        public static function libroSelectForId(int $id): Libro
        {
            $sql = "SELECT * FROM libro WHERE id=?";
            $rs = Self::ejecutarConsulta($sql, [$id]);

            return Self::libroCrearDesdeFila($rs[0]);
        }

        public static function libroSelectForAutor(int $idAutor): array
        {
            $sql = "SELECT * FROM libro WHERE idAutor=?";
            $rs = Self::ejecutarConsulta($sql, [$idAutor]);

            $libros = [];
            foreach ($rs as $fila) {
                $libro = Self::libroCrearDesdeFila($fila);
                array_push($libros, $libro);
            }

            return $libros;
        }

        public static function libroEdit(array $fila): ?int
        {
            $sql = "UPDATE libro SET titulo=?, isbn=?, precio=?, idAutor=? WHERE id=?";

            return Self::ejecutarUpdel($sql, [$fila["titulo"], $fila["isbn"], $fila["precio"], $fila["idAutor"], $fila["id"]]);
        }

        public static function libroDelete(int $id): ?int
        {
            $sql = "DELETE FROM libro WHERE id=?";

            return Self::ejecutarUpdel($sql, [$id]);
        }




        //--------------------CARRITO--------------------
        public static function carritoSelectForUser(int $idUsuario): array
        {
            $sql = "SELECT * FROM carrito WHERE idUsuario=?";
            $rs = Self::ejecutarConsulta($sql, [$idUsuario]);

            $datos = [];
            foreach ($rs as $fila) {
                $producto = Self::carritoCrearDesdeFila($fila);
                array_push($datos, $producto);
            }

            return $datos;
        }
        private static function carritoCrearDesdeFila(array $fila): Carrito
        {
            return new Carrito($fila["id"], $fila["idUsuario"], $fila["idLibro"], $fila["cantidad"]);
        }

        public static function carritoAnnadir(array $fila): ?int
        {
            $sql = "INSERT INTO carrito (idUsuario, idLibro) VALUES(?, ?)";

            return Self::ejecutarInsert($sql, [$fila["idUsuario"], $fila["idLibro"]]);
        }
        public static function carritoCalcularTotal($productosEnCarrito)
        {
            $total = 0;
            foreach ($productosEnCarrito as $producto) {
                $libro = DAO::LibroSelectForId($producto->getIdLibro());
                $total += $libro->getPrecio() * $producto->getCantidad();
            }
            return $total;
        }
        public static function carritoAumentarCantidad(int $idUsuario, int $idLibro): void
        {
            $sql = "UPDATE carrito SET cantidad = cantidad + 1 WHERE idUsuario = ? AND idLibro = ?";
            Self::ejecutarUpdel($sql, [$idUsuario, $idLibro]);
        }
        public static function carritoDisminuirCantidad(int $idUsuario, int $idLibro): void
        {
            $sql = "UPDATE carrito SET cantidad = cantidad - 1 WHERE idUsuario = ? AND idLibro = ?";
            Self::ejecutarUpdel($sql, [$idUsuario, $idLibro]);
        }
        public static function carritoEliminarProducto(int $idUsuario, int $idLibro): ?int
        {
            $sql = "DELETE FROM carrito WHERE idUsuario = ? AND idLibro = ?";
            return Self::ejecutarUpdel($sql, [$idUsuario, $idLibro]);
        }
        public static function carritoReset(int $idUsuario){
            $sql = "DELETE FROM carrito WHERE idUsuario=?";
            return Self::ejecutarUpdel($sql, [$idUsuario]);
        }





        //----------------------PEDIDO----------------
        public static function pedidoCreate(array $fila): ?int
        {
            $sql = "INSERT INTO pedido (idUsuario, direccion, codigoPostal) VALUES (?, ?, ?)";
            return Self::ejecutarInsert($sql, [$fila["idUsuario"], $fila["direccion"], $fila["codigoPostal"]]);
        }

        public static function pedidoCrearDesdeFila(array $fila): Pedido{
            return new Pedido($fila["id"], $fila["idUsuario"], $fila["fechaPedido"], $fila["direccion"], $fila["codigoPostal"]);
        }
        public static function pedidoSelectForIdUsuario(int $idUsuario): array
        {
            $sql = "SELECT id, fechaPedido FROM pedido WHERE idUsuario=?";
            return Self::ejecutarConsulta($sql, [$idUsuario]);
        }




        //--------------------DETALLES PEDIDO--------------------
        public static function detallesPedidoAnnadir(int $idUsuario, int $idPedido): int
        {
            $carrito = Self::carritoSelectForUser($idUsuario);

            $productosAnnadidos = 0;

            foreach ($carrito as $libro) {
                $sql = "INSERT INTO detallesPedido (idPedido, idLibro, cantidad, precioUnitario) VALUES (?, ?, ?, ?)";
                $precioUnitario = Self::libroSelectForId($libro->getIdLibro()) -> getPrecio();
                if(Self::ejecutarInsert($sql, [$idPedido, $libro->getIdLibro(), $libro->getCantidad(), $precioUnitario]) != null)
                    $productosAnnadidos = $productosAnnadidos + 1;
            }

            return $productosAnnadidos;
        }

        private static function detallesPedidoCrearDesdeFila(array $fila): Carrito
        {
            return new Carrito($fila["id"], $fila["idPedido"], $fila["idLibro"], $fila["cantidad"]);
        }
        public static function pedidoCalcularTotal($productosEnPedido): int
        {
            $total = 0;
            foreach ($productosEnPedido as $producto) {
                $libro = DAO::LibroSelectForId($producto->getIdLibro());
                $total += $libro->getPrecio() * $producto->getCantidad();
            }
            return $total;
        }
        public static function detallesPedidoSelectForIdPedido($idPedido): array {
            $sql = "SELECT dp.cantidad, l.titulo, l.isbn, l.precio, l.portada 
                    FROM detallesPedido AS dp 
                    INNER JOIN libro AS l ON dp.idLibro=l.id 
                    WHERE idPedido = ?";
            $rs = Self::ejecutarConsulta($sql, [$idPedido]);

            $detalles = [];
            foreach ($rs as $fila) {
                array_push($detalles, [$fila["titulo"], $fila["isbn"], $fila["precio"], $fila["cantidad"], $fila["portada"]]);
            }

            return $detalles;
        }

    }
?>