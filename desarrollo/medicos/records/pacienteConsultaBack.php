<?php

require_once("models/constant.php");

function optionSelect() {

	try {
	    $conn = new PDO("mysql:host=" . DB_SERVERNAME . ";dbname=" . DB_NAME, DB_USERNAME, DB_USERPASS);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM medico_medicamentos;";
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		// set the resulting array to associative
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$medicamentos = $stmt->fetchAll();

		if (count($medicamentos)) {
			while($row = $medicamentos) {
		    echo '<option data-tokens="Fresa" value="' . $row["id"] .'"><b>'.
		    $row["nombre_comercial"].'</b> ' 
		    .$row["nombre_generico"]. ' '
		    .$row["concentracion"]. ' '
		    . '</option>';
		  }
		} else {
			echo '<option disable>Sin medicamentos registrados</option>';
		}
	} catch(PDOException $e) {
		echo '<option disable>Error en el servidor.</option>';
	} finally {
		$conn = null;
	}
	
}

if(!isset($_SESSION)) 
{ 
	session_start(); 
}

$id = (isset($_GET['p']) ? $_GET['p'] : "");
$id = (isset($_POST['p']) ? $_POST['p'] : $id);

$_SESSION['datos_subjetivos'] = isset($_SESSION['datos_subjetivos']) ? $_SESSION['datos_subjetivos'] : array();
$_SESSION['datos_exploracion'] = isset($_SESSION['datos_exploracion']) ? $_SESSION['datos_exploracion'] : array();
$_SESSION['datos_diagnostico'] = isset($_SESSION['datos_diagnostico']) ? $_SESSION['datos_diagnostico'] : array();
$_SESSION['datos_pronostico'] = isset($_SESSION['datos_pronostico']) ? $_SESSION['datos_pronostico'] : array();
$_SESSION['datos_tratamiento'] = isset($_SESSION['datos_tratamiento']) ? $_SESSION['datos_tratamiento'] : array();

//########################
//####### Datos subjetivos
//########################
if (isset($_POST['dato']) && isset($_POST['informacion']) && $_POST['dato'] == "subjetivos") {
	
	$_SESSION['datos_subjetivos'][] = array( 'clave'=> "".(time() . ""  . rand(1000, 9999)) , 'sintoma' => $_POST['informacion']);;
}
if (isset($_POST['dato']) && isset($_POST['eliminar']) && $_POST['dato'] == "subjetivos") {
	
	$datos = $_SESSION['datos_subjetivos'];
	$clave = $_POST['eliminar'];
	$datosr = array();

	foreach($datos as $dat){

		if ($clave != $dat['clave']) {
			$datosr[] = $dat;
		}

	}

	$_SESSION['datos_subjetivos'] = $datosr;
}
if (isset($_POST['dato']) && isset($_POST['eliminartodos']) && $_POST['dato'] == "subjetivos") {
	$_SESSION['datos_subjetivos'] = array();
}

//############################
//####### Datos de exploración
//############################
if (isset($_POST['dato']) && isset($_POST['informacion']) && $_POST['dato'] == "exploracion") {
	
	$_SESSION['datos_exploracion'][] = array( 'clave'=> "".(time() . ""  . rand(1000, 9999)) , 'sintoma' => $_POST['informacion']);;
}
if (isset($_POST['dato']) && isset($_POST['eliminar']) && $_POST['dato'] == "exploracion") {
	
	$datos = $_SESSION['datos_exploracion'];
	$clave = $_POST['eliminar'];
	$datosr = array();

	foreach($datos as $dat){

		if ($clave != $dat['clave']) {
			$datosr[] = $dat;
		}

	}

	$_SESSION['datos_exploracion'] = $datosr;
}
if (isset($_POST['dato']) && isset($_POST['eliminartodos']) && $_POST['dato'] == "exploracion") {
	$_SESSION['datos_exploracion'] = array();
}


//############################
//####### Datos de diagnostico
//############################
if (isset($_POST['dato']) && isset($_POST['informacion']) && $_POST['dato'] == "diagnostico") {
	
	$_SESSION['datos_diagnostico'][] = array( 'clave'=> "".(time() . ""  . rand(1000, 9999)) , 'sintoma' => $_POST['informacion']);;
}
if (isset($_POST['dato']) && isset($_POST['eliminar']) && $_POST['dato'] == "diagnostico") {
	
	$datos = $_SESSION['datos_diagnostico'];
	$clave = $_POST['eliminar'];
	$datosr = array();

	foreach($datos as $dat){

		if ($clave != $dat['clave']) {
			$datosr[] = $dat;
		}

	}

	$_SESSION['datos_diagnostico'] = $datosr;
}
if (isset($_POST['dato']) && isset($_POST['eliminartodos']) && $_POST['dato'] == "diagnostico") {
	$_SESSION['datos_diagnostico'] = array();
}

//############################
//####### Datos de pronostico
//############################
if (isset($_POST['dato']) && isset($_POST['informacion']) && $_POST['dato'] == "pronostico") {
	
	$_SESSION['datos_pronostico'][] = array( 'clave'=> "".(time() . ""  . rand(1000, 9999)) , 'sintoma' => $_POST['informacion']);;
}
if (isset($_POST['dato']) && isset($_POST['eliminar']) && $_POST['dato'] == "pronostico") {
	
	$datos = $_SESSION['datos_pronostico'];
	$clave = $_POST['eliminar'];
	$datosr = array();

	foreach($datos as $dat){

		if ($clave != $dat['clave']) {
			$datosr[] = $dat;
		}

	}

	$_SESSION['datos_pronostico'] = $datosr;
}
if (isset($_POST['dato']) && isset($_POST['eliminartodos']) && $_POST['dato'] == "pronostico") {
	$_SESSION['datos_pronostico'] = array();
}

//############################
//####### Datos de tratamiento
//############################
if (isset($_POST['dato']) && isset($_POST['informacion']) && $_POST['dato'] == "tratamiento") {
	
	$_SESSION['datos_tratamiento'][] = array(
		'clave'=> "".(time() . ""  . rand(1000, 9999)) , 
		'medicamento' => $_POST['medicamento'],
		'uso' => $_POST['informacion']
	);
}
if (isset($_POST['dato']) && isset($_POST['eliminar']) && $_POST['dato'] == "tratamiento") {
	
	$datos = $_SESSION['datos_tratamiento'];
	$clave = $_POST['eliminar'];
	$datosr = array();

	foreach($datos as $dat){

		if ($clave != $dat['clave']) {
			$datosr[] = $dat;
		}

	}

	$_SESSION['datos_tratamiento'] = $datosr;
}
if (isset($_POST['dato']) && isset($_POST['eliminartodos']) && $_POST['dato'] == "tratamiento") {
	$_SESSION['datos_tratamiento'] = array();
}


?>