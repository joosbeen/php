<?php 

function sesionCreada()
{
	return true;
}

function rolUserio(){
	// ROLE_ARTISTA
	return "ROLE_ARTISTA";
}

function encriptar($valor)  {
	$clave  = '1Q2W3Eqwe4R5T6Yrty7U8I9Ouio0P';
	$method = 'aes-256-cbc';
	$iv = base64_decode("C9fBxl1EWtYTL1/M8jfstw==");
    return openssl_encrypt ($valor, $method, $clave, false, $iv);
};


function desencriptar($valor) {
	$clave  = '1Q2W3Eqwe4R5T6Yrty7U8I9Ouio0P';
	$method = 'aes-256-cbc';
	$iv = base64_decode("C9fBxl1EWtYTL1/M8jfstw==");
    $encrypted_data = base64_decode($valor);
    return openssl_decrypt($valor, $method, $clave, false, $iv);
}

 ?>