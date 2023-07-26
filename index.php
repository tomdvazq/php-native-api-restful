<?php

// Mostrar errores

ini_set('display_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log", "C:/xampp/htdocs/php_apirest/php_error_log");

require_once "app/controllers/RoutesController.php";
$index = new RoutesController();
$index->index();