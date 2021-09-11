<?php
require_once './models/sesion.php';

validarSesion();

require_once './pacienteConsultaBack.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <!-- Files css, javascript, icon -->
        <?php include 'src/includes/head.php'; ?>
        <!-- Files specific page -->
        <link rel="stylesheet" type="text/css" href="src/bootstrap-select-1.13.14/css/bootstrap-select.css">
        <script src="src/bootstrap-select-1.13.14/js/bootstrap-select.js"></script>
        <style type="text/css">
            tr.border_bottom td {
              border-bottom: 1px solid black;
            }
        </style>
    </head>
    <body class="bg-light">
        <!-- Navbar -->
        <?php include 'src/includes/navbar.php'; ?>
        <!-- body page start -->
        <div class="container bg-light b-shadow"  style="margin-top:80px">
            <br>
            <h3><b>Historia Clínica</b></h3>
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="card  bg-info text-white">
                        <div class="card-header">
                            <b>Datos subjetivos proporcionados por el paciente:</b>
                            <form method="post">
                                <input type="hidden" name="p" value="<?php echo $id; ?>">
                                <div class="input-group mb-3 input-group-sm">
                                    <input type="text" class="form-control" name="informacion" id="informacion"  placeholder=" información propia del paciente" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-success" type="submit" name="dato" value="subjetivos">Agregar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <?php
                                    foreach ($_SESSION['datos_subjetivos'] as $info) {
                                    echo '<tr>';
                                        echo '<td>' . $info['sintoma'] . '</td>';
                                        echo '<td><button type="button" class="btn btn-danger btn-sm float-right btnEliminarSubjetivos" value="' . $info['clave'] . '">X</button></td>';
                                    echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <form id="formSubjetivosEliminar" method="post">
                                <input type="hidden" class="form-control" name="dato" value="subjetivos">
                                <input type="hidden" name="eliminar" id="subjetivosEliminar">
                            </form>
                            <form method="post">
                                <input type="hidden" name="eliminartodos">
                                <button  type="submit" name="dato" value="subjetivos" class="btn btn-dark btn-sm">Limpiar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="card bg-secondary text-white">
                        <div class="card-header">
                            <b>Datos de exploración:</b>
                            <form method="post">
                                <input type="hidden" name="p" value="<?php echo $id; ?>">
                                <div class="input-group mb-3 input-group-sm">
                                    <input type="text" class="form-control" name="informacion" id="informacion"  placeholder="Datos de la exploración" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-success" type="submit" name="dato" value="exploracion">Agregar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <?php
                                    foreach ($_SESSION['datos_exploracion'] as $info) {
                                    echo '<tr>';
                                        echo '<td>' . $info['sintoma'] . '</td>';
                                        echo '<td><button type="button" class="btn btn-danger btn-sm float-right btnEliminarSubjetivos" value="' . $info['clave'] . '">X</button></td>';
                                    echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-dark btn-sm">Limpiar</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="card bg-dark text-white">
                        <div class="card-header">
                            <b>Diagnóstico:</b>
                            <form method="post">
                                <input type="hidden" name="p" value="<?php echo $id; ?>">
                                <div class="input-group mb-3 input-group-sm">
                                    <input type="text" class="form-control" name="informacion" id="informacion"  placeholder="Diagnostico del Médico" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-success" type="submit" name="dato" value="diagnostico">Agregar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <?php
                                    foreach ($_SESSION['datos_diagnostico'] as $info) {
                                    echo '<tr>';
                                        echo '<td class=" text-white">' . $info['sintoma'] . '</td>';
                                        echo '<td><button type="button" class="btn btn-danger btn-sm float-right btnEliminarSubjetivos" value="' . $info['clave'] . '">X</button></td>';
                                    echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-light btn-sm">Limpiar</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="card bg-light text-dark">
                        <div class="card-header">
                            <b>Pronóstico:</b>
                            <form method="post">
                                <input type="hidden" name="p" value="<?php echo $id; ?>">
                                <div class="input-group mb-3 input-group-sm">
                                    <input type="text" class="form-control" name="informacion" id="informacion"  placeholder="Diagnostico del Médico" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-success" type="submit" name="dato" value="pronostico">Agregar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <?php
                                    foreach ($_SESSION['datos_pronostico'] as $info) {
                                    echo '<tr>';
                                        echo '<td>' . $info['sintoma'] . '</td>';
                                        echo '<td><button type="button" class="btn btn-danger btn-sm float-right btnEliminarSubjetivos" value="' . $info['clave'] . '">X</button></td>';
                                    echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-dark btn-sm">Limpiar</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="card bg-success text-white">
                        <div class="card-header">
                            <b>Tratamiento:</b>
                            <form method="post">
                                <input type="hidden" name="p" value="<?php echo $id; ?>">
                                <div class="form-group">
                                    <label for="medicamento">Médicamento:</label>
                                    <select class="form-control selectpicker form-control-sm" data-live-search="true" name="medicamento" id="medicamento"  style="width: 100%;">
                                        <?php 
                                        optionSelect();
                                         ?>
                                        <!--option data-tokens="Naranja agrega" value="1" selected="selected">Naranja agrega</option>
                                        <option data-tokens="Naranja Dulce" value="2">Naranja Dulce</option>
                                        <option data-tokens="Limon" value="3">Limon</option>
                                        <option data-tokens="Fresa" value="4">Fresa</option-->
                                    </select>
                                </div>
                                <div class="form-group input-group-sm">
                                    <label for="pwd">Intrucciones/Recomenaciones:</label>
                                    <input type="text" class="form-control" placeholder="Ingrese las Intrucciones/Recomenaciones" name="informacion" id="informacion">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm btn-block" name="dato" value="tratamiento">Submit</button>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <?php
                                    foreach ($_SESSION['datos_tratamiento'] as $info) {
                                    echo '<tr>';
                                        echo '<td>' . $info['medicamento'] . '</td>';
                                        echo '<td rowspan="2"><button type="button" class="btn btn-danger btn-sm float-right btnEliminarSubjetivos" value="' . $info['clave'] . '">X</button></td>';
                                    echo '</tr>';
                                    echo '<tr class="border_bottom">';
                                        echo '<td>' . $info['uso'] . '</td>';
                                    echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-dark btn-sm">Limpiar</button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <button type="button" class="btn btn-danger btn-sm">Limpiar Todo</button>
            <br>
            <br>
        </div>
        <!-- body page end -->
        <script src="src/select2/js/select2.full.min.js"></script>
        <script>
            $(function () {
                $('select').selectpicker();
            });
        $(document).ready(function() {
            
            $("body").on("click", ".btnEliminarSubjetivos", function(event) {
                var id = $(this).val();
                $("#subjetivosEliminar").val(id);
                $("#formSubjetivosEliminar").submit();
            });
        });
        </script>
    </body>
</html>