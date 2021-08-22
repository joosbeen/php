<?php

function mnActive($option, $pagina) {
    return ($option == $pagina) ? "w3-white" : "";
}

function issetGET($pName) {
    return (isset($_GET[$pName]) ? $_GET[$pName] : "");
}
