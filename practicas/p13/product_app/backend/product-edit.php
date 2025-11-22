<?php
use MyAPI\Products;
require_once __DIR__ . "/myapi/Products.php";
$productos = new Products("marketzone");

$productos->edit((object) $_POST);
echo $productos->getData();

?>
