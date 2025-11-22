<?php
namespace MyAPI;

abstract class DataBase
{
    protected $conexion;

    public function __construct($db, $user = "root", $pass = "1234567890")
    {
        $this->conexion = @mysqli_connect("localhost", $user, $pass, $db);
        if (!$this->conexion) {
            die("¡Base de datos NO conextada!");
        }
    }
}
