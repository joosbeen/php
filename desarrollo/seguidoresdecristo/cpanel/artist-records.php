<?php
include_once 'config/session.php';
if (!sesionCreada()) {
header("Location:../index.php");
}
//include_once 'config/constants.php';
include_once 'config/conn.php'
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
    <div class="w3-container" style="margin-top: 70px;">
      <?php if ($connMsgError != ""){ ?>
      <div class="w3-panel w3-blue w3-card-4"><p><?php echo $connMsgError. (isset($_GET['debug']) ? "<br>".$connMsgBug : "") ?></p></div>
      <?php } else{ ?>
      <header class="w3-container" style="padding-top:22px">
        <h3><b><i class="fa fa-microphone-slash" aria-hidden="true"></i> Mis Albums</b></h3>
        <a href="artist-records-details.php" class="w3-btn w3-black w3-right">
          <i class="fa fa-microphone-slash" aria-hidden="true"></i> + Album
        </a>
      </header>
      <div class="w3-responsive">
        <table class="w3-table-all">
          <thead>
            <tr class="w3-blue-grey">
              <th>Album</th>
              <th>Fecha</th>
              <th>Num. Pistas</th>
              <th>Género</th>
              <th>Estado</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            
            $sql = "SELECT * FROM discos WHERE id_usuario=1;";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $usuarios = $stmt->fetchAll();
            if (count($usuarios) > 0) {
            // output data of each row
            foreach($usuarios as $row) {
            echo '
            <tr>
              <td>'. $row["nombre"] .'</td>
              <td>'. $row["fecha"] .'</td>
              <td>'. $row["num_pistas"] .'</td>
              <td>'. $row["genero"] .'</td>
              <td>'. $row["status"] .'</td>
              <td>
                <a href="artist-records-details.php?edit=' . urlencode(encriptar($row["id"])) .'" class="w3-btn w3-black w3-right">
                  <i class="fa fa-edit"></i> Edit
                </a>
              </td>
            </tr>';
            }
            } else {
            echo '<tr><td colspan="6" class="w3-text-red w3-center">No se encontro registros</td></tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
      <?php } ?>
      <br>
    </div>
    <?php include_once 'includes/footer.php' ?>
    
    <script src="src/js/index.js"></script>
    <?php $conn = null; ?>
  </body>
</html>