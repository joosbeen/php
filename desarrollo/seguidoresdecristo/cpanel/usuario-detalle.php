<?php
include_once 'config/session.php';
if (!sesionCreada()) {
header("Location:../index.php");
}
if (rolUserio() != "ROLE_ADMIN") {
header("Location:index.php");
}
include_once 'config/conn.php';

$edit = filter_input(INPUT_GET, "edit");
$id = filter_input(INPUT_POST, "id");
$username = filter_input(INPUT_POST, "username");
$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");
$password_c = filter_input(INPUT_POST, "password_c");
$status = filter_input(INPUT_POST, "status");
$role = filter_input(INPUT_POST, "role");
$nombre = filter_input(INPUT_POST, "nombre");

$msgError = "";
$msgSuccess = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($edit)) {

  $id = desencriptar($edit);
  $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id=:id;");
  $stmt->execute([':id' => $id]);
  $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $username = $datos[0]["username"];
  $email = $datos[0]["email"];
  $password = $datos[0]["password"];
  $status = $datos[0]["status"];
  $role = $datos[0]["role"];
  $nombre = $datos[0]["nombre"];
  
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //vALIDAR CAMPOS
  if (empty($nombre) || ctype_space($nombre)) {
    $msgError .= "El campo Nombre de Arista/Agrupación, es obligatorio.<br>";
  }
  if (empty($username) || ctype_space($username)) {
    $msgError .= "El campo Usuario, es obligatorio, y no debe contener espacios en blancos.<br>";
  }
  if (empty($email) || ctype_space($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $msgError .= "El campo Correo, es obligatorio y debe contener el formato correcto.<br>";
  }
  if (empty($id) && (empty($password) || ctype_space($password))) {
    $msgError .= "El campo Contraseña, es obligatorio y debe contener el formato correcto.<br>";
  }
  if ($password != $password_c) {
    $msgError .= "El campo 'Contraseña Confirmar' no coincide con 'Contrseña', es obligatorio y debe contener el formato correcto.<br>";
  }
  if (empty($role) || ctype_space($role) || ($role != "1" && $role != "2")) {
    $msgError .= "El campo Role, es incorrecto.<br>";
  }

  if ($connMsgError == "" && $msgError == "") {    

      try {

        $stmt = null;
        $msg = "";
      
        if (empty($id)) {

          //$msgSuccess .= "registro<br>";
          
          if (exiteCampo($conn, "SELECT * FROM usuarios WHERE nombre=:nombre;", "nombre", $nombre)) {
            $msgError .= "El Nombre de Arista/Agrupación ya se encuentra registrado, ingrese otro.<br>";
          }

          if (exiteCampo($conn, "SELECT * FROM usuarios WHERE username=:username;", "username", $username)) {
            $msgError .= "El Usuario ya se encuentra registrado, ingrese otro.<br>";
          }
          
          if (exiteCampo($conn, "SELECT * FROM usuarios WHERE email=:email;", "email", $email)) {
            $msgError .= "El Correo ya se encuentra registrado, ingrese otro.<br>";
          }

          if ($msgError == "") {

            $sql = "INSERT INTO usuarios(username, email, password, status, role, nombre) VALUES (:username, :email, password(:password), :status, :role, :nombre);";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':password', $password);

          }

        } else {

          //$msgSuccess .= "actualizar<br>";

          $id_desen = desencriptar($id);
          $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id=:id;");
          $stmt->execute([':id' => $id_desen]);
          $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

          if ($usuarios[0]["nombre"] != $nombre) {
            if (exiteCampo($conn, "SELECT * FROM usuarios WHERE nombre=:nombre;", "nombre", $nombre)) {
              $msgError .= "El Nombre de Arista/Agrupación ya se encuentra registrado, ingrese otro.<br>";
            }
          }

          if ($usuarios[0]["username"] != $username) {
            if (exiteCampo($conn, "SELECT * FROM usuarios WHERE username=:username;", "username", $username)) {
              $msgError .= "El Usuario ya se encuentra registrado, ingrese otro.<br>";
            }
          }

          if ($usuarios[0]["email"] != $email) {
            if (exiteCampo($conn, "SELECT * FROM usuarios WHERE email=:email;", "email", $email)) {
              $msgError .= "El Correo ya se encuentra registrado, ingrese otro.<br>";
            }
          }

          if ($msgError == "") {
            
            if (empty($password) || $password == "") {

              $sql = "UPDATE usuarios SET username=:username,email=:email,status=:status,role=:role,nombre=:nombre WHERE id=:id;";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(':id', $id_desen);

            } else {

              $sql = "UPDATE usuarios SET username=:username,email=:email,password=:password,status=:status,role=:role,nombre=:nombre WHERE id=:id;";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(':password', $password);
              $stmt->bindParam(':id', $id_desen);

            }
            
          }
          
        }

        if ($msgError == "") {        

          $role = ($role == "1") ? "ROLE_ADMIN" : "ROLE_ARTISTA";
          $status = ($status == "1" || $status == "on" || $status == "true") ? "1" : "0";
          
          $stmt->bindParam(':username', $username);
          $stmt->bindParam(':email', $email);
          $stmt->bindParam(':status', $status);
          $stmt->bindParam(':role', $role);
          $stmt->bindParam(':nombre', $nombre);
          $stmt->execute();

          $edit = (empty($id)) ? encriptar($conn->lastInsertId()) : $id;
          $msgSuccess .= "La operación fue exitosa, se ";
          $msgSuccess .= empty($id) ? "registro" : "actualizo";
          $msgSuccess .= " el usuario";
        }

      } catch(PDOException $e) {
        $msgError .= $e->getMessage();
      }
  }

}

