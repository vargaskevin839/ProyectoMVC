<?php
class Producto {
    private $conn;
    private $tabla = "productos";
    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $stock;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listar() {
        $sql = "SELECT * FROM " . $this->tabla;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function crear() {
        $sql = "INSERT INTO " . $this->tabla .
        "(nombre,descripcion,precio,stock)
        VALUES(:nombre,:descripcion,:precio,:stock)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":stock", $this->stock);
        return $stmt->execute();
    }

    public function obtener($id) {
        $sql = "SELECT * FROM productos WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar() {
        $sql = "UPDATE productos SET
                nombre=:nombre,
                descripcion=:descripcion,
                precio=:precio,
                stock=:stock
                WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }

    public function actualizarAPI() {
        $sql = "UPDATE productos
                SET nombre = :nombre,
                    descripcion = :descripcion,
                    precio = :precio,
                    stock = :stock
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }

    public function eliminar() {
        $sql = "DELETE FROM productos WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
    public function eliminarAPI(){
    $sql="DELETE FROM productos
          WHERE id=:id";
    $stmt=$this->conn->prepare($sql);
    $stmt->bindParam(":id",$this->id);
    return $stmt->execute();
}

}
?>