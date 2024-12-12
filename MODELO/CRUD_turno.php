<?php
    require "../CONTROLADOR/DataBase/conexion.php";

    if (isset($_POST['registroT'])) {
        // Captura los datos del formulario
        $cedula = $_POST['cedula'];
        $nombreCli = $_POST['nomAp'];
        $idTurno = $_POST['turno'];
    
        // Validar que los datos no estén vacíos
        if ($cedula && $nombreCli && $idTurno != 'seleccione') {
            // Insertar la reserva de turno en la base de datos
            $query = "INSERT INTO reservaturnos (cedulaCli, nombreCli, idTurno, estado) VALUES (?, ?, ?, 1)";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param("ssi", $cedula, $nombreCli, $idTurno);
    
            if ($stmt->execute()) {
                // Redirige al usuario con un mensaje de éxito
                header('Location: ../VISTA/ReservaTurno.php?msg=Turno registrado con éxito');
            } else {
                // Si ocurre un error
                echo "Error al registrar el turno: " . $conexion->error;
            }
    
            // Cierra la sentencia
            $stmt->close();
        } else {
            echo "Por favor complete todos los campos.";
        }
    }
    

    if (isset($_POST['actualizarEstado'])) {
        $idReservaT = $_POST['id'];
        $estado = $_POST['estado'];
    
        // Consulta para actualizar el estado del turno
        $query = "UPDATE reservaturnos SET estado = ? WHERE idReservaT = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("si", $estado, $idReservaT);
    
        if ($stmt->execute()) {
            // Redirige a la página de turnos con un mensaje de éxito
            header("Location: Turnos.php?msg=Estado actualizado");
        } else {
            // Si ocurre un error
            echo "Error al actualizar el estado: " . $conexion->error;
        }
        $stmt->close();
    }

    // Eliminar turno
    if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['id'])) {
        $idReservaT = $_GET['id'];

        // Consulta para eliminar el turno
        $query = "DELETE FROM reservaturnos WHERE idReservaT = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("i", $idReservaT);

        if ($stmt->execute()) {
            // Redirige a la página de turnos con un mensaje de éxito
            header("Location: Turnos.php?msg=Turno eliminado");
        } else {
            // Si ocurre un error
            echo "Error al eliminar el turno: " . $conexion->error;
        }
        $stmt->close();
    }
    
    //buscar por fechas
    if (isset($_POST['buscar'])) {
        $fecha_inicio = $_POST['fecha_inicio'] ?? '';
        $fecha_fin = $_POST['fecha_fin'] ?? '';
    
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
                    especialidades AS e ON p.idEspecialidad = e.idEspecialidad";
    
        if ($fecha_inicio && $fecha_fin) {
            $query .= " WHERE t.hora_fecha BETWEEN ? AND ? ORDER BY rt.idReservaT DESC";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param("ss", $fecha_inicio, $fecha_fin);
        } else {
            $query .= " ORDER BY rt.idReservaT DESC";
            $stmt = $conexion->prepare($query);
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Guarda los datos en un arreglo asociativo
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    
        // Almacena los datos en la sesión
        session_start();
        $_SESSION['result'] = $data;
    
        header('Location: ../VISTA/BusquedaRegistro.php');
        exit;
    }
  

    $conexion->close();

