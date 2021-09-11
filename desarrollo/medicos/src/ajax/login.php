<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST');

require_once '../../records/models/connPDO.php';
require_once '../../records/models/sesion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $response = array('status' => false, 'message' => "", 'data' => "");

    $username = $_POST['username'];
    $password = $_POST['password'];

    $msg = "";

    if (!isset($_POST["username"]) || $username == "") {
        $msg .= "* El campo Username es obligatorio.<br>";
    } else if ($username != $_POST['username']) {
        $msg .= "* El campo Username no debe contener espacios.<br>";
    }

    if (!isset($_POST["password"]) || $password == "") {
        $msg .= "* El campo Contraseña es obligatorio.<br>";
    } else if ($password != $_POST['password']) {
        $msg .= "* El campo Contraseña no debe contener espacios.<br>";
    }

    if ($msg == "") {

        $sql = "SELECT * FROM medico_usuarios WHERE usuario=:usuario AND contrasena=PASSWORD(:contrasena) LIMIT 1;";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':usuario', $username);
        $stmt->bindParam(':contrasena', $password);
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();

        if (count($datos) == 0) {

            $response["message"] = "* El Usuario/Contraseña es incorrecto.";
        } else if (!$datos[0]["estado"]) {

            $response["message"] = "* Su cuenta esta inactia, contacte al administrador.";
        } else {
            createSesion($datos[0]);
            $response["status"] = true;
            $response["data"] = "records/index.php";
        }
    } else {
        $response["message"] = $msg;
    }

    echo json_encode($response);
} else {
    http_response_code(501);
    $data = array('message' => "La petición no puede ser respondida como la solicitó.");
    echo json_encode($data);
}
?>