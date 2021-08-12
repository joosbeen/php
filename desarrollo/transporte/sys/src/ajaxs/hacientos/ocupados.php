<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET');

include_once '../../../php/session.php';
include_once '../../../php/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $datos = array('operacion' => 'success', 'hacientos' => array());

    $id_unidad = $_GET['unidad'];
    $id_usuario = dataSession()["ssn_id_usuario"];

    $sql = "SELECT a.id, a.haciento, d.precio FROM hacientos a, destinos d WHERE a.id_destino = d.id AND a.id_unidad=$id_unidad AND a.id_usuario=$id_usuario AND a.salida=false;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($haciento = $result->fetch_assoc()) {
            $datos["hacientos"][] = $haciento;
        }
    } else {
        $datos["operacion"] = "sin reservar hacientos!";
    }
    $conn->close();

    echo json_encode($datos);
} else {
    $datos = array('operacion' => 'Error en la solicitud!');
    echo json_encode($datos);
}
?>