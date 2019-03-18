<?php
/**
 * Created by PhpStorm.
 * User: daw
 * Date: 6/2/19
 * Time: 12:16
 */

require_once './class/Http.php';
require_once './class/Response.php';

$controller= filter_input(INPUT_GET, "controller");
$id= filter_input(INPUT_GET, "id");
$operacion = filter_input(INPUT_GET, "operacion");

$verb=$_SERVER['REQUEST_METHOD'];
$http = new HTTP();

require './class/' . $controller . ".php";
$objeto = new $controller;


if (empty($controller) || !file_exists('./class/'.$controller.".php")){
    $http=new HTTP();
    $http->setHttpHeaders(400,new Response("Bad request"));
    die();
}


if ($verb == "GET") {
    if (!empty($operacion) && $operacion == "tocho") {
        $datos = $objeto->tocho();
        $http->setHttpHeaders(200, new Response("Libro con mas paginas", $datos));
    } else if (!empty ($operacion) && $operacion == "obras") {
        
        $raw = file_get_contents("php://input");
        $datos = json_decode($raw);
        $response = $objeto->obras($datos->nombre);
        $http->setHttpHeaders(200, new Response("Libros del autor $datos->nombre", $response));
        
    } else if (empty($id)) {
        $datos = $objeto->getAll();
        $http->setHttpHeaders(200, new Response("Lista de un libro",$datos));
    } else {
        $objeto->loadById($id);
        $http->setHttpHeaders(200, new Response("Lista de los libros",$objeto->serialize()));
    }
    
} else if($verb == "PUT") {
    echo "El verbo es put";
}