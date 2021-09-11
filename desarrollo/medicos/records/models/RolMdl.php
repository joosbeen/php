<?php

/**
 * Description of RolMdl
 *
 * @author benito
 */
class RolMdl {

    private $conexion;

    public function __construct() {
        $this->conexion = new ConexionPDO();
    }

    public function getOption($id_rol) {

        if ($this->conexion->isConnection()) {

            $conn = $this->conexion->getConn();

            $sql = "SELECT * FROM `medico_roles`;";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $roles = $stmt->fetchAll();

            if (count($roles) > 0) {
                foreach ($roles as $rol) {
                echo '<option value="' . $rol["id"] . '" '. (($id_rol == $rol["id"]) ? "selected" : "") .'>' . $rol["rol"] . '</option>';
                }
            } else {
                echo '<option>Sin roles registrados.</option>';
            }
        } else {
            echo '<option>Error al cargar.</option>';
        }
    }

}
