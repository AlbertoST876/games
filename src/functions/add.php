<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 30-03-2022 09:11:38
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 01-06-2022 11:34:13
 * @ Description: Función para subir un juego a la base de datos, usado en la página agregar/reportar
 */

/**
 * Sube un juego dado por un usuario a la base de datos
 *
 * @param string $nombre
 * @param array $imagen
 * @param array $torrent
 * @return void
 */
function SubirJuego(string $nombre, array $imagen, array $torrent):void {
    include "./modules/db/db.php";

    if ($connect) {
        if (empty($nombre) || empty($imagen) || empty($torrent)) {
            echo "<p>Faltan uno o mas campos por rellenar</p>";
        } else {
            // Limpiar caracteres especiales
            $nombre = mysqli_real_escape_string($connect, $nombre);

            // Imagen del Juego
            $rutaimagen = SubirArchivo($imagen, "./resources/img/");

            // Torrent del Juego
            $rutatorrent = SubirArchivo($torrent, "./resources/torrent/");

            // Fecha y Hora
            $date = date("d/m/Y - H:i:s");

            // Registrar en la Base de Datos
            $SQL = "INSERT INTO games (nombre, imagen, torrent, fecha) VALUES ('$nombre', '$rutaimagen', '$rutatorrent', '$date')";
            $result = mysqli_query($connect, $SQL);

            if ($result) {
                echo "<p>Se ha registrado su juego con éxito</p>";
            } else {
                echo "<p>Ha ocurrido un error, inténtalo de nuevo mas tarde</p>";
            }
        }
    } else {
        echo "<p>Ha ocurrido un error, inténtalo de nuevo mas tarde</p>";
    }

    mysqli_close($connect);
}

/**
 * Sube un archivo al sistema de archivos haciendo uso de la variable $_FILES
 *
 * @param array $archivo
 * @param string $rutaguardado
 * @return string
 */
function SubirArchivo(array $archivo, string $rutaguardado):string {
    move_uploaded_file($archivo["tmp_name"], $rutaguardado . "/" . $archivo["name"]);

    return $rutaguardado . $archivo["name"];
}

?>