<?php

require_once "./app/controllers/GetController.php";

$table = explode("?", $routes[1])[0];
$select = $_GET["select"] ?? "*";
$orderBy = $_GET["orderBy"] ?? null;
$orderMode = $_GET["orderMode"] ?? null;
$startAt = $_GET["startAt"] ?? null;
$endAt = $_GET["endAt"] ?? null;
$rel = $_GET["rel"] ?? null;
$type = $_GET["type"] ?? null;
$linkTo = $_GET["linkTo"] ?? null;
$equalTo = $_GET["equalTo"] ?? null;
$search = $_GET['search'] ?? null;
$betweenIn = $_GET['betweenIn'] ?? null;
$betweenOut = $_GET['betweenOut'] ?? null;
$filterTo = $_GET['filterTo'] ?? null;
$inTo = $_GET['inTo'] ?? null;
$response = new GetController();

// Pëtición GET con filtro 
if(isset($linkTo) && isset($equalTo) && !isset($rel) && !isset($type)) {
    $response -> getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt);
} //Peticiones GET sin filtro entre tablas relacionadas
else if(isset($rel) && isset($type) && $table == "relations" && !$linkTo && !$equalTo) {
    $response -> getRelData($rel, $type, $select, $orderBy, $orderMode, $startAt, $endAt);
} //Peticiones GET con filtro entre tablas relacionadas
else if(isset($rel) && isset($type) && $table == "relations" && isset($linkTo) && isset($equalTo)) {
    $response -> getRelDataFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt);
} // Petición GET para el buscador sin relaciones 
else if (!isset($rel) && !isset($type) && isset($linkTo) && isset($search)){
    $response -> getDataSearch($table, $select, $search, $linkTo, $orderBy, $orderMode, $startAt, $endAt);
} // Petición GET para el buscador con relaciones
else if (isset($rel) && isset($type) && $table == "relations" && isset($linkTo) && isset($search)){
    $response -> getRelDataSearch($rel, $type, $select, $linkTo, $search, $orderBy, $orderMode, $startAt, $endAt);
} // Petición GET para seleccionar rangos
else if (!isset($rel) && !isset($type) && isset($linkTo) && isset($betweenIn) && isset($betweenOut)){
    $response -> getDataRange($table, $betweenIn, $betweenOut, $select, $linkTo, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo);
}// Petición GET para seleccionar rangos en tablas relacionadas
else if (isset($rel) && isset($type) && $table == "relations" && isset($linkTo) && isset($betweenIn) && isset($betweenOut)){
    $response -> getRelDataRange($rel, $type, $betweenIn, $betweenOut, $select, $linkTo, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo);
}// Petición GET sin filtro
else {
    $response -> getData($table, $select, $orderBy, $orderMode, $startAt, $endAt);
}