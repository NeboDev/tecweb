<?php
include_once __DIR__ . "/database.php";

$producto = file_get_contents("php://input");
$data = [
    "status" => "error",
    "message" => "No se pudo editar el producto",
];

if (!empty($producto)) {
    $jsonOBJ = json_decode($producto);
    $conexion->set_charset("utf8");

    // Query para ACTUALIZAR el producto
    $sql = "UPDATE productos SET
            nombre = '{$jsonOBJ->nombre}',
            marca = '{$jsonOBJ->marca}',
            modelo = '{$jsonOBJ->modelo}',
            precio = {$jsonOBJ->precio},
            detalles = '{$jsonOBJ->detalles}',
            unidades = {$jsonOBJ->unidades},
            imagen = '{$jsonOBJ->imagen}'
            WHERE id = {$jsonOBJ->id} AND eliminado = 0";

    if ($conexion->query($sql)) {
        if ($conexion->affected_rows > 0) {
            $data["status"] = "success";
            $data["message"] = "Producto actualizado correctamente";
        } else {
            $data["message"] = "No se encontró el producto o no hubo cambios";
        }
    } else {
        $data["message"] =
            "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
    }

    // Cierra la conexion
    $conexion->close();
}

echo json_encode($data, JSON_PRETTY_PRINT);
?>
