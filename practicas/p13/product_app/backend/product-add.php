<?php
require_once __DIR__ . "/../vendor/autoload.php";
use MyAPI\Create\Create;


$productos = new Create("marketzone");

$productos->add((object) $_POST);
echo $productos->getData();

?>