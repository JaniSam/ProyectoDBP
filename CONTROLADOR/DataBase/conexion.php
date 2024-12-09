<?php
    require "variables.php";

    $conexion = new mysqli($host, $user, $password, $database, $puerto );

    if ($conexion->errno) {
        echo "Algo salió mal :(";
    } else {
        // echo "Algo salió Bien :)";
    }
    