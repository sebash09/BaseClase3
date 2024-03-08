<?php
header('Access-Control-Allow-Origin: *');
require_once 'accesoBD.php';

$objectResponse = new stdClass();
date_default_timezone_set("UTC");

if (isset($_POST['value']) && isset($_POST['type']) && isset($_POST['temperature']) && isset($_POST['humidity']) && isset($_POST['id_device'])) {
    $value = $_POST['value'];
    $type = $_POST['type'];
    $temperature = $_POST['temperature'];
    $humidity = $_POST['humidity'];
    $id_device = $_POST['id_device'];

    // Crear una instancia de accesoBD
    $accesoBD = new accesoBD();

    // Escapar las variables para prevenir inyección SQL (o preferiblemente, usar consultas preparadas)
    $value = mysqli_real_escape_string(conexion::conectar(), $value);
    $type = mysqli_real_escape_string(conexion::conectar(), $type);
    $temperature = mysqli_real_escape_string(conexion::conectar(), $temperature);
    $humidity = mysqli_real_escape_string(conexion::conectar(), $humidity);
    $id_device = mysqli_real_escape_string(conexion::conectar(), $id_device);

    $sql = "INSERT INTO things (value, type, temperatura, humidity, id_device, date) VALUES ('{$value}', '{$type}', '{$temperature}', '{$humidity}', '{$id_device}', NOW())";

    if (conexion::ejecutarSQL($sql)) {
        $objectResponse->code = '200';
    } else {
        $objectResponse->code = '300';
    }
    conexion::cerrarConexion();
    echo json_encode($objectResponse);
} else {
    $objectResponse->code = '500';
    echo json_encode($objectResponse);
}
?>
