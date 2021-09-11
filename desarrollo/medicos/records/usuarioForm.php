<?php
require_once './models/sesion.php';

validarSesion();

require_once 'usuarioFormBack.php';
/*
  require_once './models/ConexionPDO.php';
  require_once './models/RolMdl.php';
  require_once './models/UsuarioMdl.php';

  $rol = new RolMdl();
  $usuariomdl = new UsuarioMdl();

  $usuario = $usuariomdl->cargarDatos();
 */
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
        <div class="container bg-light b-shadow p-4 rounded-lg"  style="margin-top:80px">
            <?php
            //$usuario = $usuariomdl->updateUsuario($usuario);
            //$usuario = $usuariomdl->insertUsuario($usuario);
            ?>
            <h2> Detalle Usuario/<?php echo ($action == "insert" ? "Registar" : "Editar"); ?> </h2>
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
            <form method="post">
                <input type="hidden" name="id" value="<?php ECHO $id; ?>">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="nombre">Nombre completo:</label>
                            <input type="text" class="form-control" placeholder="Ingrese nombre completo" name="nombre" id="nombre" value="<?php echo($nombre); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <input type="text" class="form-control" placeholder="Ingrese nombre de usuario" name="usuario" id="usuario" value="<?php echo($usuario); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">

                        <div class="form-group">
                            <label for="pwd">Contraseña:</label>
                            <input type="password" class="form-control" placeholder="Ingrese contraseña" name="contrasena" id="contrasenaconf" value="<?php echo $contrasena; ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">

                        <div class="form-group">
                            <label for="pwd">Confirmar Contraseña:</label>
                            <input type="password" class="form-control" placeholder="Confirme contraseña" name="contrasenaconf" id="contrasenaconf" value="<?php echo $contrasenaconf; ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="rol">Rol:</label>
                            <select class="form-control" id="id_rol" name="id_rol">
                                <?php
                                $stmt = $conn->prepare("SELECT * FROM medico_roles");
                                $stmt->execute();
                                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                $roles = $stmt->fetchAll();
                                foreach ($roles as $rol) {
                                    echo '<option value="'.$rol['id'].'">'.$rol['rol'].'</option> ';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group form-check">
                            <br>
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="estado" id="estado" <?php echo ($estado == "1" ? 'checked' : ''); ?>> Estado(activo/inactivo)
                            </label>
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary float-right btn-lg" name="action" value="<?php echo($action); ?>">Guardar</button>
                <br>
                <br>
            </form>
        </div>
        <!-- body page end -->
        <br>
        <!-- Footer -->
        <!--div class="container-fluid bg-dark text-white">
            <h5 class="text-center">JOSE BENITO GARCIA SOLANO</h5>
            <h6 class="text-center">Redes Sociales</h6>
        </div-->
        <!-- Files Javascript specific the page -->
    </body>
    <?php $conn = NULL; ?>
</html>