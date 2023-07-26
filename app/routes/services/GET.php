<?php

require_once "./app/controllers/GetController.php";

$table = $routes[1];

$response = new GetController();
$response -> getData($table);

$json = array(
    'status' => 200,
    'result' => 'Solicitud GET'
);

echo json_encode($json, http_response_code($json["status"]));
return;