<?php
include_once 'php/session.php';
if (!validSesion()) {
    echo "Redirect:../index.php";
    header("Location:../index.php");
}

include_once 'php/session.php';
include_once 'php/connection.php';

$idUnidad = isset($_GET["unidad"]) ? $_GET["unidad"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "";
$idUsuario = dataSession()["ssn_id_usuario"];

$msgError = "";
$msgSuccess = "";
try {

    if ($action === "delete") {

        $idAsiento = (int) $_GET["asiento"];

        $sql = "DELETE FROM hacientos WHERE id=$idAsiento;";

        if ($conn->query($sql) === TRUE) {
            $msgSuccess = "Asineto removido.";
        } else {
            $msgError = "Error al remover el asiento: " . $conn->error;
        }
    }
    if ($action === "cierre") {

        $idUnidad = (int) $idUnidad;

        $sql = "UPDATE hacientos SET cierre=true WHERE id_unidad=$idUnidad AND id_usuario=$idUsuario AND salida=true;";
        if ($conn->query($sql) === TRUE) {
            $msgSuccess = "Se marco la salida de la unidad.";
        } else {
            $msgError = "Error al marcar la salida: " . $conn->error;
        }
    }
} catch (Exception $exc) {
    $msgError = $exc->getTraceAsString();
}
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
            <h4>Lista de Asientos reservador</h4>
            <?php if ($msgError != "") { ?>
                <div class="w3-panel w3-red w3-display-container">
                    <span onclick="this.parentElement.style.display = 'none'"
                          class="w3-button w3-large w3-display-topright">&times;</span>
                    <h5>Error!</h5>
                    <p><?php echo $msgError; ?></p>
                </div>
            <?php } ?>
            <?php if ($msgSuccess != "") { ?>
                <div class="w3-panel w3-green w3-display-container">
                    <span onclick="this.parentElement.style.display = 'none'"
                          class="w3-button w3-large w3-display-topright">&times;</span>
                    <h5>Exitoso!</h5>
                    <p><?php echo $msgSuccess; ?></p>
                </div>
            <?php } ?>
            <div class="w3-responsive w3-card-4">
                <table class="w3-table-all">
                    <thead>
                        <tr class="w3-black">
                            <th>Asiento</th>
                            <th>Unidad</th>
                            <th>Destino</th>
                            <th>Costo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT a.id, a.haciento, u.unidad, d.origen_destino, d.precio "
                                . "FROM hacientos a, destinos d, unidades u "
                                . "WHERE a.id_destino = d.id AND a.id_unidad=u.id AND a.id_unidad=$idUnidad AND a.id_usuario=$idUsuario AND salida=true AND cierre=false ORDER BY d.precio ASC;";
                        $result = $conn->query($sql);
                        $total = 0;
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $total = $total + $row["precio"];
                                echo '<tr class="w3-hover-blue">';
                                echo '<td>' . $row["haciento"] . '</td>';
                                echo '<td>' . $row["unidad"] . '</td>';
                                echo '<td>' . $row["origen_destino"] . '</td>';
                                echo '<td>' . $row["precio"] . '</td>';
                                echo '<td><button class="w3-button w3-indigo w3-round-large w3-tiny" onclick="eliminarReservacion(' . $row["id"] . ')"><i class="fa fa-trash"></i> Eliminar</button></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo "<tr colspan='5'><td></td></tr>";
                        }
                        ?>                                                
                    </tbody>
                    <tfoot>
                        <tr class="w3-black">
                            <td colspan="3" class="w3-right-align">Total</td>
                            <td>$ <?php echo $total; ?></td>
                            <td><button class="w3-button w3-red w3-round-large" onclick="cerrarSalida()" <?php  echo (($total==0) ? "disabled" : ""); ?>><i class="fa fa-save"></i>Cerrar</button></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <form id="formAsientos" method="get">
            <input type="hidden" name="unidad" value="<?php echo $idUnidad; ?>"/>
            <input type="hidden" name="action" value=""/>
            <input type="hidden" name="asiento" value=""/>
        </form>
    </body>
    <script>
        function eliminarReservacion(idAsiento) {
            $("input[name='asiento']").val(idAsiento);
            $("input[name='action']").val("delete");
            $("#formAsientos").submit();
        }

        function cerrarSalida() {
            $("input[name='action']").val("cierre");
            $("#formAsientos").submit();
        }
    </script>
    <?php $conn->close(); ?>
</html>