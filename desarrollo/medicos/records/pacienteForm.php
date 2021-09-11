<?php
require_once './models/sesion.php';
validarSesion();
require_once './pacienteFormBack.php';
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
            <h2> Detalle Pasiente/<?php echo ($action == "insert" ? "Registar" : "Editar"); ?> </h2>
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
            <p><span class="text-danger">*</span> Es obligatorio.</p>
            <form method="post">
                <input type="hidden" name="id" value="<?php ECHO $id; ?>">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="nombre">Nombre completo: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Ingrese nombre completo" name="nombre" id="nombre" value="<?php echo($nombre); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="nombre">Identificación: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Ingrese identificación" name="identificacion" id="identificacion" value="<?php echo($identificacion); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <label for="sexo">Sexo: <span class="text-danger">*</span></label>
                        <select class="form-control" id="sexo" name="sexo">
                            <option value="femenino" <?php echo ($sexo=="Femenino") ? "selected" : ""; ?>>Femenino</option>
                            <option value="masculino" <?php echo ($sexo=="Masculino") ? "selected" : ""; ?>>Masculino</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="edad">Edad: <span class="text-danger">*</span></label>
                            <input type="number" min="0" class="form-control" placeholder="Ingrese edad" name="edad" id="edad" value="<?php echo($edad); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="telefono">Teléfono: <span class="text-danger">*</span></label>
                            <input type="number" min="0" class="form-control" placeholder="Ingrese telefono" name="telefono" id="telefono" value="<?php echo($telefono); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha Nacimeinto: <span class="text-danger">*</span></label>
                            <input type="date" min="0" class="form-control" placeholder="Ingrese fecha nacimeinto" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo($fecha_nacimiento); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="domicilio">Domicilio: <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="2" name="domicilio" id="domicilio"><?php echo $domicilio; ?></textarea>
                        </div>
                    </div>
                </div>
                <br>
                <?php if($action=="update"){ ?>
                <a href="pacienteForm.php" role="button" class="btn btn-danger btn-lg">Cancelar</a>
                <?php } ?>
                <button type="submit" class="btn btn-primary float-right btn-lg" name="action" value="<?php echo($action); ?>">Guardar</button>
                <br>
                <br>
            </form>
            <br>
        </div>
        <!-- body page end -->
    </body>
</html>