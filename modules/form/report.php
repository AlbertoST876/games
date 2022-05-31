<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 30-03-2022 09:11:38
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 31-05-2022 11:46:01
 * @ Description: Funciones que actúan en el formulario de reporte en la página agregar/reportar
 */

/**
 * Obtiene la lista de juegos que hay en la base de datos
 *
 * @return void
 */
function ObtenerListaJuegos() {
    include "./modules/db/db.php";

    $SQL = "SELECT id, nombre FROM games ORDER BY nombre ASC";
    $result = mysqli_query($connect, $SQL);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value=" . $row["id"] . ">" . $row["nombre"] . "</option>";
        }
    } else {
        echo "Ha ocurrido un error, inténtalo de nuevo mas tarde";
    }
    
    mysqli_close($connect);
}

/**
 * Reporta un juego mandando un mensaje que se almacena en la base de datos
 *
 * @param int $juego
 * @param string $mensaje
 * @return void
 */
function ReportarJuego($juego, $mensaje) {
    include "./modules/db/db.php";

    if ($connect) {
        if (empty($juego) || empty($mensaje)) {
            echo "<p>Faltan uno o mas campos por rellenar</p>";
        } else {
            // Limpiar caracteres especiales
            $mensaje = mysqli_real_escape_string($connect, $mensaje);

            // Fecha y Hora
            $date = date("d/m/Y - H:i:s");

            // Registrar en la Base de Datos
            $SQL = "INSERT INTO reports (juego, mensaje, fecha) VALUES ('$juego', '$mensaje', '$date')";
            $result = mysqli_query($connect, $SQL);

            if ($result) {
                echo "<p>Tu reporte se a enviado y será validado por un administrador, gracias</p>";
            } else {
                echo "<p>Ha ocurrido un error, inténtalo de nuevo mas tarde</p>";
            }
        }
    } else {
        echo "<p>Ha ocurrido un error, inténtalo de nuevo mas tarde</p>";
    }

    mysqli_close($connect);
}

?>