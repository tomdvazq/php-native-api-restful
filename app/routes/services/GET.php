<?php

require_once "./app/controllers/GetController.php";

$table = explode("?", $routes[1])[0];
$select = $_GET["select"] ?? "*";

$response = new GetController();
$response -> getData($table, $select);