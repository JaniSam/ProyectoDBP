<?php
// Incluye el archivo de conexión
include '../CONTROLADOR/DataBase/conexion.php';
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Turnos Registrados</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">SPA "JA YE GI MO"</a>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="index.php">INICIO DE SESION</a>
                        <a class="nav-link" href="ReservaTurno.php">RESERVAR</a>
                        <a class="nav-link disabled" aria-disabled="true">SALIR</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <?php
            // Mostrar mensaje de éxito si existe
            if (isset($_SESSION['mensaje'])) {
                echo "<div class='alert alert-success'>{$_SESSION['mensaje']}</div>";
                unset($_SESSION['mensaje']); // Eliminar el mensaje después de mostrarlo
            }
        ?>
    <!-- Formulario de búsqueda por rango de fechas -->
    <div class="container mb-4">
        <form action="../MODELO/CRUD_turno.php" method="POST">
            <div class="row">
                <div class="col-md-5">
                    <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                    <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                </div>
                <div class="col-md-5">
                    <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100" name="buscar" id="buscar">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-5">
    
        <h1 class="text-center mb-4">Turnos Registrados</h1>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>CI</th>
                    <th>Cliente</th>
                    <th>Especialidad</th>
                    <th>Doctor/a</th>
                    <th>Fecha/Hora</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta para obtener los turnos registrados
                $query = "SELECT 
                            rt.idReservaT, 
                            rt.cedulaCli, 
                            rt.nombreCli, 
                            e.nombreEsp AS especialidad, 
                            p.nombreProf AS profesional, 
                            t.hora_fecha AS fecha_turno, 
                            rt.estado AS estado_turno
                          FROM 
                            reservaturnos AS rt
                          INNER JOIN 
                            turnos AS t ON rt.idTurno = t.idTurno
                          INNER JOIN 
                            profesionales AS p ON t.idProfesional = p.idProfesional
                          INNER JOIN 
                            especialidades AS e ON p.idEspecialidad = e.idEspecialidad
                          ORDER BY 
                            rt.idReservaT DESC;";

                $result = $conexion->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['idReservaT']}</td>
                                <td>{$row['cedulaCli']}</td>
                                <td>{$row['nombreCli']}</td>
                                <td>{$row['especialidad']}</td>
                                <td>{$row['profesional']}</td>
                                <td>{$row['fecha_turno']}</td>
                                <td>{$row['estado_turno']}</td>
                                <td>
                                    <!-- Botón de Editar que abre el Modal -->
                                    <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editarModal{$row['idReservaT']}'>Editar</button> 
                                    <!-- Modal de Edición -->
                                    <div class='modal fade' id='editarModal{$row['idReservaT']}' tabindex='-1' aria-labelledby='editarModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='editarModalLabel'>Editar Estado del Turno</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
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
                                                        <button type='submit' class='btn btn-primary' name='actualizarEstado' id='actualizarEstado'>Actualizar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Botón de Eliminar que abre el Modal -->
                                    <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#confirmarEliminacionModal{$row['idReservaT']}'>🗑</button>
                                    
                                    <!-- Modal de Confirmación de Eliminación -->
                                    <div class='modal fade' id='confirmarEliminacionModal{$row['idReservaT']}' tabindex='-1' aria-labelledby='confirmarEliminacionModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='confirmarEliminacionModalLabel'>¿Estás seguro de eliminar este turno?</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    <p>Este proceso no se puede deshacer.</p>
                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                                                    <a href='../MODELO/CRUD_turno.php?id={$row['idReservaT']}&accion=eliminar' class='btn btn-danger'>Eliminar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                              </tr>";
                              
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No hay registros</td></tr>";
                }

                $conexion->close();
                ?>
            </tbody>
        </table>
    </div>

    <!--Scripts de Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
