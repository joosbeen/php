<?php
include_once 'config/session.php';
if (!sesionCreada()) {
header("Location:../index.php");
}

include_once 'config/conn.php';

$edit = filter_input(INPUT_GET, "edit");

$id = filter_input(INPUT_POST, "id");
$nombre = filter_input(INPUT_POST, "nombre");
$num_pistas = filter_input(INPUT_POST, "num_pistas");
$genero = filter_input(INPUT_POST, "genero");
$descripcion = filter_input(INPUT_POST, "descripcion");
$status = "";
$fecha = filter_input(INPUT_POST, "fecha");

$msgError = "";
$msgSuccess = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($edit)) {

  $id = desencriptar($edit);
  $stmt = $conn->prepare("SELECT * FROM discos WHERE id=:id;");
  $stmt->execute([':id' => $id]);
  $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $nombre = $datos[0]["nombre"];
  $fecha = $datos[0]["fecha"];
  $num_pistas = $datos[0]["num_pistas"];
  $genero = $datos[0]["genero"];
  $descripcion = $datos[0]["descripcion"];
  $status = $datos[0]["status"];
  $imagen = $datos[0]["imagen"];
  
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //vALIDAR CAMPOS
  if (empty($nombre)) {
    $msgError .= "El campo Album, es obligatorio.<br>";
  }
  if (empty($num_pistas)) {
    $msgError .= "El campo 'Num. Pistas', es obligatorio.<br>";
  }
  if (empty($genero)) {
    $msgError .= "El campo Género, es obligatorio.<br>";
  }

  if ($connMsgError == "" && $msgError == "") {    

      try {

        $stmt = null;
        $id_sql = 0;
      
        if (empty($id)) {

          $sql = "INSERT INTO discos(nombre, fecha, num_pistas, genero, descripcion, id_usuario) 
          VALUES (:nombre, :fecha, :num_pistas, :genero, :descripcion, 1);";
          $stmt = $conn->prepare($sql);

        } else {

          $id_sql = desencriptar($id);
          $sql = "UPDATE discos SET nombre=:nombre,fecha=:fecha,num_pistas=:num_pistas,genero=:genero,descripcion=:descripcion WHERE id=:id";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':id', $id_sql);
          
        }

          
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':num_pistas', $num_pistas);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':descripcion', $descripcion);
        //$stmt->bindParam(':imagen', $imagen);

        $stmt->execute();

        $id_sql = ($id_sql === 0) ? $conn->lastInsertId() : $id_sql;

        $edit = encriptar($id_sql);


        $target_dir = "../src/img/disco/". $id_sql . "/";
        $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $src = "";
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if($check !== false) {
          
          if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
              //$msgError = "The file ". htmlspecialchars( basename( $_FILES["imagen"]["name"])). " has been uploaded.";
            $src = "src/img/disco/" . $id_sql . "/". basename($_FILES["imagen"]["name"]);
          
            $sql = "UPDATE discos SET imagen='$src' WHERE id=".$id_sql;
            $imagen = $src;
            // Prepare statement
            $stmt = $conn->prepare($sql);

            // execute the query
            $stmt->execute();
          } else {
              $msgError = "Sorry, there was an error uploading your file.";
          }
        }

        $msgSuccess .= "La operación fue exitosa, se ";
        $msgSuccess .= empty($id) ? "registro" : "actualizo";
        $msgSuccess .= " el disco. " . $src . " <--> " . $target_file;
        
      } catch(PDOException $e) {
        $msgError .= $e->getMessage();
      }
  }

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
      <form class="w3-container w3-card-4 w3-light-grey" method="post" enctype="multipart/form-data">
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
            <p><label>Nombre Album</label>
            <input class="w3-input w3-border" name="nombre" id="nombre" type="text" value="<?php echo $nombre; ?>" required></p>
          </div>
          <div class="w3-col l3 m4 s12 w3-padding">
            <p><label>Num. Pista</label>
            <input class="w3-input w3-border" name="num_pistas" id="num_pistas" type="number" min="1" value="<?php echo $num_pistas; ?>" required></p>
          </div>
          <div class="w3-col l3 m4 s12 w3-padding">
            <p><label>Género</label>
            <input class="w3-input w3-border" name="genero" id="genero" type="text" value="<?php echo $genero; ?>" placeholder="Rock, Rock Alternativo, Adoracion,.." required></p>
          </div>
          <div class="w3-col l3 m4 s12 w3-padding">
            <p><label>Fecha</label>
            <input class="w3-input w3-border" name="fecha" id="fecha" type="date" value="<?php echo $fecha; ?>" required></p>
          </div>
          <div class="w3-col l3 m4 s12 w3-padding">
            <p><label>Estado</label>
            <input class="w3-input w3-border" type="text" value="<?php echo (($status=="1") ? "Activo" : "Inactivo"); ?>" disabled></p>
          </div>
          <div class="w3-col l3 m4 s12 w3-padding">
            <p>
              <label>
                Imagen 
                <?php if(!empty($imagen)){ ?>
                <span class="w3-blue" onclick="document.getElementById('mdlImagen').style.display='block'" style="padding-left:10px;padding-right:10px;cursor: pointer;">
                  <i class="fa fa-eye"></i> Ver</span>
                <?php } ?>
              </label><br>
              <input class="w3-input w3-border" type="file" name="imagen" id="imagen" accept="image/*" id="status">
            </p>
          </div>
          <div class="w3-col l3 m4 s12 w3-padding">
            <p><label>Descripción</label>
              <textarea class="w3-input w3-border" name="descripcion" id="descripcion" rows="3"> <?php echo $descripcion; ?></textarea></p>
          </div>
        </div>
        <div class="w3-row">
          <div class="w3-col l6 m6 s12 w3-padding">
            <button class="w3-btn w3-right w3-green"><i class="fa fa-floppy-o" aria-hidden="true"></i> GUARDAR</button>
          </div>
          <div class="w3-col l6 m6 s12 w3-padding">
            <a href="artist-records-details.php" class="w3-btn w3-left w3-red" type="reset"><i class="fa fa-trash" aria-hidden="true"></i> LIMPIAR</a>
          </div>
        </div>
        <br>
      </form>
      <!-- The Modal -->
      <div id="mdlImagen" class="w3-modal">
        <div class="w3-modal-content" style="width:250px;">
          <div class="w3-container">
            <span onclick="document.getElementById('mdlImagen').style.display='none'"
            class="w3-button w3-display-topright">&times;</span>
            <img src="<?php echo "../" . $imagen; ?>" class="w3-image" alt="<?php echo $nombre; ?>">
          </div>
        </div>
      </div>  
      <?php } ?>
    </div>
    <?php include_once 'includes/footer.php' ?>
    
    <script src="src/js/index.js"></script>
    <?php $conn = null; ?>
  </body>
</html>