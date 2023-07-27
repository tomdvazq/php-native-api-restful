<?php

require_once "./app/controllers/GetController.php";

$table = explode("?", $routes[1])[0];
$select = $_GET["select"] ?? "*";
$orderBy = $_GET["orderBy"] ?? null;
$orderMode = $_GET["orderMode"] ?? null;
$startAt = $_GET["startAt"] ?? null;
$endAt = $_GET["endAt"] ?? null;
$rel = $_GET["rel"];
$type = $_GET["type"];
$linkTo = $_GET["linkTo"] ?? null;
$equalTo = $_GET["equalTo"] ?? null;
$response = new GetController();

// Pëtición GET con filtro 
if(isset($linkTo) && isset($equalTo)) {
    $response -> getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt);
} //Peticiones GET sin filtro entre tablas relacionadas
else if(isset($rel) && isset($type) && $table == "relations" && !$linkTo && !$equalTo) {
    $response -> getRelData($rel, $type, $select, $orderBy, $orderMode, $startAt, $endAt);
} // Petición GET sin filtro
else {
    $response -> getData($table, $select, $orderBy, $orderMode, $startAt, $endAt);
}