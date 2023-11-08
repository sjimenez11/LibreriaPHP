<?php

abstract class Dato{

}

trait Identificable{
    protected int $id;
    public function getId(): int{
        return $this->id;
    }
    public function setId(int $id){
        $this->id = $id;
    }
}




class Usuario extends Dato implements JsonSerializable
{
    use Identificable;

    private string $nickname;
    private string $nombre;
    private string $email;
    private string $contrasenia;
    private int $admin;

    public function __construct(int $id, string $nickname, string $nombre, string $email, string $contrasenia, int $admin){
        $this->setId($id);
        $this->setNickname($nickname);
        $this->setNombre($nombre);
        $this->setEmail($email);
        $this->setContrasenia($contrasenia);
        $this->setAdmin($admin);
    }

    public function jsonSerialize(): mixed{
        return [
            "id" => $this->id,
            "nickname" => $this->nickname,
            "nombre" => $this->nombre,
            "email" => $this->email,
            "contrasennia" => $this->contrasenia,
            "admin" => $this->admin
        ];
    }

    public function getNickname(): string{
        return $this->nickname;
    }

    public function setNickname(string $nickname){
        $this->nickname = $nickname;
    }

    public function getNombre(): string{
        return $this->nombre;
    }

    public function setNombre(string $nombre){
        $this->nombre = $nombre;
    }

    public function getEmail(): string{
        return $this->email;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }

    public function getContrasenia(): string{
        return $this->contrasenia;
    }

    public function setContrasenia(string $contrasenia){
        $this->contrasenia = $contrasenia;
    }

    public function getAdmin(): int{
        return $this->admin;
    }

    public function setAdmin(int $admin){
        $this->admin = $admin;
    }
}




class Autor extends Dato implements JsonSerializable
{
    use Identificable;

    private string $nombre;
    private string $nacionalidad;
    private string $biografia;

    public function __construct(int $id, string $nombre, ?string $nacionalidad, ?string $biografia){
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setNacionalidad($nacionalidad);
        $this->setBiografia($biografia);

    }

    public function jsonSerialize(): mixed{
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "nacionalidad" => $this->nacionalidad,
            "biografia" => $this->biografia
        ];
    }

    public function getNombre(): string{
        return $this->nombre;
    }

    public function setNombre(string $nombre){
        $this->nombre = $nombre;
    }

    public function getNacionalidad(): string{
        return $this->nacionalidad;
    }

    public function setNacionalidad(string $nacionalidad){
        $this->nacionalidad = $nacionalidad;
    }

    public function getBiografia(): string{
        return $this->biografia;
    }

    public function setBiografia(string $biografia){
        $this->biografia = $biografia;
    }
}




class Libro extends Dato implements JsonSerializable{
    use Identificable;
    private string $titulo;
    private int $isbn;
    private float $precio;
    private int $idAutor;
    private string $portada;

    public function __construct(int $id, string $titulo, int $isbn, float $precio, string $idAutor, string $portada){
        $this->setId($id);
        $this->setTitulo($titulo);
        $this->setIsbn($isbn);
        $this->setPrecio($precio);
        $this->setIdAutor($idAutor);
        $this->setPortada($portada);
    }

    public function jsonSerialize(): mixed{
        return[
            "id" => $this->id,
            "titulo" => $this->titulo,
            "isbn" => $this->isbn,
            "precio" => $this->precio,
            "idAutor" => $this->idAutor,
            "portada" => $this->portada
        ];
    }

    public function getTitulo(): string{
        return $this->titulo;
    }
    public function setTitulo(string $titulo){
        $this->titulo = $titulo;
    }

    public function getIsbn(): int{
        return $this->isbn;
    }
    public function setIsbn(int $isbn){
        $this->isbn = $isbn;
    }

    public function getPrecio(): float{
        return $this->precio;
    }
    public function setPrecio(float $precio){
        $this->precio = $precio;
    }

