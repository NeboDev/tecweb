<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
require 'vendor/autoload.php';
$app = AppFactory::create();
$app->setBasePath("/tecweb/practicas/p14/v4.14.0");

$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write("Hola Mundo Slim!!");
    return $response;
});

$app->get("/hola[/{nombre}]", function ($request, $response, $args) {
    $response->getBody()->write("Hola, " . $args["nombre"]);
    return $response;
});

$app->post("/pruebapost", function ($request, $response, $args) {
    $reqPost = $request->getParsedBody();
    $val1 = $reqPost["val1"];
    $val2 = $reqPost["val2"];
    $response->getBody()->write("Valores: " . $val1 . " " . $val2 . "");
    return $response;
});

$app->get("/testjson", function ($request, $response, $args) {
    $data[0]["nombre"] = "Jesus";
    $data[0]["apellidos"] = "Aguilar Quintero";
    $data[1]["nombre"] = "Marvick";
    $data[1]["apellidos"] = "Osorio Bruno";
    $response->getBody()->write(json_encode($data));
    return $response;
});

$app->run();
