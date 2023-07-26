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

// Peticiones

$request = $_SERVER['REQUEST_METHOD'];

if(count($routes) == 1 && isset($request)) {
    // GET
    if($request == "GET") {
        include 'services/GET.php';
    // POST
    } else if ($request == "POST") {
        $json = array(
            'status' => 200,
            'result' => 'Solicitud POST'
        );
        
        echo json_encode($json, http_response_code($json["status"]));
        return;
    // PUT
    } else if ($request == "PUT") {
        $json = array(
            'status' => 200,
            'result' => 'Solicitud PUT'
        );
        
        echo json_encode($json, http_response_code($json["status"]));
        return;
    // DELETE
    } else if ($request == "DELETE") {
        $json = array(
            'status' => 200,
            'result' => 'Solicitud DELETE'
        );
        
        echo json_encode($json, http_response_code($json["status"]));
        return;
    }
}