    public function getIdAutor(): int{
        return $this->idAutor;
    }
    public function setIdAutor(int $idAutor){
        $this->idAutor = $idAutor;
    }
    public function getNombreAutor(): string{
        $autor = DAO::autorSelectForId($this->idAutor);
        return $autor->getNombre();
    }

    public function getPortada(): string{
        return $this->portada;
    }

    public function setPortada(string $portada): void{
        $this->portada = $portada;
    }

}


class Carrito extends Dato implements JsonSerializable{
    use Identificable;
    private int $idUsuario;
    private int $idLibro;
    private int $cantidad;

    public function __construct(int $id, int $idUsuario, int $idLibro, int $cantidad){
        $this->setId($id);
        $this->setIdUsuario($idUsuario);
        $this->setIdLibro($idLibro);
        $this->setCantidad($cantidad);
    }

    public function jsonSerialize(): mixed{
        return[
            "id" => $this->id,
            "idUsuario" => $this->idUsuario,
            "idLibro" => $this->idLibro,
            "cantidad" => $this->cantidad
        ];
    }

    public function getIdUsuario(): int{
        return $this->idUsuario;
    }

    public function setIdUsuario(int $idUsuario): void{
        $this->idUsuario = $idUsuario;
    }

    public function getIdLibro(): int{
        return $this->idLibro;
    }

    public function setIdLibro(int $idLibro): void{
        $this->idLibro = $idLibro;
    }

    public function getCantidad(): int{
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): void{
        $this->cantidad = $cantidad;
    }
}

class Pedido extends Dato implements JsonSerializable{
    use Identificable;
    private int $idUsuario;
    private DateTime $fechaPedido;
    private string $direccion;
    private int $codigoPostal;

    public function __construct(int $id, int $idUsuario, string $fechaPedido, string $direccion, int $codigoPostal){
        $this->setId($id);
        $this->setIdUsuario($idUsuario);
        $this->setFechaPedido(new DateTime($fechaPedido));
        $this->setDireccion($direccion);
        $this->setCodigoPostal($codigoPostal);
    }

    public function jsonSerialize(): mixed{
        return[
            "id" => $this->id,
            "idUsuario" => $this->idUsuario,
            "fechaPedido" => $this->fechaPedido
        ];
    }

    public function getIdUsuario(): int{
        return $this->idUsuario;
    }

    public function setIdUsuario(int $idUsuario): void{
        $this->idUsuario = $idUsuario;
    }

    public function getFechaPedido(): DateTime{
        return $this->fechaPedido;
    }

    public function setFechaPedido(DateTime $fechaPedido): void{
        $this->fechaPedido = $fechaPedido;
    }

    public function getDireccion(): string{
        return $this->direccion;
    }

    public function setDireccion(string $direccion): void{
        $this->direccion = $direccion;
    }

    public function getCodigoPostal(): int{
        return $this->codigoPostal;
    }

    public function setCodigoPostal(int $codigoPostal): void{
        $this->codigoPostal = $codigoPostal;
    }
}



class DetallesPedido extends Dato implements JsonSerializable{
    use Identificable;
    private int $idPedido;
    private int $idLibro;
    private int $cantidad;

    public function __construct(int $id, int $idPedido, int $idLibro, int $cantidad){
        $this->setId($id);
        $this->setIdUsuario($idPedido);
        $this->setIdLibro($idLibro);
        $this->setCantidad($cantidad);
    }

    public function jsonSerialize(): mixed{
        return[
            "id" => $this->id,
            "idUsuario" => $this->idUsuario,
            "idLibro" => $this->idLibro,
            "cantidad" => $this->cantidad
        ];
    }

    public function getIdPedido(): int{
        return $this->idPedido;
    }

    public function setIdUsuario(int $idPedido): void{
        $this->idPedido = $idPedido;
    }

    public function getIdLibro(): int{
        return $this->idLibro;
    }

    public function setIdLibro(int $idLibro): void{
        $this->idLibro = $idLibro;
    }

    public function getCantidad(): int{
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): void{
        $this->cantidad = $cantidad;
    }
}