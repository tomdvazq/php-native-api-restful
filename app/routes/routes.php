<?php

$routes = explode("/", $_SERVER['REQUEST_URI']);
$routes = array_filter($routes);

if(empty($routes)) {
    $json = array(
        'status' => 404,
        'result' => 'No se ha encontrado la ruta'
    );
    
    echo json_encode($json);
    return;
}

