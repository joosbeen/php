<?php
include_once 'constants.php';
$conn;
$connMsgError = "";
$connMsgBug = "";
try {

	$conn = new PDO("mysql:host=" . _DB_SERVER_NAME . ";dbname=" . _DB_NAME, _DB_USER_NAME, _DB_USER_PASS);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
} catch (PDOException $e) {
	$conn = null;
	//echo "Connection failed: " . $e->getMessage();
  $connMsgError = "Lo sentimos tenemos problemas con el servidor, intentolo mas tarde.";
  $connMsgBug = "Connection failed: " . $e->getMessage();;
}
?>