<?php
use MyAPI\Update\Update;
require_once __DIR__ . "/../vendor/autoload.php";
$productos = new Update("marketzone");

$productos->edit((object) $_POST);
echo $productos->getData();

?>