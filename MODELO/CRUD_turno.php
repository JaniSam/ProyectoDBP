<?php
    require "../CONTROLADOR/DataBase/conexion.php";

    if (isset($_POST['registroT'])) {
        $cedula = $_POST['cedula'];
        $nombreCli = $_POST['nomAp'];
        $idTurno = $_POST['turno'];

        $consulta = "";
        header('location: ../VISTA/ReservaTurno.php ');
    }


