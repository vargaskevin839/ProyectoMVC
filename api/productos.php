<?php
header("Content-Type: application/json");

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Producto.php';

$database = new Database();
$db = $database->conectar();
$producto = new Producto($db);

$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case "GET":
        $stmt = $producto->listar();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($productos);
        break;

    case "POST":
        $datos = json_decode(file_get_contents("php://input"));

        $producto->nombre = $datos->nombre;
        $producto->descripcion = $datos->descripcion;
        $producto->precio = $datos->precio;
        $producto->stock = $datos->stock;

        if ($producto->crear()) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Producto creado"]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo crear el producto"]);
        }
        break;
    case "PUT":
        $datos = json_decode(file_get_contents("php://input"));

        $producto->id = $datos->id;
        $producto->nombre = $datos->nombre;
        $producto->descripcion = $datos->descripcion;
        $producto->precio = $datos->precio;
        $producto->stock = $datos->stock;

        if ($producto->actualizarAPI()) {
            echo json_encode(["mensaje" => "Producto actualizado"]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "No se pudo actualizar el producto"]);
        }
        break;
        case "DELETE":
    $datos=json_decode(
        file_get_contents("php://input")
    );
    $producto->id=$datos->id;
    if($producto->eliminarAPI()){
        echo json_encode([
            "mensaje"=>"Producto eliminado"
        ]);
    }
break;

}
?>
       