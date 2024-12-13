<?php
    // Incluye el archivo de conexión
    include '../CONTROLADOR/DataBase/conexion.php';
    require '../MODELO/CRUD_turno.php';
    session_start();
$result = $_SESSION['result'] ?? []; // Si no hay datos, $result será un arreglo vacío
//unset($_SESSION['result']); // Limpia la sesión para evitar datos antiguos
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>BusquedaRegistros</title>
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
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($result)) {
                    foreach ($result as $row) {
                        echo "<tr>
                                <td>{$row['idReservaT']}</td>
                                <td>{$row['cedulaCli']}</td>
                                <td>{$row['nombreCli']}</td>
                                <td>{$row['especialidad']}</td>
                                <td>{$row['profesional']}</td>
                                <td>{$row['fecha_turno']}</td>
                                <td>{$row['estado_turno']}</td>
                                <td>
                                    <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editarModal{$row['idReservaT']}'>Editar</button> 
                                    <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#confirmarEliminacionModal{$row['idReservaT']}'>🗑</button>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No hay registros para este rango de fechas.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
