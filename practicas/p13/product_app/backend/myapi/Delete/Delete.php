<?php
namespace MyAPI\Delete;

class Delete extends \MyAPI\DataBase
{
    public function __construct($db, $user = 'root', $pass = '1234567890')
    {
        parent::__construct($user, $pass, $db);
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
}