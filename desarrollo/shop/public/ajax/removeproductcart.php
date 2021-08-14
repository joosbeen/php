<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST');

require_once "../../cpanel/models/sesiones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$data = array("message" => "", "carrito_productos" => null);

	if (sesionActiva()) {
		
	} else {

		if (isset($_SESSION['carrito']) && count($_SESSION['carrito'])>0 && isset($_POST["producto"]) && $_POST['producto'] != "") {

			$productos = $_SESSION['carrito'];
			$productos_no_eliminados = array();

			$folio = trim($_POST['producto']);

			foreach ($productos as $producto => $campo) {

				if ($campo["folio"] != $folio) {
					$productos_no_eliminados[] = $campo;
				}
					
			}
			
			$_SESSION['carrito'] = $productos_no_eliminados;

			$data['message'] = "Se eliminó exitosamente.";
			
		} else {

			http_response_code(501);
			$data['message'] = "No existe ningún producto en el carrito.";
			
		}
		
		echo json_encode($data);

	}

} else {
	http_response_code(501);
	$data = array('message' => "La petición no puede ser respondida como la solicitó.");
	echo json_encode($data);
}
?>