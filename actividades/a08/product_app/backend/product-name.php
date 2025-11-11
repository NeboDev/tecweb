<?php
include_once __DIR__ . "/database.php";

$data = [];

if (isset($_GET["nombre"])) {
    $nombre = $_GET["nombre"];

    $sql = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND eliminado = 0";

    if ($result = $conexion->query($sql)) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        if (!empty($rows)) {
            foreach ($rows as $num => $row) {
                foreach ($row as $key => $value) {
                    $data[$num][$key] = utf8_encode($value);
                }
            }
        }
        $result->free();
    }

    $conexion->close();
}

echo json_encode($data);
?>
