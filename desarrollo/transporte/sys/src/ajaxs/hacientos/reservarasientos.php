<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST');

include_once '../../../php/session.php';
include_once '../../../php/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $datos = array('operacion' => 'success');

    $id_unidad = $_POST['unidad'];
    $id_usuario = dataSession()["ssn_id_usuario"];

    $sql = "UPDATE hacientos SET salida=true WHERE id_unidad=$id_unidad AND id_usuario=$id_usuario AND salida=false; ";
    if ($conn->query($sql) === FALSE) {
        $datos["operacion"] = "Error el reservar los asinetos. :(";
    }
    $conn->close();
    
    echo json_encode($datos);
}
?>