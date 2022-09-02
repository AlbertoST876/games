<?php

/**
 * Sube un juego dado por un usuario a la base de datos
 *
 * @param string $nombre
 * @param array $imagen
 * @param array $torrent
 * @return void
 */
function subirJuego(string $nombre, array $imagen, array $torrent): void {
    include "./src/functions/db.php";

    if ($connect) {
        if (empty($nombre) || empty($imagen) || empty($torrent)) {
            echo "<p>Faltan uno o mas campos por rellenar</p>";
        } else {
            // Limpiar caracteres especiales
            $nombre = mysqli_real_escape_string($connect, $nombre);

            // Imagen del Juego
            $rutaimagen = SubirArchivo($imagen, "./assets/img/");

            // Torrent del Juego
            $rutatorrent = SubirArchivo($torrent, "./assets/torrent/");

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
function subirArchivo(array $archivo, string $rutaguardado): string {
    move_uploaded_file($archivo["tmp_name"], $rutaguardado . "/" . $archivo["name"]);

    return $rutaguardado . $archivo["name"];
}

?>