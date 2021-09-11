<?php
require_once './models/sesion.php';
validarSesion();
//require_once './cita-back.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Sisoft | Medicamentos</title>
        <?php include 'src/includes/head.php'; ?>
    </head>
    <body class="bg-light">
        <?php include "src/includes/navbar.php" ?>
        <div class="container bg-light b-shadow"  style="margin-top:80px">
            <br>
            <div class="clearfix">
                <span class="float-left">
                    <h2>Pacientes</h2>
                </span>
                <span class="float-right">
                    <a href="cita.php" class="btn btn-info btn-sm"><i class="fa fa-medkit" aria-hidden="true"></i> Nuevo</i></a>
                </span>
            </div>

            <p><input class="form-control" id="myInput" type="text" placeholder="Search.."></p>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>Paciente</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM medico_medicamentos");
                        $stmt->execute();
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $pacientes = $stmt->fetchAll();
                        if (count($pacientes) > 0) {
                            foreach ($pacientes as $pac) {
                                echo '<tr><td>' . $pac['nombre_comercial'] . '</td>';
                                echo '<td>' . $pac['nombre_generico'] . '</td>';
                                echo '<td>' . $pac['concentracion'] . '</td>';
                                echo '<td class="text-center">
                                <button type="button" class="btn btn-secondary btn-sm btnEdit" value="' . $pac['id'] . '">
                                Acción</button>';
                                echo '</td></tr>';
                            }
                        } else {
                            echo '<tr><td colspan="7" class="text-center"><b>No se registrado medicamentos.</b></td></tr>';
                        }
                        ?>

                    </tbody>
                </table>
                <br>
                <br>
            </div>
        </div>
        <form id="formEditData" action="medicamento.php" method="POST">
            <input type="hidden" name="action" id="action" value="load">
            <input type="hidden" name="id" id="idEdit" >
        </form>
        <script src="src/js/table.js"></script>
        <script>
            $(document).ready(function () {
                $("body").on("click", ".btnEdit", function (event) {
                    var id = $(this).val();
                    $("#idEdit").val(id);
                    $("#formEditData").submit();
                });
            });
        </script>
        <?php $conn = null; ?>
    </body>
</html>
