<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style type="text/css">
        body {
        position: relative;
        height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: url('src/img/background-login.jpg');
        background-size: cover;
        }
        body::before {
        content: "";
        position: absolute;
        top: 0px;
        right: 0px;
        bottom: 0px;
        left: 0px;
        background-color: rgba(0,0,0,0.25);
        }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-8 mx-auto bg-light p-4 shadow-lg rounded-lg">                    
                    <h2 class="text-center">INGRESAR</h2>
                    <form>
                        <div class="form-group">
                            <label for="username">Usuario:</label>
                            <input type="email" class="form-control" id="username" placeholder="Enter username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                        </div>
                        <!--div class="form-group form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember"> Remember me
                            </label>
                        </div-->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>