<?php

/**
 * Validar si el campo no es null, vacio, o solo contiene espacios.
 * @param  string $value texto a validar.
 * @return bool        true si es valido, false caso ocontrario.
 */
function obligatorioTexto($value = '') {
    return !($value == null || $value == "" || empty($value) || strlen(str_replace(" ", "", $value)) <= 0);
}

/**
 * Remover todos los espacios de un string.
 * @param  string $value texto a remover espacios.
 * @return string        Sin espacios.
 */
function removerEspacios($value = '') {
    return str_replace(" ", "", $value);
}

/**
 * Validar si una fecha enviada de un formulario es valida.
 * @param  Date $fecha fecha a validar.
 * @return bool        true si es valida, false si no es.
 */
function fechaValida($fecha) {
    $valores = explode('-', $fecha);
    return (count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0]));
}

function horaValida($hora) {

    try {
        $val = explode(':', $hora);

        $int_hora = (int) $val[0];
        $int_minuto = (int) $val[1];

        if (!($int_hora >= 0 && $int_hora <= 23)) {
            return FALSE;
        }
        if (!($int_minuto >= 0 && $int_hora <= 59)) {
            return FALSE;
        }
    } catch (Exception $exc) {
        //echo $exc->getTraceAsString();
        return FALSE;
    }
    return TRUE;
}

?>