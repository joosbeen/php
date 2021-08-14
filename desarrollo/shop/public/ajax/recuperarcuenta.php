<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST');

require_once "../../cpanel/models/sesiones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$data = array("message" => "");

	if (sesionActiva()) {
		
	} else {

		$existeEmail = true;

		if ($existeEmail) {
			$data["message"] = true;
		} else {
			http_response_code(401);
			$data["message"] = "El correo no existe, revisalo si esta bien escrito, o registrate.";
		}
		
		echo json_encode($data);

	}
} else {
	http_response_code(501);
	$data = array('message' => "La petición no puede ser respondida como la solicitó.");
	echo json_encode($data);
}
?>