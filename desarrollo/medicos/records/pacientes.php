<?php
require_once './models/sesion.php';
validarSesion();
require_once 'usuarioFormBack.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Sisoft | Pacientes</title>
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
                    <a href="pacienteForm.php" class="btn btn-info btn-sm"><i class="fas fa-user-plus"> Agregar</i></a>
                </span>
            </div>
            
            <p><input class="form-control" id="myInput" type="text" placeholder="Search.."></p>
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Ident.</th>
                            <th>Sexo</th>
                            <th>Edad</th>
                            <th>Telefono</th>
                            <th>Cumpleaños</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM medico_pacientes");
                        $stmt->execute();
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $pacientes = $stmt->fetchAll();
                        if (count($pacientes) > 0) {
                            foreach($pacientes as $pac){
                                echo '<tr><td>'.$pac['nombre'].'</td>';
                                echo '<td>'.$pac['identificacion'].'</td>';
                                echo '<td>'.$pac['sexo'].'</td>';
                                echo '<td>'.$pac['edad'].'</td>';
                                echo '<td>'.$pac['telefono'].'</td>';
                                echo '<td>'.$pac['fecha_nacimiento'].'</td>';
                                echo '<td class="text-center">';
                                echo '<div class="dropdown">
                                    <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown">
                                    Acción
                                    </button>
                                    <div class="dropdown-menu">
                                        <button type="button" class="btn btn-link dropdown-item btnEditarDatos" value="'.$pac['id'].'"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button>
                                        <a href="pacienteConsulta.php?p='.$pac['id'].'" role="button" class="btn btn-link dropdown-item btnNuevo" value="'.$pac['id'].'"><i class="fa fa-plus" aria-hidden="true"></i> Consulta</a>
                                        <button type="button" class="btn btn-link dropdown-item btnHistorial" value="'.$pac['id'].'"><i class="fa fa-th-list" aria-hidden="true"></i> Historial</button>
                                    </div>
                                </div>';
                                echo '</td></tr>';
                                }
                        } else {
                            echo '<tr><td colspan="5" class="text-center"><b>No se registrado pacientes.</b></td></tr>';
                        }
                            
                            ?>
                            
                        </tbody>
                    </table>
                    <br>
                    <br>
                </div>
            </div>
            <form id="formEditData" action="pacienteForm.php" method="POST">
                <input type="hidden" name="action" id="action" value="load">
                <input type="hidden" name="id" id="idEdit" >
            </form>
            <form id="formHistoral" action="pacienteHistorial.php" method="POST">
                <input type="hidden" name="action" id="action" value="load">
                <input type="hidden" name="id" id="idHistorial" >
            </form>
            <form id="formConsulta" action="pacienteConsulta.php" method="POST">
                <input type="hidden" name="action" id="action" value="load">
                <input type="hidden" name="id" id="idUsuario" >
            </form>
            <script src="src/js/table.js"></script>
            <script>
            $(document).ready(function() {
                $("body").on("click", ".btnHistorial", function(event) {
                    var id = $(this).val();
                    $("#idHistorial").val(id);
                    $("#formHistoral").submit();
                });
                $("body").on("click", ".btnNuevo", function(event) {
                    var id = $(this).val();
                    $("#idUsuario").val(id);
                    $("#formConsulta").submit();
                });
            });
            </script>
            <?php $conn = null; ?>
        </body>
    </html>