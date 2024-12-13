<?php
// Incluir la conexión a la base de datos
include '../CONTROLADOR/DataBase/conexion.php';

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
                <form action='../MODELO/CRUD_turno.php' method='POST'>
                                                        <input type='hidden' name='id' value='{$row['idReservaT']}'>
                                                        <div class='mb-3'>
                                                            <label for='estado' class='form-label'>Estado del Turno</label>
                                                            <select class='form-select' name='estado' id='estado'>
                                                                <option value='Pendiente' " . ($row['estado_turno'] == 'Pendiente' ? 'selected' : '') . ">Pendiente</option>
                                                                <option value='Anulado' " . ($row['estado_turno'] == 'Anulado' ? 'selected' : '') . ">Anulado</option>
                                                                <option value='Atendido' " . ($row['estado_turno'] == 'Atendido' ? 'selected' : '') . ">Atendido</option>
                                                            </select>
                                                        </div>
                                                        <button type='submit' class='btn btn-primary' name='actualizarEstado'>Actualizar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
