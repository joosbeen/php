<?php
require_once './models/sesion.php';
validarSesion();
require_once './cita-back.php';
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
    </head>
    <body class="bg-light">
        <!-- Navbar -->
        <?php include 'src/includes/navbar.php'; ?>
        <!-- body page start -->
        <div class="container bg-light b-shadow"  style="margin-top:80px">
            <br>
            <h2><i>Detalle Medicamento/<span id="accionform"><?php echo (empty($id) ? "Registrar" : "Editar"); ?></span></i></h2>
            <br>
            <?php if ($msgSuccess != "") { ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Completo!</strong><br> <?php echo $msgSuccess; ?>
                </div>
            <?php } ?>
            <?php if ($msgError != "") { ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong><br> <?php echo $msgError; ?>
                </div>
            <?php } ?>
            <b><span class="text-danger">*</span> Es obligatorio.</b>
            <br>
            <form method="post">
                <input type="hidden" name="id" id="id" value="<?php ECHO $id; ?>">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="id_med_paciente"><b><span class="text-danger">*</span> Paciente:</b></label>
                            <select class="form-control selectpicker" data-live-search="true" name="id_med_paciente" id="id_med_paciente"  style="width: 100%;">
                                <?php
                                optionSelectPacientes();
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="dia"><b><span class="text-danger">*</span> Día:</b></label>
                            <input type="date" class="form-control" placeholder="Ingrese Fecha" name="dia" id="dia" value="<?php echo($dia); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="hora"><b><span class="text-danger">*</span> Hora:</b></label>
                            <input type="time" class="form-control" placeholder="Ingrese Fecha" name="hora" id="hora" value="<?php echo($hora); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="id_med_estado"><b><span class="text-danger">*</span> Estado:</b></label>
                            <select class="form-control selectpicker" data-live-search="true" name="id_med_estado" id="id_med_estado"  style="width: 100%;">
                                <?php
                                optionSelectEstados();
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <?php if (!empty($id)) { ?>
                    <button type="button" class="btn btn-danger btn-lg btnFormReset"><i class="fa fa-medkit" aria-hidden="true"></i> Nuevo</button>
                <?php } ?>
                <button type="submit" class="btn btn-primary float-right btn-lg" name="action" value=""><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                <br>
                <br>
            </form>
            <br>
        </div>
        <script src="src/select2/js/select2.full.min.js"></script>
        <script>
            $(function () {
                $('select').selectpicker();
            });
            $(document).ready(function () {
                $("body").on("click", ".btnFormReset", function (event) {
                    $("#id").val("");
                    $("#nombre_comercial").val("");
                    $("#nombre_generico").val("");
                    $("#concentracion").val("");
                    $("#lote").val("");
                    $("#fecha_caducidad").val("");
                    $("#precio").val("");
                    $("#accionform").text("Registrar");
                    $(this).hide();
                });
            });
        </script>
        <?php $conn = null; ?>
    </body>
</html>
