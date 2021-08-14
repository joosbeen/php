<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET');

require_once '../../cpanel/models/sesiones.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {

	$rsp = array('total' => "");

	if (sesionActiva()) {
		$rsp["total"] = 0;
	} else {
		$rsp["total"] = isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
	}

	echo json_encode($rsp);
	

} else {
	http_response_code(501);
	$data = array('message' => "La petición no puede ser respondida como la solicitó.");
	echo json_encode($data);
}
?>