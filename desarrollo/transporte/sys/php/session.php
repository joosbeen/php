<?php
session_start();

/**
 * Crear la sesion del usuario logeado.
 * @param int $idUsuario int, clave del usuario
 * @param String $username String, alias del usuario
 */
function createSession($idUsuario, $username) {
    $_SESSION["ssn_create"] = true;
    $_SESSION["ssn_id_usuario"] = $idUsuario;
    $_SESSION["ssn_username"] = $username;
}

/**
 * valida si la sesion ya fue creada.
 * @return bool, true si existe la sesion, false caso contrario.
 */
function validSesion() {
    $sesion = (isset($_SESSION["ssn_create"]) && $_SESSION["ssn_create"] == true);
    return $sesion;
}
/**
 * Setear los datos de sesion,
 * <ul>
 * <li>ssn_create</li>
 * <li>ssn_id_usuario</li>
 * <li>ssn_username</li>
 * </ul>
 * @return array, con las variables seteadas en $_SESSION.
 */
function dataSession() {
    return $_SESSION;
}

/**
 * Destruir la sesion creada.
 */
function deleteSession() {
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
}
?>
