<?php

header('Access-Control-Allow-Origin: *');
require_once 'accesoBD.php';

$objectResponse = new stdClass();
date_default_timezone_set("UTC");

try {
    $accesoBD = new accesoBD();
    $objectResponse = $accesoBD->leerDatos();
} catch (Exception $e) {
    $objectResponse->code = '500';
    $objectResponse->message = $e->getMessage();
}

echo json_encode($objectResponse);
?>
