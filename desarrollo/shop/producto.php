<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Mi Company</title>
		<?php include 'public/includes/head.php'; ?>
	</head>
	<body class="w3-light-grey" style="margin-top: 55px;">
		
		<?php include 'public/includes/header.php'; ?>

		<div class="w3-main padding">
			<div class="w3-row w3-grayscale padding w3-card">
				<div class="w3-col l8 m12 s12">
					<div class="w3-row">
						<div class="w3-col l12 m12 s12">
							<img src="producto.jpg" class="w3-round w3-image" alt="Norway">
						</div>
						<div class="w3-col l12 m12 s12" style="padding-top: 5px;">
							<img src="producto.jpg" class="w3-round img-mini" alt="Norway">
							<img src="producto2.png" class="w3-round img-mini" alt="Norway">
							<img src="producto3.jpg" class="w3-round img-mini" alt="Norway">
							<img src="producto4.jpg" class="w3-round img-mini" alt="Norway">
						</div>
					</div>
					<hr class="hr">
				</div>
				<div class="w3-col l4 m12 s12 padding" style="height: 100%;">
					<p class="w3-xlarge p0-m0"><b>Nombre del producto de venta</b></p>
					<br>
					<p class="w3-large p0-m0"><b>$ 200.00 MXN</b></p>
					<br>
					<form id="formCar" onsubmit="return false;">
						<b class="w3-text-red" id="msgError"></b>
						<br>
						<div class="w3-row">
							<div class="w3-col l6 m12 s12">
								<label><b>Talla:</b></label>
								<select class="w3-select w3-border" name="talla" id="talla" required>
									<option value="" disabled selected>Choose your option</option>
									<option value="1">Option 1</option>
									<option value="2">Option 2</option>
									<option value="3">Option 3</option>
								</select>
							</div>
							<div class="w3-col l6 m12 s12">
								<label><b>Cantidad:</b></label>
								<input class="w3-input w3-border" type="number" min="1" value="1" placeholder="Cantidad" name="cantidad" id="cantidad" required>
							</div>
						</div>
						<br>
						<button class="w3-button w3-teal w3-block" id="btnProductoAgregar">Agregar al carrito</button>
					</form>
				</div>
			</div>
		</div>
		<script src="src/js/shop.js"></script>
		<script src="public/js/cuenta.js"></script>
		<script src="src/js/producto.js"></script>
	</body>
</html>