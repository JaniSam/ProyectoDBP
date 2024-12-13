<?php
// Incluir la conexión a la base de datos
include '../CONTROLADOR/DataBase/conexion.php';
session_start();-
// Consultar los turnos con su especialidad en la base de datos
$query = "SELECT t.idTurno, e.nombreEsp AS especialidad FROM turnos t 
        INNER JOIN 
            profesionales p ON t.idProfesional = p.idProfesional
        INNER JOIN 
            especialidades e ON p.idEspecialidad = e.idEspecialidad;";
$result = $conexion->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../CONTROLADOR/CSS/style.css">
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
                        <a class="nav-link" href="Turnos.php">TURNOS</a>
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
                        <input class="form-control" type="number" name="cedula" id="cedula" placeholder="CEDULA">
                    </div>
                    <div class="input-group p-2">
                        <input class="form-control" type="text" name="nomAp" id="nomAp" placeholder="NOMBRE Y APELLIDO">
                    </div>
                    <div class="input-group p-2">
                        <select class="form-control" name="turno" id="turno">
                            <option value="seleccione">SELECCIONE</option>
                            <?php
                            // Verifica si hay turnos disponibles
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // Mostrar las especialidades en el select
                                    echo "<option value='{$row['idTurno']}'>{$row['especialidad']}</option>";
                                }
                            } else {
                                echo "<option value=''>No hay turnos disponibles</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button class="btn btn-success w-100" type="submit" name="registroT" id="registroT">REGISTRAR</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
