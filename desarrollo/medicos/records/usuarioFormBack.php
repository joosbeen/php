<?php

require_once './models/connPDO.php';


$msgSuccess = "";
$msgError = "";

$id = "";
$nombre = "";
$usuario = "";
$estado = "";
$contrasena = "";
$contrasenaconf = "";
$id_rol = "";
$action = "insert";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST['action'] == "load") {

        try {
            $id = $_POST['id'];
            $stmt = $conn->prepare("SELECT * FROM medico_usuarios WHERE id=:id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $usuarios = $stmt->fetchAll();
            if (count($usuarios) > 0) {

                $action = "update";
                $id = $usuarios[0]['id'];
                $nombre = $usuarios[0]['nombre'];
                $usuario = $usuarios[0]['usuario'];
                $estado = $usuarios[0]['estado'];
                $id_rol = $usuarios[0]['id_rol'];
            } else {
                $msgError = "<b>*</b> No se encontro usuario para actualizar.";
            }
        } catch (PDOException $e) {
            $msgError = "no se pudo cargagr los datos del usuario.";
        }
    }

    if ($_POST['action'] == "insert" || $_POST['action'] == "update") {
        $id = filter_input(INPUT_POST, 'id');
        $nombre = filter_input(INPUT_POST, 'nombre');
        $usuario = filter_input(INPUT_POST, 'usuario');
        $estado = filter_input(INPUT_POST, 'estado');
        $contrasena = filter_input(INPUT_POST, 'contrasena');
        $contrasenaconf = filter_input(INPUT_POST, 'contrasenaconf');
        $id_rol = filter_input(INPUT_POST, 'id_rol');
        $action = filter_input(INPUT_POST, 'action');
        $estado = ($estado=="") ? "0" : "1";
    }

    if ($_POST['action'] == "insert") {

        $msgError .= validarCampos();
        $msgError .= validarContrasena();

        if ($msgError == "") {
            try {
                $sql = "INSERT INTO medico_usuarios(nombre, usuario, contrasena, estado, id_rol) VALUES (:nombre, :usuario, PASSWORD(:contrasena), :estado, :id_rol)";

                //$estado = (isset($_POST['estado']) && ($_POST['estado'] == "true" || $_POST['estado'] == "on" || $_POST['estado'] == "1")) ? "1" : "0";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nombre', $_POST['nombre']);
                $stmt->bindParam(':usuario', $_POST['usuario']);
                $stmt->bindParam(':contrasena', $_POST['contrasena']);
                $stmt->bindParam(':estado', $estado);
                $stmt->bindParam(':id_rol', $_POST['id_rol']);
                $stmt->execute();
                $id = $conn->lastInsertId();
                $action = "update";
                $msgSuccess = "Se registro con exito.<br>";
            } catch (PDOException $e) {
                $msgError = "No se registro el usuario, intento mas tarde.<br>";
            }
        }
    }

    if ($_POST['action'] == "update") {

        $msgError .= validarCampos();

        if ($msgError == "") {

            if (!empty($contrasena) && !empty($contrasenaconf)) {

                $msgError = validarContrasena();

                if ($msgError == "") {
                    
                    try {

                        $sql = "UPDATE medico_usuarios SET nombre=:nombre,usuario=:usuario,contrasena=PASSWORD(:contrasena),estado=:estado,id_rol=:id_rol WHERE id=:id;";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':nombre', $nombre);
                        $stmt->bindParam(':usuario', $usuario);
                        $stmt->bindParam(':contrasena', $contrasena);
                        $stmt->bindParam(':estado', $estado);
                        $stmt->bindParam(':id_rol', $id_rol);
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();
                        $msgSuccess = "Se actulizo el usuario con exito.";
                    } catch (PDOException $e) {
                        $msgError = "Error: " . $e->getMessage();
                    }
                }
            } else if (!empty($contrasena) || !empty($contrasenaconf)) {

                $msgError = "<b>*</b> Debe llenar/vaciar los campos de las contraseñas.";
            } else {
                try {
                    $sql = "UPDATE medico_usuarios SET nombre=:nombre,usuario=:usuario,estado=:estado,id_rol=:id_rol WHERE id=:id;";
                    $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':nombre', $nombre);
                        $stmt->bindParam(':usuario', $usuario);
                        $stmt->bindParam(':estado', $estado);
                        $stmt->bindParam(':id_rol', $id_rol);
                        $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    $msgSuccess = "Se actulizo el usuario con exito.";
                } catch (PDOException $e) {
                    $msgError = "Error: " . $e->getMessage();
                }
            }
        }
    }
}

function validarCampos() {

    $msg = "";

    $nombre = filter_input(INPUT_POST, "nombre");
    $usuario = filter_input(INPUT_POST, "usuario");
    $estado = filter_input(INPUT_POST, "estado");
    $id_rol = filter_input(INPUT_POST, "id_rol");

    $estado = ($usuario == "") ? "false" : "true";

    if (empty($nombre)) {
        $msg .= "<b>*</b> El campo Nombre es obligatorio.<br>";
    }


    if (empty($usuario)) {
        $msg .= "<b>*</b> El campo Usuario es obligatorio.<br>";
    } else if ($usuario != str_replace(" ", "", $usuario)) {
        $msg .= "<b>*</b> El campo Usuario contiene espacios.<br>";
    } else if (strlen($usuario) < 6 && strlen($usuario) > 12) {
        $msg .= "<b>*</b> El campo Usuario debe contener de 6 a 12 caracteres.<br>";
    }

    if (empty($id_rol)) {
        $msg .= "<b>*</b> El campo Rol es obligatorio.<br>";
    }

    return $msg;
}

function validarContrasena() {

    $contrasena = $_POST['contrasena'];
    $contrasenaconf = isset($_POST['contrasenaconf']) ? $_POST['contrasenaconf'] : '';

    $msg = "";

    if (empty($contrasena)) {
        $msg .= "<b>*</b> El campos Contraseña es obligatorio.<br>";
    }

    $contrasena = str_replace(" ", "", $contrasena);

    if ($contrasena != $_POST['contrasena']) {
        $msg .= "<b>*</b> El campos Contraseña no debe contener espacios.<br>";
    }
    if (strlen($contrasena) < 6 || strlen($contrasena) > 12) {
        $msg .= "<b>*</b> El campo Contraseña debe contener de 6 a 12 caracteres.<br>";
    }

    if (empty($contrasenaconf)) {
        $msg .= "<b>*</b> El campos Confirmar contraseña es obligatorio.<br>";
    }

    $contrasenaconf = str_replace(" ", "", $contrasenaconf);

    if ($contrasenaconf != $_POST['contrasenaconf']) {
        $msg .= "<b>*</b> El campos Confirmar contraseña no debe contener espacios.<br>";
    }

    if ($contrasenaconf != $contrasenaconf) {
        $msg .= "<b>*</b> No coiniciden.<br>";
    }

    return $msg;
}

?>