<?php

require_once "./app/controllers/GetController.php";

$table = explode("?", $routes[1])[0];
$select = $_GET["select"] ?? "*";

$response = new GetController();

// Pëtición GET con filtro 

$linkTo = $_GET["linkTo"];
$equalTo = $_GET["equalTo"];

if(isset($linkTo) && isset($equalTo)) {
    $response -> getDataFilter($table, $select, $linkTo, $equalTo);
} 
// Petición GET sin filtro
else {
    $response -> getData($table, $select);
}