<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="conteiner">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-auto bg-light p-5">
                <h1>INICIO DE SESIÓN</h1>
                <form action="../MODELO/CRUD_turno.php" method="post">
                    <div class="input-group p-2">
                        <input class="from-control" type="text" name="usuario" id="usuario" placeholder="Usuario">                    
                    </div>
                    <div class="input-group p-2">
                        <input class="from-control" type="password" name="clave" id="clave" placeholder="Contraseña">
                    </div>
                    
                    <button class="btn btn-success w-100" type= "submit" name= "iniciarS" id="iniciarS">ACEPTAR</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>