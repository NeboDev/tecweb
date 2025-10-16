<?php
include_once __DIR__ . '/database.php';

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');
if (!empty($producto)) {
    // SE TRANSFORMA EL STRING DEL JASON A OBJETO
    $jsonOBJ = json_decode($producto);

    $nombre   = $jsonOBJ->nombre;
    $marca    = $jsonOBJ->marca;
    $modelo   = $jsonOBJ->modelo;
    $precio   = floatval($jsonOBJ->precio);
    $detalles = $jsonOBJ->detalles;
    $unidades = intval($jsonOBJ->unidades);
    $imagen   = $jsonOBJ->imagen;


    // VALIDAR QUE NO EXISTA EL PRODUCTO
    $sql_check = "SELECT id FROM productos WHERE nombre = '{$nombre}' AND eliminado = 0";
    $resultado = $conexion->query($sql_check);

    if ($resultado->num_rows > 0) {
        $response = array( // EL PRODUCTO YA EXISTE
            'status' => 'error',
            'message' => 'El producto ya existe en la base de datos'
        );
        echo json_encode($response);
    } else {
        // INSERTAR EL NUEVO PRODUCTO
        $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
                    VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";

        if ($conexion->query($sql)) {
            $id_insertado = $conexion->insert_id;

            // LA INSERCION FUNCIONO
            $response = array(
                'status' => 'success',
                'message' => 'Producto agregado exiosamente',
                'id' => $id_insertado,
                'producto' => array(
                    'nombre' => $nombre,
                    'marca' => $marca,
                    'modelo' => $modelo,
                    'precio' => $precio,
                    'detalles' => $detalles,
                    'unidades' => $unidades,
                    'imagen' => $imagen
                )
            );
            echo json_encode($response);
        };
        // echo '[SERVIDOR] Nombre: ' . $jsonOBJ->nombre; DA PROBLEMAS PARA EL JSON
    }
}
