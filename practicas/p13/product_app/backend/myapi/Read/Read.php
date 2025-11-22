<?php
namespace MyAPI\Read;

class Read extends \MyAPI\DataBase
{
    public function __construct($user = 'root', $pass = '1234567890', $db)
    {
        parent::__construct($user, $pass, $db);
    }

    public function list()
    {
        if (
            $result = $this->conexion->query(
                "SELECT * FROM productos WHERE eliminado = 0",
            )
        ) {
            // SE OBTIENEN LOS RESULTADOS
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if (!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        $this->data[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        } else {
            die("Query Error: " . mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }
    public function search($search)
    {
        $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
        if ($result = $this->conexion->query($sql)) {
            // SE OBTIENEN LOS RESULTADOS
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if (!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        $this->data[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        } else {
            die("Query Error: " . mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }

    public function single($productID)
    {
        if (
            $result = $this->conexion->query(
                "SELECT * FROM productos WHERE id = {$productID}",
            )
        ) {
            // SE OBTIENEN LOS RESULTADOS
            $row = $result->fetch_assoc();

            if (!is_null($row)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach ($row as $key => $value) {
                    $this->data[$key] = utf8_encode($value);
                }
            }
            $result->free();
        } else {
            die("Query Error: " . mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }

    public function singleByName($productName)
    {
        $sql = "SELECT * FROM productos WHERE nombre = '{$productName}' AND eliminado = 0";

        if ($result = $this->conexion->query($sql)) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if (!empty($rows)) {
                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        $this->data[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        }

        $this->conexion->close();
    }
}
