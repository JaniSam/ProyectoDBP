<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../CONTROLADOR/CSS/style.css">
    <title>Iniciar Sesión</title>
</head>
<body class="bg-light">
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="row w-100 align-items-center">
            <!-- Logo -->
            <div class="col-md-6 text-center">
                <img src="../IMAGENES/Logo/Spa Ja Ye Gi Mo.png" class="img-fluid" alt="Logo Ja Ye Gi Mo" style="max-width: 300px; height: auto;">
            </div>

            <!-- Formulario -->
            <div class="col-md-6 bg-white shadow p-5 rounded">
                <h1 class="text-center mb-4">INICIO DE SESIÓN</h1>
                <form action="../MODELO/Validación.php" method="post">
                    <div class="mb-3">
                        <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuario">                    
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="password" name="clave" id="clave" placeholder="Contraseña">
                    </div>
                    <button class="btn btn-success w-100" type="submit" name="iniciarS" id="iniciarS">ACEPTAR</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
