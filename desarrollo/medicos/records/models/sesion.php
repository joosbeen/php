<?php

session_start();

function createSesion($datos) {
    $_SESSION['user_id'] = $datos["id"];
    $_SESSION['user_usuario'] = $datos["usuario"];
    $_SESSION['sesionEsActiva'] = true;
}

function sesionIsActiva() {
    return (isset($_SESSION["sesionEsActiva"]) && $_SESSION["sesionEsActiva"]);
}

function validarSesion() {
    if (!sesionIsActiva()) {
        header("Location:../");
    }
}

function deleteSesion() {
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
}

?>