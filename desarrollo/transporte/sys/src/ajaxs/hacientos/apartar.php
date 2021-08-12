<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST');

include_once '../../../php/session.php';
include_once '../../../php/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $datos = array('operacion' => '');

    try {
        
        $sesion = dataSession();

        $haciento = $_POST['haciento'];
        $id_unidad = $_POST['unidad'];
        $id_destino = $_POST['destino'];

        // prepare and bind
        $stmt = $conn->prepare("INSERT INTO hacientos(haciento, id_destino, id_unidad, id_usuario, salida) VALUES (?,?,?,?,?);");
        $stmt->bind_param("siiii", $haciento, $id_destino, $id_unidad, $id_usuario, $salida);

        // set parameters and execute
        $id_usuario = $sesion["ssn_id_usuario"];
        $salida = false;
        $stmt->execute();

        $datos["operacion"] = "success";

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $datos["operacion"] = "Error al registrar el haciento!";
    }
    echo json_encode($datos);
} else {
    $datos = array('operacion' => 'Error en la solicitud!');
    echo json_encode($datos);
}
?>