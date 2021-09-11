<?php

require_once './models/connPDO.php';


$msgSuccess = "";
$msgError = "";

$id = "";
$nombre = "";
$identificacion = "";
$sexo = "";
$edad = "0";
$telefono = "";
$fecha_nacimiento = "";
$domicilio = "";
$foto = "";
$action = "insert";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST['action'] == "insert" || $_POST['action'] == "update") {

        $id = filter_input(INPUT_POST, 'id');
        $nombre = filter_input(INPUT_POST, 'nombre');
        $identificacion = filter_input(INPUT_POST, 'identificacion');
        $sexo = filter_input(INPUT_POST, 'sexo');
        $edad = filter_input(INPUT_POST, 'edad');
        $telefono = filter_input(INPUT_POST, 'telefono');
        $fecha_nacimiento = filter_input(INPUT_POST, 'fecha_nacimiento');
        $domicilio = filter_input(INPUT_POST, 'domicilio');
        $foto = filter_input(INPUT_POST, 'foto');
        $action = filter_input(INPUT_POST, 'action');

        $edad2 = empty($edad) ? "0.0" : $edad;

        $subnombre = str_replace(" ", "", $nombre);
        if (empty($nombre) || empty($subnombre)) {
            $msgError .= "<b>*</b> El campo 'Nombre' es obligatorio.<br>";
        } else if (strlen($subnombre) < 4) {
            $msgError .= "<b>*</b> El campo 'Nombre' debe contener mas de 5 caracteres.<br>";
        }

        $subidentificacion = str_replace(" ", "", $identificacion);
        if (empty($identificacion) || empty($subidentificacion)) {
            $msgError .= "<b>*</b> El campo 'Identificación' es obligatorio.<br>";
        } else if ($subidentificacion != $identificacion) {
            $msgError .= "<b>*</b> El campo 'Identificación' contiene espacios.<br>";
        } else if (strlen($subidentificacion) < 5) {
            $msgError .= "<b>*</b> El campo 'Identificación' debe contener mas de 5 caracteres.<br>";
        }

        $subsexo = str_replace(" ", "", $sexo);
        $sexos = array("femenino", "masculino");
        if (empty($sexo) || empty($subsexo)) {
            $msgError .= "<b>*</b> El campo 'Sexo' es obligatorio.<br>";
        } else if (!in_array($subsexo, $sexos)) {
            $msgError .= "<b>*</b> El campo 'Sexo' es invalido.<br>";
        }

        $subedad = str_replace(" ", "", $edad2);
        if (empty($edad2) || empty($subedad)) {
            $msgError .= "<b>*</b> El campo 'Edad' es obligatorio.<br>";
        } else if (!is_numeric($subedad)) {
            $msgError .= "<b>*</b> El campo 'Edad' es invalido.<br>";
        }

        $subtelefono = str_replace(" ", "", $telefono);
        if (empty($telefono) || empty($subtelefono)) {
            $msgError .= "<b>*</b> El campo 'Teléfono' es obligatorio.<br>";
        } else if (strlen($telefono) != 10) {
            $msgError .= "<b>*</b> El campo 'Teléfono' es invalido, 10 digitos obligatorio.<br>";
        }

        $subfecha_nacimiento = str_replace(" ", "", $fecha_nacimiento);
        if (empty($fecha_nacimiento) || empty($subfecha_nacimiento)) {
            $msgError .= "<b>*</b> El campo 'Fecha Nacimiento' es obligatorio.<br>";
        } else if (!fechaValida($fecha_nacimiento)) {
            $msgError .= "<b>*</b> El campo 'Fecha Nacimiento' es invalido.<br>";
        }

        $subdomicilio = str_replace(" ", "", $domicilio);
        if (empty($domicilio) || empty($subdomicilio)) {
            $msgError .= "<b>*</b> El campo 'Domicilio' es obligatorio.<br>";
        } else if (strlen($subdomicilio) < 5) {
            $msgError .= "<b>*</b> El campo 'Domicilio' debe contener mas de 5 caracteres.<br>";
        }
    }

    if ($_POST['action'] == "insert" && $msgError == "") {

        $sql = "INSERT INTO medico_pacientes(nombre, identificacion, sexo, edad, telefono, fecha_nacimiento, domicilio) VALUES (:nombre, :identificacion, :sexo, :edad, :telefono, :fecha_nacimiento, :domicilio)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':identificacion', $identificacion);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':edad', $edad);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
            $stmt->bindParam(':domicilio', $domicilio);
            //$stmt->bindParam(':foto', $foto);
            $stmt->execute();
            $msgSuccess = "El paciente se registro con exito.";
        } catch (PDOException $e) {
            $msgError = $e->getMessage();
        }
    }


    if ($_POST['action'] == "load") {

        $id = filter_input(INPUT_POST, 'id');
    	$sql = "SELECT * FROM medico_pacientes WHERE id=:id";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $usuarios = $stmt->fetchAll();

            if (count($usuarios) > 0) {            
            	$id = $usuarios[0]['id'];
				$nombre = $usuarios[0]['nombre'];
				$identificacion = $usuarios[0]['identificacion'];
				$sexo = $usuarios[0]['sexo'];
				$edad = $usuarios[0]['edad'];
				$telefono = $usuarios[0]['telefono'];
				$fecha_nacimiento = $usuarios[0]['fecha_nacimiento'];
				$domicilio = $usuarios[0]['domicilio'];
				$foto = $usuarios[0]['foto'];
            	$action = "update";
            } else {
            	$msgError = "Error al cargar los datos del paciente.";
            }
        } catch (PDOException $e) {
            $msgError = $e->getMessage();
        }
    }

    if ($_POST['action'] == "update" && $msgError == "") {

        $sql = "UPDATE medico_pacientes SET nombre=:nombre,identificacion=:identificacion,sexo=:sexo,edad=:edad,telefono=:telefono,fecha_nacimiento=:fecha_nacimiento,domicilio=:domicilio WHERE id=:id";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':identificacion', $identificacion);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':edad', $edad);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
            $stmt->bindParam(':domicilio', $domicilio);
            //$stmt->bindParam(':foto', $foto);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $msgSuccess = "El paciente se edito con exito.";
        } catch (PDOException $e) {
            $msgError = $e->getMessage();
        }
    }
}

function fechaValida($fecha) {
    $valores = explode('-', $fecha);
    return (count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0]));
}

?>