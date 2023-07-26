<?php

$routes = explode("/", $_SERVER['REQUEST_URI']);
$routes = array_filter($routes);

if(empty($routes)) {
    $json = array(
        'status' => 404,
        'result' => 'No se ha encontrado la ruta'
    );
    
    echo json_encode($json, http_response_code($json["status"]));
    return;
}

if(count($routes) == 1 && isset($_SERVER['REQUEST_METHOD'])) {
    echo '<pre>'; print_r($_SERVER['REQUEST_METHOD']); echo '</pre>';
}
