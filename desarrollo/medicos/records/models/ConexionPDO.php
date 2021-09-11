<?php

/**
 * Description of ConexionPDO
 *
 * @author benito
 */
class ConexionPDO {

    private $servername = "localhost";
    private $database = "sisoft_php";
    private $username = "root";
    private $password = "";
    private $message = "";
    private $conn = null;

    public function __construct() {
        
    }

    function getMessage() {
        return $this->message;
    }

    function getConn() {
        return $this->conn;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function isConnection() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=" . $this->database, $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return TRUE;
        } catch (PDOException $e) {
            $this->message = $e->getMessage();
            $this->conn = null;
            return FALSE;
        }
    }
    
    function closeConnection() {
        $this->conn =null;
    }

}
?>