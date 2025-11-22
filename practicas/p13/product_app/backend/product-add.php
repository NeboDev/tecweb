<?php
use MyAPI\Products;
require_once __DIR__ . "/myapi/Products.php";
$productos = new Products("marketzone");

$productos->add((object) $_POST);
echo $productos->getData();

?>
