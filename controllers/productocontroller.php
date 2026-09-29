<?php
require_once '../models/Producto.php';

class ProductoController {
    private $producto;
    public function __construct($db){
        $this->producto = new Producto($db);
    }
    public function index(){
        return $this->producto->listar();
    }
    public function store($datos){
        $this->producto->nombre=$datos['nombre'];
        $this->producto->descripcion=$datos['descripcion'];
        $this->producto->precio=$datos['precio'];
        $this->producto->stock=$datos['stock'];
        return $this->producto->crear();
    }
    public function update($datos){
        $this->producto->id=$datos['id'];
        $this->producto->nombre=$datos['nombre'];
        $this->producto->descripcion=$datos['descripcion'];
        $this->producto->precio=$datos['precio'];
        $this->producto->stock=$datos['stock'];
        return $this->producto->actualizar();
    }
    public function delete($id){
        $this->producto->id=$id;
        return $this->producto->eliminar();
    }
}
?>
