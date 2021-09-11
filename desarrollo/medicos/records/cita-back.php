<?php

require_once './models/connPDO.php';
require_once './models/util-valid.php';

// Campos de formulario
$id = filter_input(INPUT_POST, "id");
$id_med_paciente = filter_input(INPUT_POST, "id_med_paciente");
$dia = filter_input(INPUT_POST, "dia");
$hora = filter_input(INPUT_POST, "hora");
$id_med_estado = filter_input(INPUT_POST, "id_med_estado");

if (empty($dia)) {
    $dia = date("Y-m-d");
}

if (empty($hora)) {
    $hora = date("h:i");
}

// variables globales
$msgSuccess = "";
$msgError = "";

function optionSelectPacientes() {
    try {
        $conne = new PDO("mysql:host=" . DB_SERVERNAME . ";dbname=" . DB_NAME, DB_USERNAME, DB_USERPASS);
        $conne->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM medico_pacientes;";
        $stmt = $conne->prepare($sql);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $pacientes = $stmt->fetchAll();

        if (count($pacientes) > 0) {
            foreach ($pacientes as $key => $p) {
                echo '<option data-tokens="' . $p["nombre"] . '" value="' . $p["id"] . '"><b>' . $p["nombre"] . '</b></option>';
            }
        } else {
            echo '<option disable>Sin pacientes.</option>';
        }
    } catch (PDOException $e) {
        echo '<option disable>Error en el servidor.</option>';
    } finally {
        $conne = null;
    }
}

function optionSelectEstados() {
    try {
        $conne = new PDO("mysql:host=" . DB_SERVERNAME . ";dbname=" . DB_NAME, DB_USERNAME, DB_USERPASS);
        $conne->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM medico_estados;";
        $stmt = $conne->prepare($sql);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $estados = $stmt->fetchAll();

        if (count($estados) > 0) {
            foreach ($estados as $key => $e) {
                echo '<option data-tokens="' . $e["estado"] . '" value="' . $e["id"] . '"><b>' . $e["estado"] . '</b></option>';
            }
        } else {
            echo '<option disable>Sin medicamentos registrados</option>';
        }
    } catch (PDOException $e) {
        echo '<option disable>Error en el servidor.</option>';
    } finally {
        $conne = null;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {



    if (!obligatorioTexto($id_med_paciente)) {
        $msgError .= "El 'Paciente' es obligatorio.<br>";
    } else if (!is_numeric($id_med_paciente)) {
        $msgError .= "'Paciente' error en el dato enviado.<br>";
    }

    if (!obligatorioTexto($dia)) {
        $msgError .= "La 'Fecha' es obligatorio.<br>";
    } else if (!fechaValida($dia)) {
        $msgError .= "La 'Fecha' no tiene el formato correcto AÑO-MES-DIA [Aa-Zz][0-9].<br>";
    }

    if (!obligatorioTexto($hora)) {
        $msgError .= "El 'Hora' es obligatorio.<br>";
    } else if (!horaValida($hora)) {
        $msgError .= "'Hora' no tiene el formato correcto HH:MM.$hora<br>";
    }

    if (!obligatorioTexto($id_med_estado)) {
        $msgError .= "El 'Estado' es obligatorio.<br>";
    } else if (!is_numeric($id_med_estado)) {
        $msgError .= "'Estado'  error en el dato enviado.<br>";
    }

    if ($msgError == "") {

        try {

            $sql = "SELECT mc.* FROM medico_citas mc, medico_estados me WHERE mc.id_med_paciente=:id_med_paciente AND mc.fecha=:fecha AND mc.id_med_estado = me.id AND me.estado != 'PRECESO';";

            $fecha = $dia . ' ' . $hora;

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_med_paciente', $id_med_paciente);
            $stmt->bindParam(':fecha', $dia);
            //$stmt->bindParam(':id_med_estado', $id_med_estado);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();
            if (count($datos) > 0) {

                $msgError = "Ya se encuentra registrado una cita.";
                
            } else {

                $sql = "INSERT INTO medico_citas(id_med_paciente, fecha, id_med_estado) VALUES (:id_med_paciente, :fecha, :id_med_estado)";

            }
        } catch (PDOException $e) {
            $msgError = $e->getMessage();
        }
    }
}
?>
