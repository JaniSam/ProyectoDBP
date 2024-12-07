<?php
    require "../CONTROLADOR/DataBase/conexion.php";

    if (isset($_POST['iniciarS'])) {
        header('location: ../VISTA/ReservaTurno.php ');
    }
