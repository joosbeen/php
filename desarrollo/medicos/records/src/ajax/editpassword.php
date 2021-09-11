<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST');

require_once '../../models/connPDO.php';

$http = array('status' => false, 'message' => "", "data" => "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$msg = "";
    
    $contrasena = str_replace(" ", "", $_POST['contrasena']);
    $contrasenacon = str_replace(" ", "", $_POST['contrasena_con']);
    $id = $_POST["id"];

    if (!isset($_POST['contrasena'])) {
        $msg .= "<b>*</b> El campo Contraseña es obligatorio.<br>";
    } else if ($contrasena != $_POST['contrasena']) {
        $msg .= "<b>*</b> El campo Contraseña no debe contener contraseña.<br>";
    }

    if (!isset($_POST['contrasena_con'])) {
        $msg .= "<b>*</b> El campo Confirmar es obligatorio.<br>";
    } else if ($contrasenacon != $_POST['contrasena_con']) {
        $msg .= "<b>*</b> El campo Confirmar no debe contener contraseña.<br>";
    }

    if ($_POST['contrasena'] != $_POST['contrasena_con']) {
        $msg .= "<b>*</b> Las Contraseña no coinciden.<br>";
    }

    if (!isset($_POST["id"])) {
        $msg .= "<b>*</b> Error el lo datos, intentelo de nuevo.<br>";
    }

    if ($msg == "") {

        try {
            $sql = "UPDATE medico_usuarios SET contrasena=PASSWORD(:contrasena) WHERE id=:id;";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':contrasena', $contrasena);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $http["status"] = true;
        } catch (PDOException $e) {
        	$http["status"] = false;
            //$http["message"] = $e->getMessage();
            $http["message"] = "<b>*</b> Error en el sevidor. " . $e->getMessage();
        }
    } else {
        $http["message"] = $msg;
    }

    echo json_encode($http);
} else {
    http_response_code(404);
    $http['message'] = "La petición no puede ser respondida como la solicitó.";
    echo json_encode($http);
}
?>

