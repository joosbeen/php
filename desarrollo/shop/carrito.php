<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<?php include 'public/includes/head.php'; ?>

	</head>
	<body class="w3-light-grey" style="margin-top: 55px;">
		
		<?php include 'public/includes/header.php'; ?>
		
		<br>
		<div class="w3-main">
			<div class="w3-container">
				<h2>Carrito</h2>
				<div class="w3-responsive w3-card-4">
					<table class="w3-table-all">
						<thead>
							<tr class="w3-dark-grey">
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio</th>
								<th>Subtotal</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="carrito_productos">
							
						</tbody>
					</table>
				</div>
				<br>
				<button class="w3-button w3-teal w3-right" style="width: 200px;" id="btnPagar">
				<i class="fa fa-money" aria-hidden="true"></i> Pagar
				</button>
				<button class="w3-btn w3-white w3-border w3-border-red w3-round-large w3-right" onclick="viewMdlLogin()" id="btnLogin">Login</button>
				<button class="w3-btn w3-white w3-border w3-border-red w3-round-large w3-right" onclick="viewMdlRegistrar()" id="btnRegistrar">Registrar</button>
			</div>
		</div>
		<?php include 'public/includes/modales-sesion.php'; ?>
		<script src="public/js/shop.js"></script>
		<script src="public/js/cuenta.js"></script>
		<script src="public/js/carrito.js"></script>
	</body>
</html>