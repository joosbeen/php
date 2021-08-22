<?php
include_once './includes/util.php';
$pagActiva = "contacto";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SegDeCris</title>
        <?php include_once './includes/head.php'; ?>
    </head>
    <body class="w3-light-grey">
        <!-- Navbar -->
        <?php include_once './includes/navbar.php'; ?>
        <br>
        <br>
        <br>
        <div class="w3-row">
            <div class="w3-col l4 m3 s12"><p></p></div>
            <div class="w3-col l4 m6 s12">
                <div class="w3-card-2 w3-padding-large w3-padding-32 w3-margin-top">
                    <h3 class="w3-center">Contacto</h3>
                    <hr>
                    <form action="https://www.w3schools.com/action_page.php" target="_blank">
                        <div class="w3-section">
                            <label>Name</label>
                            <input class="w3-input w3-border" type="text" required name="Name">
                        </div>
                        <div class="w3-section">
                            <label>Email</label>
                            <input class="w3-input w3-border" type="text" required name="Email">
                        </div>
                        <div class="w3-section">
                            <label>Message</label>
                            <input class="w3-input w3-border" required name="Message">
                        </div>
                        <button type="submit" class="w3-button w3-block w3-blue-grey">Enviar</button>
                    </form>
                </div>
            </div>
            <div class="w3-col l4 m3 s12"><p></p></div>
        </div>
        
    </body>
</html>