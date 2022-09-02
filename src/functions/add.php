<?php

use Games\Classes\DB;

/**
 * Sube un juego dado por un usuario a la Base de Datos
 *
 * @param string $nombre Nombre del juego
 * @param array $imagen Imagen del juego
 * @param array $torrent Torrent del juego
 * @return void
 */
function subirJuego(string $nombre, array $imagen, array $torrent): void {
    if (empty($nombre) || empty($imagen) || empty($torrent)) {
        echo "<p>Faltan uno o mas campos por rellenar</p>";
    } else {
        $connect = new DB();

        $nombre = $connect -> clearString($nombre);
        $rutaimagen = SubirArchivo($imagen, "./assets/img/");
        $rutatorrent = SubirArchivo($torrent, "./assets/torrent/");

        $result = $connect -> Insert("INSERT INTO games (nombre, imagen, torrent) VALUES ('$nombre', '$rutaimagen', '$rutatorrent')");

        if ($result) {
            echo "<p>Se ha registrado su juego con éxito</p>";
        } else {
            echo "<p>Ha ocurrido un error, inténtalo de nuevo mas tarde</p>";
        }
    }
}

/**
 * Sube un archivo al sistema de archivos haciendo uso de la variable $_FILES
 *
 * @param array $archivo Archivo guardado en la variable $_FILES
 * @param string $rutaguardado Ruta donde se guardará el archivo
 * @return string
 */
function subirArchivo(array $archivo, string $rutaguardado): string {
    move_uploaded_file($archivo["tmp_name"], $rutaguardado . "/" . $archivo["name"]);
    
    return $rutaguardado . $archivo["name"];
}

?>