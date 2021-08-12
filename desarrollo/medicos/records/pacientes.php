<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <!--meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="src/css/main.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script-->
        <?php include 'src/includes/head.php'; ?>
    </head>
    <body class="bg-light">
        
        <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container bg-light b-shadow"  style="margin-top:80px">
            <br>
            <div class="clearfix">
                <span class="float-left">
                    <h2>Pacientes</h2>
                </span>
                <span class="float-right">
                    <a href="pacienteForm.php" class="btn btn-info rounded-circle"><i class="fas fa-user-plus"></i></a>
                </span>
            </div>
            
            <p><input class="form-control" id="myInput" type="text" placeholder="Search.."></p>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Ident.</th>
                            <th>Domicilio</th>
                            <th>Telefono</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <tr>
                            <td>John</td>
                            <td>Doe</td>
                            <td>john@example.com</td>
                            <td>john@example.com</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm m-0">
                                    <button type="button" class="btn btn-info"><i class="far fa-eye"></i> Ver</button>
                                    <button type="button" class="btn btn-secondary"><i class="fas fa-edit"></i> Editar</button>
                                    <button type="button" class="btn btn-dark"><i class="fas fa-file-medical-alt"></i> Historial</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
        $(document).ready(function(){
        $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        });
        });
        </script>
    </body>
</html>