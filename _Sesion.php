<?php
    /*Esta declaración configura el modo estricto para el código PHP,
    lo que significa que se requiere la declaración de tipos de datos
    precisos en funciones y métodos.*/
    declare(strict_types=1);

    require_once "_DAO.php";


    // Inicia una sesión de PHP o reanuda la sesión actual si ya existe.
    session_start();

    //Una función que verifica si se ha iniciado una sesión. Si es así, redirige al usuario a "LibroIndex.php".
    function entrarSiSesionIniciada()
    {
        if (comprobarRenovarSesion()) redireccionar("LibroIndex.php");
    }

    function salirSiSesionFalla()
    {
        if (!comprobarRenovarSesion()) redireccionar("SesionFormulario.php");
    }

    function comprobarRenovarSesion(): bool
    {
        if (haySesionRAM()) {
            if (isset($_COOKIE["id"])) { // Basta con mirar si parece que viene cookie porque ya acabamos de validar la sesión RAM
                generarRenovarSesionCookie();
            }
            return true; // Esto es en todo caso
        } else { // NO hay sesión RAM
            $usuario = obtenerUsuarioPorCookie();
            if ($usuario) { // Equivale a if ($usuario != null)
                generarSesionRAM($usuario); // Canjear la sesión cookie por una sesión RAM.
                generarRenovarSesionCookie();
                return true;
            } else { // Ni RAM, ni cookie
                return false;
            }
        }
    }
    function obtenerPdoConexionBD(): PDO
    {
        $servidor = "localhost";
        $identificador = "root";
        $contrasenna = "";
        $bd = "libreria"; // Schema
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false, // Modo emulación desactivado para prepared statements "reales"
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.
        ];

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
        } catch (Exception $e) {
            error_log("Error al conectar: " . $e->getMessage());
            echo "\n\nError al conectar:\n" . $e->getMessage();
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        }

        return $pdo;
    }

    function haySesionRAM(): bool
    {
        return isset($_SESSION["id"]);
    }

    function obtenerUsuarioPorContrasenia(string $nickname, string $contrasenia): ?array
    {
        $conexion = obtenerPdoConexionBD();
        $sql = "SELECT id, nickname, nombre, admin FROM usuario
                    WHERE nickname=? AND BINARY contrasenia=?";
        $select = $conexion->prepare($sql);
        $select->execute([$nickname, $contrasenia]);
        $filasObtenidas = $select->rowCount();
        if ($filasObtenidas == 0) return null;
        else return $select->fetch();
    }

    // Antiguo haySesionCookie(): bool
    function obtenerUsuarioPorCookie(): ?array
    {
        if (isset($_COOKIE["id"])) {
            $conexion = obtenerPdoConexionBD();

            $sql = "SELECT id, nickname, nombre FROM usuario
                    WHERE id = ? AND BINARY codigoCookie = ? AND caducidadCodigoCookie >= ?";
            $select = $conexion->prepare($sql);
            $select->execute([
                $_COOKIE["id"],
                $_COOKIE["codigoCookie"],
                date("Y-m-d H:i:s", time()) // Fecha-hora de ahora mismo obtenida del sistema.
            ]);
            $filasObtenidas = $select->rowCount();

            if ($filasObtenidas == 0) return null;
            else return $select->fetch();
        } else {
            return null;
        }
    }

    function generarSesionRAM(array $usuario)
    {
        // Guardar el id es lo único indispensable.
        // El resto son por evitar accesos a la BD a cambio del riesgo
        // de que mis datos en sesión RAM estén obsoletos.
        $_SESSION["id"] = $usuario["id"];
        $_SESSION["nickname"] = $usuario["nickname"];
        $_SESSION["admin"] = $usuario["admin"];
    }

    function generarRenovarSesionCookie()
    {
        $codigoCookie = uniqid(); // Genera un código aleatorio "largo".

        $fechaCaducidad = time() + 24 * 60 * 60;
        $fechaCaducidadParaBD = date("Y-m-d H:i:s", $fechaCaducidad);

        // Anotar en la BD el codigoCookie y su caducidad.
        $conexion = obtenerPdoConexionBD();
        $sql = "UPDATE usuario SET codigoCookie=?, caducidadCodigoCookie=? WHERE id=?";
        $select = $conexion->prepare($sql);
        $select->execute([$codigoCookie, $fechaCaducidadParaBD, $_SESSION["id"]]);

        // Crear (o renovar) las cookies.
        setcookie('id', strval($_SESSION["id"]), $fechaCaducidad);
        setcookie('codigoCookie', $codigoCookie, $fechaCaducidad);
    }

    function cerrarSesion()
    {
        // Eliminar de la BD el codigoCookie y su caducidad.
        $conexion = obtenerPdoConexionBD();
        $sql = "UPDATE usuario SET codigoCookie=NULL, caducidadCodigoCookie=NULL WHERE id=?";
        $select = $conexion->prepare($sql);
        $select->execute([$_SESSION["id"]]); // Se añade el parámetro a la consulta preparada.

        // Borrar las cookies.
        setcookie('id', "", time() - 3600);
        setcookie('codigoCookie', "", time() - 3600);

        // Destruir sesión RAM (implica borrar cookie de PHP "PHPSESSID").
        session_destroy();
    }
