function formSearch() {
    var valor = document.getElementById("q");
    if (valor.value == null || valor.value.length == 0 || /^\s+$/.test(valor.value)) {
        valor.style.backgroundColor = "rgba(255, 99, 71, 0.5)";
        console.log("return false");
        return false;
    }
    valor.style.backgroundColor = "";
    console.log("return true");
    return true;
}
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

/**
 * Contador de descargas.
 */
function descarga(){

}
/**
 * Reportar link dañano.
 */
function linkenfermo(){

}

