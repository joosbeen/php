<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET');

require_once "../../cpanel/models/sesiones.php";

$datos = array('login' => false);

if (sesionActiva()) {

	$datos['login'] = true;
	
} else {

	$datos['login'] = false;
}

echo json_encode($datos);

?>