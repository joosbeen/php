<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<?php include 'public/includes/head.php'; ?>
	</head>
	<body class="w3-light-grey" style="margin-top: 60px;">
		<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
			<form class="w3-container" action="https://www.w3schools.com/action_page.php">
				<div class="w3-section">
					<label><b>Contraseña</b></label>
					<input class="w3-input w3-border w3-margin-bottom" type="text" name="pass" id="pass" placeholder="Usuarios/Correo" required>
					<label><b>Confirmar Contraseña</b></label>
					<input class="w3-input w3-border" type="text" name="passw" id="passw" placeholder="Contraseña" required>
					<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
				</div>
			</form>
		</div>
	</body>
</html>