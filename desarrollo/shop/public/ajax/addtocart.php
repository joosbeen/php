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


		if (!isset($_POST['talla'])) {

			$data['message'] .= "El campo Talla es obligatorio.\n";

		}
		if (!isset($_POST['cantidad'])) {

			$data['message'] .= "El campo Cantidad es obligatorio.\n";
			
		}

		if ($data['message'] == "") {
		
			$_SESSION["carrito"] = isset($_SESSION["carrito"]) ? $_SESSION["carrito"] : [];

			$_SESSION["carrito"][] = array(
				'folio' => time() . ""  . rand(1000, 9999),
				'clave' => rand(1, 15), 
				'nombre' => "Producto mi nombre" . rand(5, 15), 
				'cantidad' => $_POST['cantidad'], 
				'talla' => $_POST['talla']
			);

			$data["carrito_total"] = count($_SESSION["carrito"]);
			$data["carrito_productos"] = $_SESSION["carrito"];

		} else {
			http_response_code(400);
		}

		echo json_encode($data);


	}
} else {
	http_response_code(501);
	$data = array('message' => "La petición no puede ser respondida como la solicitó.");
	echo json_encode($data);
}


 ?>