		<div class="w3-top">
			<div class="w3-bar w3-black w3-xlarge" style="opacity: 0.8; text-shadow: 0px 0px 2px black; color: white;">
				<a href="index.php" class="w3-bar-item w3-button">Home</a>
				<a href="#" class="w3-bar-item w3-button w3-hide-small">Link 1</a>
				<a href="#" class="w3-bar-item w3-button w3-hide-small">Link 2</a>
				<a href="#" class="w3-bar-item w3-button w3-hide-small">Link 3</a>
				<a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="openOrCloseMenu()">&#9776;</a>
				<a href="carrito.php" class="w3-bar-item w3-button w3-hide-small w3-right">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					<span class="w3-badge" id="cartbar"></span>
				</a>
				<div class="w3-dropdown-hover w3-right w3-hide-small">
					<button class="w3-button"><i class="fa fa-sign-in" aria-hidden="true"></i></button>
					<div class="w3-dropdown-content w3-bar-block w3-card-4">
						<a href="#" class="w3-bar-item w3-button" onclick="viewMdlLogin()">Login</a>
						<a href="#" class="w3-bar-item w3-button" onclick="viewMdlRegistrar()">Registrarse</a>
					</div>
				</div>
			</div>
		</div>
		<div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="sidebarMenu">
			<button onclick="openOrCloseMenu()" class="w3-bar-item w3-large w3-right-align w3-text-red">&times;</button>
			<a href="#" class="w3-bar-item w3-button">Link 1</a>
			<a href="#" class="w3-bar-item w3-button">Link 2</a>
			<a href="#" class="w3-bar-item w3-button">Link 3</a>
			<a href="#" class="w3-bar-item w3-button w3-right" onclick="viewMdlLogin()">Login</a>
			<a href="#" class="w3-bar-item w3-button w3-right" onclick="viewMdlRegistrar()">Registrarse</a>
			<a href="carrito.php" class="w3-bar-item w3-button w3-right">
				<i class="fa fa-shopping-cart" aria-hidden="true"></i>
				<span class="w3-badge" id="cartsidebar"></span>
			</a>
		</div>