<?php
require_once './models/sesion.php';
validarSesion();
require_once './medicamento-back.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <!-- Files css, javascript, icon -->
        <?php include 'src/includes/head.php'; ?>
        <!-- Files specific page -->
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
                            <label for="nombre_comercial"><b>Nombre Comercial: <span class="text-danger">*</span></b></label>
                            <input type="text" class="form-control" placeholder="Ingrese Nombre Comercial" name="nombre_comercial" id="nombre_comercial" value="<?php echo($nombre_comercial); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="nombre_generico"><b>Nombre Genérico: <span class="text-danger">*</span></b></label>
                            <input type="text" class="form-control" placeholder="Ingrese Nombre Genérico" name="nombre_generico" id="nombre_generico" value="<?php echo($nombre_generico); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="concentracion"><b>Concentración: <span class="text-danger">*</span></b></label>
                            <input type="text" class="form-control" placeholder="Ingrese Concentración" name="concentracion" id="concentracion" value="<?php echo($concentracion); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="lote"><b>Lote: <span class="text-danger">*</span></b></label>
                            <input type="text" class="form-control" placeholder="Ingrese Lote" name="lote" id="lote" value="<?php echo($lote); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="fecha_caducidad"><b>Fecha Caducidad: <span class="text-danger">*</span></b></label>
                            <input type="date" class="form-control" placeholder="Ingrese Fecha Caducidad" name="fecha_caducidad" id="fecha_caducidad" value="<?php echo($fecha_caducidad); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="precio"><b>Precio: <span class="text-danger">*</span></b></label>
                            <input type="number" min="0" step="0.1" class="form-control" placeholder="Ingrese Precio" name="precio" id="precio" value="<?php echo($precio); ?>">
                        </div>
                    </div>
                </div>
                <br>
                <?php if(!empty($id)){ ?>
                <button type="button" class="btn btn-danger btn-lg btnFormReset"><i class="fa fa-medkit" aria-hidden="true"></i> Nuevo</button>
                <?php } ?>
                <button type="submit" class="btn btn-primary float-right btn-lg" name="action"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                <br>
                <br>
            </form>
            <br>
        </div>
            <script>
            $(document).ready(function() {
                $("body").on("click", ".btnFormReset", function(event) {
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