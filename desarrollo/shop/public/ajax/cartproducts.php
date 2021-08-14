<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET');

require_once "../../cpanel/models/sesiones.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

	$data = array("message" => "", "carrito_productos" => null);

	if (sesionActiva()) {
		
	} else {

		if (isset($_SESSION['carrito']) && count($_SESSION['carrito'])>0) {

			$productos = $_SESSION['carrito'];
			$data["message"] = $_SESSION['carrito'];

			$tablebody = "";

			foreach ($productos as $key => $campo) {

				$tablebody .= "<tr>";
				$tablebody .= "<td>" . $campo["nombre"] . "</td>";
				$tablebody .= "<td>" . $campo["cantidad"] . "</td>";
				$tablebody .= "<td>" . $campo["talla"] . "</td>";
				$tablebody .= "<td> $ 100.00 MXN </td>";
				$tablebody .= '<td><button class="w3-button w3-red btnEliminar" value="' . $campo["folio"] . '"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button></td>';
				$tablebody .= "</tr>";
					
			}

			$tablebody = ($tablebody == "") ? "<tr><td colspan='5' class='w3-center w3-padding-16'><b>No hay productos.</b></td></tr>" : $tablebody;
				
			$data["carrito_productos"] = $tablebody;
			
		} else {
			
			$data["carrito_productos"] = "<tr><td colspan='5' class='w3-center w3-padding-16'><b>No hay productos.</b></td></tr>";

		}
		http_response_code(200);
		echo json_encode($data);
	}

} else {
	http_response_code(501);
	$data = array('message' => "La petición no puede ser respondida como la solicitó.");
	echo json_encode($data);
}
?>