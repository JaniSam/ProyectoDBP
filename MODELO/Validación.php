<?php
    require "../CONTROLADOR/DataBase/conexion.php";
    if (isset($_POST['iniciarS'])) {
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        try {
            $consulta = "SELECT * FROM usuarios WHERE nomUsu = ? AND clave = ?";
            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("ss", $usuario, $clave); // 'ss' indica que ambos parámetros son cadenas

            // Ejecuta la consulta
            $stmt->execute();

            // Verifica si se encontró algún resultado
            $resul = $stmt->get_result();

            if ($resul->num_rows) {
                echo "Validacion Correcta ❤";
                header ('location: ../VISTA/ReservaTurno.php');
            } else {
                echo "Contraseña y/o Usuario Incorrectos :(";
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

    } else {
        echo "HDLHAFDLLAFA";
    }
    