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
    
    $conexion->close();

