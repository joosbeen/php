<?php

/**
 * Description of UsuariosMdl
 *
 * @author benito
 */
class UsuarioMdl {

    private $usuario = array(
        'id' => '',
        'nombre' => '',
        'usuario' => '',
        'estado' => '0',
        'id_rol' => '',
        'action' => 'insert',
        'msgSuccess' => '',
        'msgError' => '');

    public function filasTablaUsuarios() {

        $conexion = new ConexionPDO();

        if ($conexion->isConnection()) {

            $conn = $conexion->getConn();

            $sql = "SELECT mu.*, mr.rol FROM medico_usuarios mu, medico_roles mr WHERE mu.id_rol = mr.id ;";

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $datos = $stmt->fetchAll();

            if (count($datos) > 0) {

                foreach ($datos as $key => $value) {
                    echo "<tr>";
                    echo "<td>" . $value["nombre"] . "</td>";
                    echo "<td>" . $value["usuario"] . "</td>";
                    //echo '<td class="text-center"><button type="button" class="btn btn-outline-dark btn-sm btnEditarContrasena" name="' . $value["usuario"] . '" value="' . $value["id"] . '" data-toggle="modal" data-target="#mdlEditarContrasena">Editar</button></td>';
                    echo "<td>" . (($value["estado"]) ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-danger">Inactivo</span>') . "</td>";
                    echo "<td>" . $value["rol"] . "</td>";
                    echo '<td class="text-center"><button type="button" class="btn btn-outline-warning btn-sm btnEditar" value="' . $value["id"] . '">Editar</button></td>';
                    echo "</tr>";
                }
            } else {
                echo '<tr><td colspan=""></td></tr>';
            }
            $conexion->closeConnection();
        } else {
            echo '<tr><td colspan=""></td></tr>';
        }
    }

    public function cargarDatos() {

        if (isset($_POST["load"]) && $_POST['load'] == "update") {

            $id = $_POST['id'];

            $conexion = new ConexionPDO();

            if ($conexion->isConnection()) {

                $conn = $conexion->getConn();

                $sql = "SELECT mu.*, mr.rol FROM medico_usuarios mu, medico_roles mr WHERE mu.id_rol = mr.id ;";

                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $datos = $stmt->fetchAll();

                if (count($datos) > 0) {

                    $this->usuario['id'] = $datos[0]['id'];
                    $this->usuario['nombre'] = $datos[0]['nombre'];
                    $this->usuario['usuario'] = $datos[0]['usuario'];
                    $this->usuario['action'] = "update";
                    $this->usuario['estado'] = $datos[0]['estado'];
                    $this->usuario['id_rol'] = $datos[0]['id_rol'];
                } else {
                    $this->usuario['msgError'] = "Error en los datos enviados.";
                }
                $conexion->closeConnection();
            } else {
                $this->usuario['msgError'] = "Error en el servidor.";
            }
        }

        return $this->usuario;
    }

    public function updateUsuario($user) {

        if (isset($_POST["action"]) && $_POST['action'] == "update") {

            $msg = $this->validarCampos($_POST);

            if ($msg == "") {
                $sql = "UPDATE medico_usuarios SET nombre=:nombre, usuario=:usuario, estado=:estado, id_rol=:id_rol WHERE id=:id";
                $user = $this->create_update_usuario($sql, true);
            } else {
                $user['msgError'] = $msg;
            }
        }
        return $user;
    }

    public function insertUsuario($user) {

        if (isset($_POST["action"]) && $_POST['action'] == "insert") {

            $msg = $this->validarCampos($_POST);

            if ($msg == "") {
                $sql = "INSERT INTO medico_usuarios(nombre, usuario, estado, id_rol) VALUES (:nombre, :usuario, :estado, :id_rol);";
                $user =  $this->create_update_usuario($sql, false);
            } else {
                $user['msgError'] = $msg;
            }
        }
        return $user;
    }

    private function create_update_usuario($sql, $isUpdate) {

        try {

            $conexion = new ConexionPDO();
            $conexion->isConnection();
            $conn = $conexion->getConn();
            $id = 0;
            $msg = "";

            // prepare sql and bind parameters
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nombre', $_POST['nombre']);
            $stmt->bindParam(':usuario', $_POST['usuario']);
            $stmt->bindParam(':estado', $_POST['estado']);
            $stmt->bindParam(':id_rol', $_POST['id_rol']);
            if ($isUpdate) {
                $stmt->bindParam(':id', $_POST['id']);
                $id = $_POST['id'];
                $msg = "El usuario se edito con exito!";
            }

            $stmt->execute();

            if (!$isUpdate) {
                $id = $conn->lastInsertId();
                $msg = "El usuario se registro con exito!";
            }

            $this->usuario['id'] = $_POST['id'];
            $this->usuario['nombre'] = $_POST['nombre'];
            $this->usuario['usuario'] = $_POST['usuario'];
            $this->usuario['action'] = "update";
            $this->usuario['estado'] = $_POST['estado'];
            $this->usuario['id_rol'] = $_POST['id_rol'];

            $this->usuario['msgSuccess'] = $msg;

        } catch (PDOException $e) {

            $this->usuario['action'] =  ($isUpdate) ? 'update' : 'insert';
            $this->usuario['msgError'] = "Error: " . $e->getMessage();
        }
        
        return $this->usuario;
    }

    private function validarCampos($datos) {

        $msg = "";

        $nombre = (isset($datos['nombre']) ? $datos['nombre'] : '');
        $usuario = (isset($datos['usuario']) ? $datos['usuario'] : '');
        $usuariosub = (isset($datos['usuario']) ? $datos['usuario'] : '');

        if ($nombre == "" || empty($nombre)) {
            $msg .= "<b>*</b> El campo Nombre es obligatorio.<br>";
        }

        if ($usuario == "" || empty($usuario)) {
            $msg .= "<b>*</b> El campo Usuario es obligatorio.<br>";
        }

        if ($usuario != $usuariosub) {
            $msg .= "<b>*</b> El campo Usuario no debe contener espacios.<br>";
        }

        return $msg;
    }

}

?>