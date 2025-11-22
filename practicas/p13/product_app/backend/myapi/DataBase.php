<?php
namespace MyAPI;

abstract class DataBase
{
    protected $conexion;
    protected $data = [];

    public function __construct($user = "root", $pass = "1234567890", $db)
    {
        $this->conexion = @mysqli_connect("localhost", $user, $pass, $db);
        if (!$this->conexion) {
            die("¡Base de datos NO conectada!");
        }
    }

    public function getData()
    {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }

}