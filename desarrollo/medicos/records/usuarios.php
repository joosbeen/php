<?php
require_once './models/sesion.php';

validarSesion();

require_once 'models/ConexionPDO.php';
require_once 'models/UsuarioMdl.php';
$usuarioMdl = new UsuarioMdl();
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
            <div class="clearfix">
                <span class="float-left">
                    <h2>Usuarios</h2>
                </span>
                <span class="float-right">
                    <a href="usuarioForm.php" class="btn btn-info rounded-circle"><i class="fas fa-user-plus"></i></a>
                </span>
            </div>
            <p><input class="form-control" id="myInput" type="text" placeholder="Search.."></p>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <!--th>Contraseña</th-->
                            <th>Estado</th>
                            <th>Rol</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php
                        $usuarioMdl->filasTablaUsuarios();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- body page end -->
        <!-- The Modal -->
        <form id="formLoadEdit" action="usuarioForm.php" method="POST">
            <input type="hidden" name="action" id="action" value="load">
            <input type="hidden" name="id" id="idEdit" >
        </form>
        <script src="srcjs/table.js"></script>
        <script>
            $(document).ready(function () {                
                $("body").on("click", ".btnEditar", function (event) {
                   var id = $(this).val();
                   $("#idEdit").val(id);
                   $("#formLoadEdit").submit();
               });
            });
        </script>
        <!-- Footer -->
        <!--div class="container-fluid bg-dark text-white">
        <h5 class="text-center">JOSE BENITO GARCIA SOLANO</h5>
        <h6 class="text-center">Redes Sociales</h6>
    </div-->
        <!-- Files Javascript specific the page -->
    </body>
</html>