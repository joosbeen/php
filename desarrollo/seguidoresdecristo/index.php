<?php
include 'cpanel/config/conn.php';
include_once 'includes/util.php';
$pagActiva="index";


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SegDeCris</title>
        <?php include_once 'includes/head.php'; ?>
    </head>
    <body class="w3-light-grey">
        <!-- Navbar -->
        <?php include_once 'includes/navbar.php'; ?>
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
                        <div class="w3-col l4 m4 12">
                            <select class="w3-select w3-border" name="categ" id="categ">

                                <?php 
                                $resultado = $conn->prepare("SELECT * FROM categorias;");
                                $resultado->execute();
                                //$resultado = $resultado->setFetchMode(PDO::FETCH_ASSOC);
                                if (count($resultado) > 0) {
                                    echo '<option value="" disabled selected>Categoria</option>';
                                    while ($fila = $resultado->fetch()) {
                                        echo '<option value="' . $fila["id"] . '" '. ((issetGET("categ")==$fila["id"]) ? "selected" : "").'>' . $fila["categoria"] . '</option>';
                                    }
                                } else {
                                    echo '<option value="" disabled selected>Sin categoria.</option>';
                                }
                                
                                 ?>
                            </select>
                        </div>
                        <div class="w3-col l5 m5 12">
                            <input class="w3-input w3-border" name="q" id="q" type="text" value="<?php echo issetGET("q"); ?>" placeholder="Buscar..." autocomplete="off">
                        </div>
                        <div class="w3-col l3 m3 12">
                            <button class="w3-btn w3-blue w3-block">Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="w3-col l3 m3 s12"><p></p></div>
            </div>
        </form>
        <div class="w3-container w3-padding w3-margin w3-card-2 w3-round">
            <div class="w3-row w3-grayscale">
                <?php
                if ($connMsgError != "") {
                echo '<div class="w3-panel w3-blue w3-card-4"><p>' . $connMsgError . (isset($_GET['debug']) ? "<br>" . $connMsgBug : "") . '</p></div>';
                } else {
                $q = "";
                $c = "";
                $where_q = "";
                if (isset($_GET['q'])) {
                $q = "&q=" . $_GET['q'];
                $where_q = " AND (d.nombre LIKE '%" . $_GET['q'] . "%' OR d.genero LIKE '%" . $_GET['q'] . "%' OR d.descripcion LIKE '%" . $_GET['q'] . "%' OR d.artista LIKE '%" . $_GET['q'] . "%')";
                }
                if (isset($_GET['categ']) && $_GET['categ'] != "") {
                    $q = "&q=" . $_GET['q'] . "&categ=" . $_GET['categ']; 
                    $where_q .= " AND d.categoria_id=" . $_GET['categ'];                  
                }
                $limit = 10;
                $page = (!isset($_GET['page'])) ? 0 : $_GET['page'];
                $page = $page * $limit;
                $sql = "SELECT d.*, c.categoria FROM discos d, categorias c WHERE d.categoria_id = c.id AND d.status=true $where_q LIMIT $page, $limit";
                $sentencia = $conn->prepare($sql);
                $disco = "";
                if ($sentencia->execute()) {
                while ($fila = $sentencia->fetch()) {
                echo '<div class="w3-col l3 m4 s12 w3-padding w3-margin-bottom">
                                    <div class="w3-card w3-round-large">
                        <img src="' . $fila["imagen"] . '" class="w3-round-large" style="width:100%; height:250px;">
                        <hr>
                        <div class="w3-row w3-padding">
                            <div class="w3-col l6 m6 s12">
                                <p><b>' . $fila["artista"] . '</b><br>' . $fila["nombre"] . '<br>' . $fila["categoria"] . '</p>
                            </div>
                            <div class="w3-col l6 m6 s12">
                                <a target="_blank" href="' . $fila["link"] . '" class="w3-button w3-indigo w3-right" onclick="descarga()">Descargar</a>
                                <br>
                                <button class="w3-button w3-red w3-right" onclick="linkenfermo();">Link Dañado</button>
                            </div>
                        </div>
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
                        <a href="index.php?page=<?php echo (($page == 0) ? 0 : ($page / $limit) - 1) . $q; ?>" class="w3-button">&#10094; Previous</a>
                        <a href="index.php?page=<?php echo (($page == 0) ? 1 : ($page / $limit) + 1) . $q; ?>" class="w3-button w3-right">Next &#10095;</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div id="mdlLogin" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-round-large" style="max-width:600px">
            <div class="w3-center"><br>
                <span onclick="document.getElementById('mdlLogin').style.display = 'none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
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
    <script type="text/javascript" src="public/js/cristo.js"></script>
</body>
</html>