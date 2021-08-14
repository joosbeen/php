<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<?php include 'public/includes/head.php'; ?>
	</head>
	<body class="w3-light-grey" style="margin-top: 60px;">
		<div class="w3-container" id="formulario">
			<div class="w3-row">
				<div class="w3-col l4 m3 s12"><p></p></div>
				<div class="w3-col l4 m6 s12 w3-card-4 w3-padding">
					
					<h4 class="w3-center">Ingrese su correo con el que se registro para recuperar su contraseña.</h4>
					
					<form class="w3-container">
						<h5 class="w3-center"><b>Correo</b></h5>
						<span class="w3-text-red w3-center" id="txterror"></span>
						<input class="w3-input" type="email" name="correo" id="correo" placeholder="Ingrese correo..." required>
						<span class="w3-text-red" id="txtinfo"></span>
						<br>
						<button class="w3-btn w3-blue w3-block">Recuperar</button>
					</form>
				</div>
				<div class="w3-col l4 m3 s12"><p></p></div>
			</div>
		</div>
		<div class="w3-container w3-center" id="mensaje">
			<div class="w3-row">
				<div class="w3-col l4 m3 s12"><p></p></div>
				<div class="w3-col l4 m3 s12">
					<div class="w3-panel w3-card-4">
						<p class="w3-center">Revisa su correo, se le envio un mensaje parar cambiar su contraseña.</p>
					</div>
				</div>
				<div class="w3-col l4 m3 s12"><p></p></div>
			</div>
		</div>
		
		<?php include 'public/includes/header.php'; ?>
		<script src="public/js/shop.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#mensaje").hide();
				$("form").submit(function(event){
				event.preventDefault();
				var email = $("input[name='correo']").val();
				if( !(/\w{1,}[@][\w\-]{1,}([.]([\w\-]{1,})){1,3}$/.test(email)) ) {
					$("#txtinfo").html("<b>*</b> El correo es invalido.");
					} else {
						$("#carrito_productos").text("");
						$("#txterror").text("");
						$.ajax({
				url: "public/ajax/recuperarcuenta.php",
				type: "POST",
				dataType: "json",
				cache: false,
				success: function(data) {
					if (data.message) {
						$("#formulario").hide();
									$("#mensaje").show();
					} else {
											$("#txterror").text(data.message);
					}
				
				},
				error: function(xhr) {
				$("#txterror").text(xhr.responseJSON.message);
				}
				});
					}
				});
			});
		</script>
	</body>
</html>