<?php
namespace MyAPI\Create;

class Create extends \MyAPI\DataBase
{
    public function __construct($user = 'root', $pass = '1234567890', $db)
    {
        parent::__construct($user, $pass, $db);
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
}