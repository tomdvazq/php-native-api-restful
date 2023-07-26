<?php

require_once "./app/controllers/GetController.php";

$table = $routes[1];

$response = new GetController();
$response -> getData($table);