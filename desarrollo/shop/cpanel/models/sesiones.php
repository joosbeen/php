<?php 
session_start();


function sesionActiva(){

	return (isset($_SESSION['shop_sesion_activa']) && $_SESSION['shop_sesion_activa']===true);
}


 ?>