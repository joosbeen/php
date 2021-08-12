<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST');

include_once '../../../php/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = $_POST["action"];
    $sql = "";
    $data = array("operacion" => "success", "asientos"=>array());

    if ($action == "asiento") {

        $idAsiento = $_POST["asiento"];
        $sql = "DELETE FROM hacientos WHERE id=$idAsiento;";
    } else {

        $idUnidad = $_POST["unidad"];
        
        $sql = "SELECT * FROM hacientos WHERE id_unidad=$idUnidad AND salida=false;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($asiento = $result->fetch_assoc()) {
                $data["asientos"][] = $asiento;
            }
        }
        
        $sql = "DELETE FROM hacientos WHERE id_unidad=$idUnidad AND salida=false;";
    }

    if ($conn->query($sql) === FALSE) {
        $data["operacion"] = "Ocurrio un error al internar eliminar la reserva de asiento.";
    }

    $conn->close();

    echo json_encode($data);
}
?>
