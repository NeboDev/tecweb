<?php
include_once __DIR__ . "/database.php";

$data = null;
if (isset($_POST["id"])) {
    $search = $_POST["id"];
    $sql = "SELECT * FROM productos WHERE id = '{$search}'";

    if ($result = $conexion->query($sql)) {
        $row = $result->fetch_assoc();

        if ($row) {
            foreach ($row as $key => $value) {
                $row[$key] = utf8_encode($value);
            }
            $data = $row;
        }
        $result->free();
    } else {
        die("Query Error: " . mysqli_error($conexion));
    }
    $conexion->close();
}

echo json_encode($data, JSON_PRETTY_PRINT);
?>
