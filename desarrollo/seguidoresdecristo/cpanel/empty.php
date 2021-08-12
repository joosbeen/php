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
    <div class="w3-margin-bottom" style="margin-top: 70px;">
      <?php if ($connMsgError != ""){ ?>
      <div class="w3-panel w3-blue w3-card-4"><p><?php echo $connMsgError. (isset($_GET['debug']) ? "<br>".$connMsgBug : "") ?></p></div>
      <?php } else{ ?>
        <header class="w3-container" style="padding-top:22px">
          <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
        </header>
        <?php if (rolUserio() == "ROLE_ARTIST"){ ?>
        <h1>Su rol es: ROLE_ARTIST</h1>
        <?php $valor = encriptar("1"); ?>
        <h1>encriptar:<?php ECHO $valor; ?></h1>
        <h1>desencriptar:<?php ECHO desencriptar($valor); ?></h1>
        <?php } else if (rolUserio() == "ROLE_ADMIN"){ ?>
        <h1>Su rol es: ROLE_ADMIN</h1>
        <?php } else { ?>
        <div class="w3-panel w3-red">
          <p><b>Error!</b> su rol no esta asignado.</p>
        </div>
        <?php } ?>
      
      <?php } ?>
      
    </div>
    <?php include_once 'includes/footer.php' ?>
    
    <script src="src/js/index.js"></script>
    <?php $conn = null; ?>
  </body>
</html>