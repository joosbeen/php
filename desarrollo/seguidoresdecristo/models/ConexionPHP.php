<?php
require_once '../cpanel/config/constants.php';
/**
 * Description of ConexionPHP
 *
 * @author benito
 */
class ConexionPHP {

    public function conn() {
        try {
            $conn = new PDO("mysql:host="._DB_SERVER_NAME.";dbname="._DB_NAME, _DB_USER_NAME, _DB_USER_PASS);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return conn;
        } catch (PDOException $e) {
            return NULL;
        }
    }

}
