<?php
include_once 'php/session.php';
if (!validSesion()) {
header("Location:../index.php");
}
include_once 'php/connection.php';
$idUnidad = isset($_GET["vehiculo"]) ? $_GET["vehiculo"] : "";
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../src/w3css/w3.css">
        <script src="src/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="src/css/main.css">
        <link rel="stylesheet" href="src/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body class="w3-pale-green">
        <?php include_once './html/navbar.php'; ?>
        <div class="w3-container" style="margin-top: 40px;">
            <div class="w3-row">
                <div class="w3-col l4 m5 s12 w3-card-4 w3-padding-top-24">
                    <form class="w3-container">
                        <input id="myInput" type="text" class="w3-input" placeholder="Search..">
                        <select class="w3-select" name="destino" id="destino">
                            <?php
                            $sql = "SELECT * FROM destinos WHERE id_origen=1 ORDER BY origen_destino;";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row["id"] . '">' . $row["origen_destino"] . ' | $' . $row["precio"] . '</option>';
                            }
                            } else {
                            echo '<option value="">Sin registrar destinos.</option>';
                            }
                            ?>
                        </select>
                        <br>
                        <br>
                        <!--button class="w3-btn w3-teal w3-block">Register</button-->
                    </form>
                    <hr>
                    <div class="w3-container">
                        <h4>Asientos seleccionados: <strong class="w3-text-purple" id="total"></strong></h4>
                        <div id="reservados">
                        </div>
                        <br>
                        <div id="btnsreservaciones">
                            <button class="w3-button w3-block w3-teal btn-block" onclick="btnReservar()">Reservar</button>
                            <br>
                            <button class="w3-button w3-block w3-red btn-block" onclick="btnEliminarTodos()">Eliminar Todos</button>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="w3-col l8 m7 s12 w3-card-4 w3-padding-top-24">
                    <form class="w3-container" id="formVehiculo">
                        <div class="w3-row">
                            <div class="w3-col s12 m3 l4">
                                <select class="w3-select" name="vehiculo" id="vehiculo" onchange="selectVehiculo()">
                                    <?php
                                    $sql = "SELECT * FROM vehiculos ORDER BY vehiculo;";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                    echo '<option value="" disabled selected>Seleccione el tipo de vehiculo:</option>';
                                    while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row["id"] . '" ' . (($idUnidad == $row["id"]) ? "selected" : "") . '>' . $row["vehiculo"] . '</option>';
                                    }
                                    } else {
                                    echo '<option value="">Sin registrar unidad.</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                            if (isset($_GET['vehiculo'])) {
                            echo '<div class="w3-col s12 m3 l4 w3-margin-left">';
                                echo '<select class="w3-select" name="unidad" id="unidad">';
                                    $id_vehiculo = str_replace(" ", "", $_GET['vehiculo']);
                                    $sql = "SELECT * FROM unidades WHERE id_vehiculo=" . $id_vehiculo;
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                    echo '<option value="" disabled selected>La Unidad:</option>';
                                    while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row["id"] . '" selected>' . $row["unidad"] . ' | ' . $row["chofer"] . '</option>';
                                    }
                                    }
                                echo '</select>';
                            echo '</div>';
                            }
                            ?>
                        </div>
                    </form>
                    <div class="w3-container">
                        <?php
                        if (isset($_GET["vehiculo"]) && $_GET["vehiculo"] == "1") {
                        include_once './vehiculos/nissan.php';
                        } else if (isset($_GET["vehiculo"]) && $_GET["vehiculo"] == "2") {
                        include_once './vehiculos/taxi.php';
                        } else {
                        echo '<div class="w3-panel w3-red">
                            <h3 class="w3-center">Seleccione el tipo de vehiculo</h3>
                        </div>';
                        }
                        ?>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <script src="src/js/index.js"></script>
        <?php $conn->close(); ?>
    </body>
</html>