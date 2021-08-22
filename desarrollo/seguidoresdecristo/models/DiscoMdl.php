<?php

/**
 * Description of DiscoMdl
 *
 * @author benito
 */
class DiscoMdl extends ConexionPHP {

    // id, nombre, artista, fecha, num_pistas, genero, descripcion, status, id_usuario, imagen, link, link_status, categoria_id
    public $conn = null;

    public function __construct() {
        $this->conn = $this->conn();
    }

    private function create($datos) {

        $sql = "INSERT INTO discos(nombre, artista, fecha, num_pistas, genero, descripcion, status, id_usuario, imagen, link, link_status, categoria_id) ";
        $sql .= "VALUES(nombre, artista, now(), num_pistas, genero, descripcion, status, id_usuario, imagen, link, link_status, categoria_id)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':artista', $datos['artista']);
        $stmt->bindParam(':num_pistas', $datos['num_pistas']);
        $stmt->bindParam(':genero', $datos['genero']);
        $stmt->bindParam(':descripcion', $datos['descripcion']);
        $stmt->bindParam(':status', false);
        $stmt->bindParam(':id_usuario', $datos['id_usuario']);
        $stmt->bindParam(':imagen', $datos['imagen']);
        $stmt->bindParam(':link', $datos['link']);
        $stmt->bindParam(':link_status', true);
        $stmt->bindParam(':categoria_id', $datos['categoria_id']);
        $stmt->execute();
        
        
    }

    private function update($datos) {
        
    }

    private function readAll() {
        
    }

    private function readId($id) {
        
    }

    private function readSatus($status) {
        
    }

    private function readCategoria($categori) {
        
    }

}
