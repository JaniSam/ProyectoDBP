<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registro de Turnos</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">SPA "JA YE GI MO"</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="index.php">INICIO DE SESION</a>
                        <a class="nav-link" href="#">CLIENTES</a>
                        <a class="nav-link" href="#">TURNOS</a>
                        <a class="nav-link disabled" aria-disabled="true">SALIR</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="conteiner">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-auto bg-light p-5">
                <h1>REGISTRAR TURNOS</h1>
                <form action="../MODELO/CRUD_turno.php" method="post">
                    <div class="input-group p-2">
                        <input class="from-control" type="number" name="cedula" id="cedula" placeholder="CEDULA">                    
                    </div>
                    <div class="input-group p-2">
                        <input class="from-control" type="text" name="nomAp" id="nomAp" placeholder="NOMBRE Y APELLIDO">
                    </div>
                    <div class="input-group p-2">
                        <input class="from-control" type="emial" name="correo" id="correo" placeholder="CORREO">
                    </div>
                    <div class="input-group p-2">
                        <select class="from-control" name="especialidad" id="especialidad" placeholder="SELECCIONE">
                            <option name="1" value="seleccione">SELECCIONE</option>
                            <option name="2" value="seleccione">DERMATOLOGÍA</option>
                            <option name="3" value="seleccione">PEDIATRÍA</option>
                            <option name="4" value="seleccione">CARDIOLOGÍA</option>
                        </select>
                    </div>
                    <button class="btn btn-success w-100" type= "submit" name= "registroT" id="registroT">REGISTRAR</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>