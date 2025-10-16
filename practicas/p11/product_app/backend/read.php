<?php
include_once __DIR__ . '/database.php';

// SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
$data = array();
// SE VERIFICA HABER RECIBIDO EL ID
if (isset($_POST['patronBusqueda'])) {
    $patronBusqueda = $_POST['patronBusqueda'];

    $likePatronBusqueda = "%{$patronBusqueda}%";
    $sql = "SELECT * FROM productos WHERE 
                    nombre LIKE '{$likePatronBusqueda}' OR 
                    marca LIKE '{$likePatronBusqueda}'OR
                    detalles LIKE '{$likePatronBusqueda}'";

    // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
    if ($result = $conexion->query($sql)) {
        // SE OBTIENEN LOS RESULTADOS
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $producto = array_map('utf8_encode', $row);
            $data[] = $producto;
        }

        $result->free();
    } else {
        die('Query Error: ' . mysqli_error($conexion));
    }
    $conexion->close();
}

// SE HACE LA CONVERSIÓN DE ARRAY A JSON
echo json_encode($data, JSON_PRETTY_PRINT);
