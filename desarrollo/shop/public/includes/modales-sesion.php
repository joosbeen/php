<div id="mdlLogin" class="w3-modal">
	<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
		
		<div class="w3-center"><br>
			<span onclick="viewMdlLogin().style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
			<img src="img_avatar4.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
		</div>
		<form class="w3-container" action="https://www.w3schools.com/action_page.php">
			<div class="w3-section">
				<label><b>Usuarios/Correo</b></label>
				<input class="w3-input w3-border w3-margin-bottom" type="text" name="usuario" id="usuario" placeholder="Usuarios/Correo" required>
				<label><b>Contraseña</b></label>
				<input class="w3-input w3-border" type="text" name="pass" id="pass" placeholder="Contraseña" required>
				<input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Guardar sesión
				<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
				<span class="w3-right w3-padding w3-hide-small">Recuperar <a href="recuperarcontrasena.php">contraseña?</a></span>
			</div>
		</form>
	</div>
</div>
<div id="mdlRegistrar" class="w3-modal">
	<div class="w3-modal-content w3-card-4">
		<header class="w3-container w3-teal">
			<span onclick="viewMdlRegistrar()"
			class="w3-button w3-display-topright">&times;</span>
			<h2>Modal Registrar</h2>
		</header>
		<div class="w3-container">
			<p>Some text..</p>
			<p>Some text..</p>
		</div>
		<footer class="w3-container w3-teal">
			<p>Modal Footer</p>
		</footer>
	</div>
</div>