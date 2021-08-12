<?php
include './sys/php/session.php';
createSession(1, "benito");
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="src/w3css/w3.css">
    </head>
    <body class=" w3-dark-grey">
        <div class="w3-panel w3-red" style=" margin-top: 0px;">
            <p class="w3-center">Bienvenido a <b>Sistema XXXXXX</b></p>
        </div> 
        <div class="w3-row-padding w3-margin-top">
            <div class="w3-col l4 m4 s1"><p></p></div>
            <div class="w3-col l4 m4 s10 w3-card-4 w3-round-xlarge w3-cell-middle w3-light-grey">
                <div class="w3-center">
                    <img src="src/img/img_avatar.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
                </div>
                <form class="w3-container">
                    <div class="w3-section">
                        <label><b>Username</b></label>
                        <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="usrname" required>
                        <label><b>Password</b></label>
                        <input class="w3-input w3-border" type="text" placeholder="Enter Password" name="psw" required>
                        <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me
                        <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
                    </div>
                </form>
            </div>
            <div class="w3-col l4 m4 s1"></div>
        </div>
    </body>
</html>