function exiteCampo($conn, $sql, $campo, $valor) {
  $stmt = $conn->prepare($sql);
  $stmt->execute([':'.$campo => $valor]);
  $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return (count($arr)>0);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <?php include_once 'includes/files.php' ?>
    <style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
    
    body, html {
    height: 100%;
    line-height: 1.8;
    }
    .w3-bar .w3-button {
    padding: 16px;
    }
    </style>
  </head>
  <body>
    <?php include_once 'includes/navegation.php' ?>
    <div class="w3-margin-bottom w3-container" style="margin-top: 70px;">
      <?php if ($connMsgError != ""){ ?>
      <div class="w3-panel w3-blue w3-card-4">
        <p><?php echo $connMsgError. (isset($_GET['debug']) ? "<br>".$connMsgBug : "") ?></p>
      </div>
      <?php } else{ ?>
      <header class="w3-container">
        <h3><b><i class="fa fa-user"></i> Detalle Usuario</b></h3>
      </header>
      <br>
      <form class="w3-container w3-card-4 w3-light-grey" method="post">
        <?php if ($msgError != ""): ?>
        <div class="w3-panel w3-blue w3-card-4">
          <p><?php echo $msgError; ?></p>
        </div>
        <?php endif ?>
        <?php if ($msgSuccess != ""): ?>
        <div class="w3-panel w3-green w3-card-4">
          <p><?php echo $msgSuccess; ?></p>
        </div>
        <?php endif ?>
        <input type="hidden" name="id" value="<?php echo $edit; ?>">
        <div class="w3-row">
          <div class="w3-col l3 m4 s12 w3-padding">
            <p><label>Nombre de Arista/Agrupación</label>
            <input class="w3-input w3-border" name="nombre" id="nombre" type="text" value="<?php echo $nombre; ?>" required></p>
          </div>
          <div class="w3-col l3 m4 s12 w3-padding">
            <p><label>Usuario</label>
            <input class="w3-input w3-border" name="username" id="username" type="text" value="<?php echo $username; ?>" required></p>
          </div>
          <div class="w3-col l3 m4 s12 w3-padding">
            <p><label>Correo</label>
            <input class="w3-input w3-border" name="email" id="email" type="email" value="<?php echo $email; ?>" required></p>
          </div>
          <div class="w3-col l3 m4 s12 w3-padding">
            <p><label>Contraseña</label>
            <input class="w3-input w3-border" name="password" id="password" type="password"  <?php echo (empty($edit) ? "required" : ""); ?>></p>
          </div>
          <div class="w3-col l3 m4 s12 w3-padding">
            <p><label>Contraseña Confirmar</label>
            <input class="w3-input w3-border" name="password_c" id="password_c" type="password" <?php echo (empty($edit) ? "required" : ""); ?>></p>
          </div>
          <div class="w3-col l3 m4 s12 w3-padding">
            <p><label>ROLE</label>
            <select class="w3-select" name="role" id="role" required>
              <option value="1">ROLE_ADMIN</option>
              <option value="2">ROLE_ARTISTA</option>
            </select></p>
          </div>
          <div class="w3-col l3 m4 s12 w3-padding">
            <p>
              <label>Estado</label><br>
              <input class="w3-check" type="checkbox" name="status" id="status">
            </p>
          </div>
        </div>
        <div class="w3-row">
          <div class="w3-col l6 m6 s12 w3-padding">
            <button class="w3-btn w3-right w3-green"><i class="fa fa-floppy-o" aria-hidden="true"></i> GUARDAR</button>
          </div>
          <div class="w3-col l6 m6 s12 w3-padding">
            <button class="w3-btn w3-left w3-red"><i class="fa fa-trash" aria-hidden="true"></i> LIMPIAR</button>
          </div>
        </div>
        <br>
      </form>
      <?php } ?>
      
    </div>
    <?php include_once 'includes/footer.php' ?>
    
    <script src="src/js/index.js"></script>
    <?php $conn = null; ?>
  </body>
</html>