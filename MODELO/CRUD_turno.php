<?php
    require "../CONTROLADOR/DataBase/conexion.php";

    if (isset($_POST['registroT'])) {
        $cedula = $_POST['cedula'];
        $nombreCli = $_POST['nomAp'];
        $idTurno = $_POST['turno'];

        $consulta = "";
        header('location: ../VISTA/ReservaTurno.php ');
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

