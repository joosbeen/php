<?php

require_once './models/connPDO.php';
require_once './models/util-valid.php';

// Campos de formulario
$id = filter_input(INPUT_POST, "id");
$nombre_comercial = filter_input(INPUT_POST, "nombre_comercial");
$nombre_generico = filter_input(INPUT_POST, "nombre_generico");
$concentracion = filter_input(INPUT_POST, "concentracion");
$lote = filter_input(INPUT_POST, "lote");
$fecha_caducidad = filter_input(INPUT_POST, "fecha_caducidad");
$precio = filter_input(INPUT_POST, "precio");

// variables globales
$msgSuccess = "";
$msgError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['action']) && $_POST['action'] == "load") {

        $sql = "SELECT * FROM medico_medicamentos WHERE id=$id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $medicamentos = $stmt->fetchAll();

        if (count($medicamentos) > 0) {
            // Código para cargar datos del formulario.
            $id = $medicamentos[0]["id"];
            $nombre_comercial = $medicamentos[0]["nombre_comercial"];
            $nombre_generico = $medicamentos[0]["nombre_generico"];
            $concentracion = $medicamentos[0]["concentracion"];
            $lote = $medicamentos[0]["lote"];
            $fecha_caducidad = $medicamentos[0]["fecha_caducidad"];
            $precio = $medicamentos[0]["precio"];
        } else {
            // Error, no se encontro datos.
            $msgError = "Error, no se cargo los datos del Medicamento.";
        }
    } else {

        // Validar formulario (insert, update).
        if (!obligatorioTexto($nombre_comercial)) {
            $msgError .= "El 'Nombre Comercial' es obligatorio.<br>";
        } else if (strlen(removerEspacios($nombre_comercial)) < 3) {
            $msgError .= "El 'Nombre Comercial' debe contener tres caracteres mínimo [Aa-Zz][0-9].<br>";
        }

        if (!obligatorioTexto($nombre_generico)) {
            $msgError .= "El 'Nombre Génerico' es obligatorio.<br>";
        } else if (strlen(removerEspacios($nombre_generico)) < 3) {
            $msgError .= "El 'Nombre Génerico' debe contener tres caracteres mínimo [Aa-Zz][0-9].<br>";
        }

        if (!obligatorioTexto($concentracion)) {
            $msgError .= "La 'Concentración' es obligatorio.<br>";
        } else if (strlen(removerEspacios($concentracion)) < 3) {
            $msgError .= "La 'Concentración' debe contener tres caracteres mínimo [Aa-Zz][0-9].<br>";
        }

        if (!obligatorioTexto($lote)) {
            $msgError .= "El 'Lote' es obligatorio.<br>";
        } else if (strlen(removerEspacios($lote)) < 1) {
            $msgError .= "El 'Lote' debe contener tres caracteres mínimo [Aa-Zz][0-9].<br>";
        }

        if (!obligatorioTexto($fecha_caducidad)) {
            $msgError .= "La 'Fecha' es obligatorio.<br>";
        } else if (!fechaValida($fecha_caducidad)) {
            $msgError .= "La 'Fecha' no tiene el formato correcto AÑO-MES-DIA [Aa-Zz][0-9].<br>";
        }

        if (!obligatorioTexto($precio)) {
            $msgError .= "El 'Precio' es obligatorio.<br>";
        } else if (!is_numeric($precio)) {
            $msgError .= "El 'Precio' solo debe contener números y/o un punto [.][0-9].<br>";
        }

        //##### Si los campos son validos $msgError esta vacio.

        if ($msgError == "") {
            try {

                $sql = "SELECT * FROM medico_medicamentos WHERE nombre_comercial like :nombre_comercial AND  nombre_generico=:nombre_generico AND concentracion=:concentracion AND lote like :lote AND fecha_caducidad=:fecha_caducidad AND CAST(precio AS CHAR) = CAST(:precio AS CHAR) LIMIT 1;";

                if (!empty($id)) {
                    $sql = "SELECT * FROM medico_medicamentos WHERE nombre_comercial=:nombre_comercial AND  nombre_generico=:nombre_generico AND concentracion=:concentracion AND lote=:lote AND fecha_caducidad=:fecha_caducidad AND CAST(precio AS CHAR) = CAST(:precio AS CHAR) AND id!=:id LIMIT 1;";
                }

                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':nombre_comercial', $nombre_comercial);
                $stmt->bindParam(':nombre_generico', $nombre_generico);
                $stmt->bindParam(':concentracion', $concentracion);
                $stmt->bindParam(':lote', $lote);
                $stmt->bindParam(':fecha_caducidad', $fecha_caducidad);
                $stmt->bindParam(':precio', $precio);
                if (!empty($id)) {
                    $stmt->bindParam(':id', $id);
                }

                $stmt->execute();

                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $datos = $stmt->fetchAll();
                var_dump($datos);
                if (count($datos) > 0) {
                    $msgError = "El ya se encuentra registrado un producto con los mismos datos.";
                }

                if ($msgError == "") {

                    $sql = "INSERT INTO medico_medicamentos(nombre_comercial, nombre_generico, concentracion, lote, fecha_caducidad, precio) VALUES (:nombre_comercial, :nombre_generico, :concentracion, :lote, :fecha_caducidad, :precio);";

                    if (!empty($id)) {
                        $sql = "UPDATE medico_medicamentos SET nombre_comercial=:nombre_comercial,nombre_generico=:nombre_generico,concentracion=:concentracion,lote=:lote,fecha_caducidad=:fecha_caducidad,precio=:precio WHERE id=:id";
                    }

                    $stmt = $conn->prepare($sql);

                    $stmt->bindParam(':nombre_comercial', $nombre_comercial);
                    $stmt->bindParam(':nombre_generico', $nombre_generico);
                    $stmt->bindParam(':concentracion', $concentracion);
                    $stmt->bindParam(':lote', $lote);
                    $stmt->bindParam(':fecha_caducidad', $fecha_caducidad);
                    $stmt->bindParam(':precio', $precio);
                    if (!empty($id)) {
                        $stmt->bindParam(':id', $id);
                    }

                    $stmt->execute();
                    $msgSuccess = "Se actualizo el medicamento.";
                    if (empty($id)) {
                        $id = $conn->lastInsertId();
                        $msgSuccess = "Se registro el medicamento.";
                    }
                }
            } catch (PDOException $e) {
                $msgError = "Error: " . $e->getMessage();
            }
        }
    }
}
?>