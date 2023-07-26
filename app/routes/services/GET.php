<?php

require_once "./app/controllers/GetController.php";

$table = explode("?", $routes[1])[0];
$select = $_GET["select"] ?? "*";
$orderBy = $_GET["orderBy"] ?? null;
$orderMode = $_GET["orderMode"] ?? null;

$response = new GetController();

// Pëtición GET con filtro 

$linkTo = $_GET["linkTo"] ?? null;
$equalTo = $_GET["equalTo"] ?? null;

if(isset($linkTo) && isset($equalTo)) {
    $response -> getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode);
} 
// Petición GET sin filtro
else {
    $response -> getData($table, $select, $orderBy, $orderMode);
}