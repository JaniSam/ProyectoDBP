<?php
    require "../CONTROLADOR/DataBase/conexion.php";

    if (isset($_POST['iniciarS'])) {
        $ci = $_POST['cedula'];
        $nombre = $_POST['nomAp'];
        $correo = $_POST['correo'];
        $turno = $_POST['turno'];

        header('location: ../VISTA/ReservaTurno.php ');
    }
