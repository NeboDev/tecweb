<?php
use MyAPI\Products;
require_once __DIR__ . "/myapi/Products.php";
$productos = new Products("marketzone");

$productos->singleByName($_GET["nombre"]);
echo $productos->getData();

?>
