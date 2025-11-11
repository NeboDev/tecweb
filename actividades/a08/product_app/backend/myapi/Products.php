<?php
namespace backend\myapi;

include_once __DIR__ . "/DataBase.php";

class Products extends DataBase
{
    private $data = [];

    public function __construct($db, $user = "root", $pass = "123456789")
    {
        parent::__construct($db, $user, $pass);
        $this->data = [];
    }

    public function add($product)
    {
        $this->data = [
            "status" => "error",
            "message" => "Ya existe un producto con ese nombre",
        ];
        //SE VERIFICA SI HAY UN PRODUCTO CON EL MISMO NOMBRE
        $sql = "SELECT * FROM productos WHERE nombre = '{$product->nombre}' AND eliminado = 0";
        $result = $this->conexion->query($sql);

        if ($result->num_rows == 0) {
            $sql = "INSERT INTO productos VALUES (null, '{$product->nombre}', '{$product->marca}', '{$product->modelo}',
                {$product->precio}, '{$product->detalles}', {$product->unidades}, '{$product->imagen}', 0)";
            $this->conexion->query($sql);

            if ($this->conexion->query($sql)) {
                $this->data["status"] = "success";
                $this->data["message"] = "Producto agregado";
            } else {
                $this->data["status"] = "error";
                $this->data["message"] =
                    "ERROR: No se ejecuto $sql. " .
                    mysqli_error($this->conexion);
            }
        }
        $result->free();
        $this->conexion->close();
    }

    public function delete($productID)
    {
        $this->data = [
            "status" => "error",
            "message" => "La consulta falló",
        ];
        $sql = "UPDATE productos SET eliminado=1 WHERE id = {$productID}";
        if ($this->conexion->query($sql)) {
            $this->data["status"] = "success";
            $this->data["message"] = "Producto eliminado";
        } else {
            $this->data["message"] =
                "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
        }
        $this->conexion->close();
    }

    public function edit($product)
    {
        $this->data = [
            "status" => "error",
            "message" => "La consulta falló",
        ];
        $sql = "UPDATE productos SET nombre='{$product->nombre}', marca='{$product->marca}',";
        $sql .= "modelo='{$product->modelo}', precio={$product->precio}, detalles='{$product->detalles}',";
        $sql .= "unidades={$product->unidades}, imagen='{$product->imagen}' WHERE id={$product->id}";
        $this->conexion->set_charset("utf8");
        if ($this->conexion->query($sql)) {
            $this->data["status"] = "success";
            $this->data["message"] = "Producto actualizado";
        } else {
            $this->data["message"] =
                "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
        }
        $this->conexion->close();
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

    public function getData()
    {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }
}
