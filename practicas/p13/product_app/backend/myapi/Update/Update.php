<?php
namespace MyAPI\Update;

class Update extends \MyAPI\DataBase
{
    public function __construct($db, $user = 'root', $pass = '1234567890')
    {
        parent::__construct($user, $pass, $db);
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

}