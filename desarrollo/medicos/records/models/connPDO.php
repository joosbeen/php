 <?php
  require_once 'constant.php';
  $conn = null;
  try {
    $conn = new PDO("mysql:host=" . DB_SERVERNAME . ";dbname=" . DB_NAME, DB_USERNAME, DB_USERPASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
?>
