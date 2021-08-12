<?php
include 'cpanel/config/conn.php'
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SegDeCris</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="src/w3css/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
		<style>
		body,h1,h2,h3,h4,h5 {
			font-family: "Raleway", sans-serif
		}
		.m-rl-0{
			margin-right: 0px;
			margin-left: 0px;
		}
		.w3-bar,h1,button {
			font-family: "Montserrat", sans-serif;
		}
		.fa-anchor,.fa-coffee {
			font-size:200px;
		}
		</style>
	</head>
	<body class="w3-light-grey">
		<!-- Navbar -->
		<div class="w3-top">
			<div class="w3-bar w3-dark-grey w3-card w3-left-align w3-large">
				<a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-white" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
				<a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
				<a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 1</a>
				<a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 2</a>
				<a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Link 3</a>
				<a href="javascript:void" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white w3-right" onclick="document.getElementById('mdlLogin').style.display='block'">Login</a>
			</div>
			<!-- Navbar on small screens -->
			<div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
				<a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
				<a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
				<a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
				<a href="#" class="w3-bar-item w3-button w3-padding-large">Link 4</a>
			</div>
		</div>
		<br>
		<br>
		<div class="w3-content" style="max-width:1400px">
			<!-- Header -->
			<header class="w3-container w3-center w3-padding-32">
				<div class="w3-row">
					<div class="w3-col l12 w3-hide-medium w3-hide-small">						
						<h1><b>SEGUIDORES DE CRISTO</b></h1>
					</div>
					<div class="w3-col w3-hide-large m12 w3-hide-small">						
						<h3><b>SEGUIDORES DE CRISTO</b></h3>
					</div>
					<div class="w3-col w3-hide-large w3-hide-medium s12">						
						<h5><b>SEGUIDORES DE CRISTO</b></h5>
					</div>
				</div>
				<p>Welcome to the blog of <span class="w3-tag">unknown</span></p>
			</header>
		</div>
		<form class="w3-container w3-margin-bottom w3-margin-top" autocomplete="off" onsubmit="return formSearch()">
			<div class="w3-row">
				<div class="w3-col l3 m3 s12"><p></p></div>
				<div class="w3-col l6 m6 s12">
					<div class="w3-row">
						<div class="w3-col l8 m8 12">
							<input class="w3-input w3-border" name="q" id="q" type="text" placeholder="Buscar..." autocomplete="off" autocomplete="false">
						</div>
						<div class="w3-col l4 m4 12">
							<button class="w3-btn w3-blue w3-block">Buscar</button>
						</div>
					</div>
				</div>
				<div class="w3-col l3 m3 s12"><p></p></div>
			</div>
		</form>
		<div class="w3-container">
			<div class="w3-row w3-grayscale">
				<?php
				if ($connMsgError != "") {
					echo '<div class="w3-panel w3-blue w3-card-4"><p>'.$connMsgError. (isset($_GET['debug']) ? "<br>".$connMsgBug : "") . '</p></div>';
				} else {
					$q = "";
					$where_q = "";
					if (isset($_GET['q'])) {
						$q = "&q=".$_GET['q'];
						$where_q = " AND (d.nombre LIKE '%".$_GET['q']."%' OR d.genero LIKE '%".$_GET['q']."%' OR d.descripcion LIKE '%".$_GET['q']."%' OR u.nombre LIKE '%".$_GET['q']."%')";
					}

					$limit = 10;

					$page = (!isset($_GET['page'])) ? 0 : $_GET['page'];
					$page = $page * $limit;

					$sql = "SELECT d.*, u.nombre AS artista FROM discos d, usuarios u WHERE d.id_usuario = u.id AND d.status=true $where_q LIMIT $page, $limit";
				
					$sentencia = $conn->prepare($sql);
					if ($sentencia->execute()) {
						while ($fila = $sentencia->fetch()) {
							echo '
							<div class="w3-col l3 m4 s12 w3-padding w3-margin-bottom">
								<div class="w3-card w3-round-large">
									<img src="'.$fila["imagen"].'" class="w3-round-large" style="width:100%; height:250px;">
									<p class="w3-padding"><b>'.$fila["artista"].'</b><br>'.$fila["nombre"].'</p>
								</div>
							</div>';
						}
					}
					
				}
				?>
			</div>
			<div class="w3-row">
				<div class="w3-col l4 m4 s12"><p></p></div>
				<div class="w3-col l4 m4 s12">
					<div class="w3-bar w3-border w3-round">
						<a href="index.php?page=<?php echo (($page==0) ? 0 : ($page/$limit)-1) . $q; ?>" class="w3-button">&#10094; Previous</a>
						<a href="index.php?page=<?php echo (($page==0) ? 1 : ($page/$limit)+1) . $q; ?>" class="w3-button w3-right">Next &#10095;</a>
					</div>
				</div>
			</div>
		</div>
		<br>
	</div>
	<div id="mdlLogin" class="w3-modal">
		<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-round-large" style="max-width:600px">
			
			<div class="w3-center"><br>
				<span onclick="document.getElementById('mdlLogin').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
			</div>
			<form class="w3-container" action="/action_page.php">
				<div class="w3-section">
					<label><b>Usuario/Correo</b></label>
					<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="usrname" required>
					<label><b>Contraseña</b></label>
					<input class="w3-input w3-border" type="text" placeholder="Enter Password" name="psw" required>
					<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
				</div>
			</form>
		</div>
	</div>
	<!-- Footer -->
	<footer class="w3-container w3-dark-grey w3-padding-32 w3-margin-top w3-center">
		<p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
	</footer>
	<script type="text/javascript">
		function formSearch() {
			var valor = document.getElementById("q");
			if( valor.value == null || valor.value.length == 0 || /^\s+$/.test(valor.value) ) {
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
	</script>
</body>
</html>