<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 30-03-2022 09:11:38
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 12-04-2022 02:24:29
 * @ Description: Función para subir un juego a la base de datos, usado en la página agregar/reportar
 */

/**
 * Sube un juego dado por un usuario a la base de datos
 *
 * @param String $nombre
 * @param File $imagen
 * @param File $torrent
 * @return void
 */
function SubirJuego($nombre, $imagen, $torrent) {
    include "./modules/db/db.php";

    if ($connect) {
        if (empty($nombre) || empty($imagen) || empty($torrent)) {
            echo "<p>Faltan uno o mas campos por rellenar</p>";
        } else {
            // Limpiar caracteres especiales
            $nombre = mysqli_real_escape_string($connect, $nombre);

            // Imagen del Juego
            $rutaimagen = SubirArchivo($_FILES["imagen"], "./resources/img/");

            // Torrent del Juego
            $rutatorrent = SubirArchivo($_FILES["torrent"], "./resources/torrent/");

            // Fecha y Hora
            $date = date("d/m/Y - H:i:s");

            // Registrar en la Base de Datos
            $SQL = "INSERT INTO games (nombre, imagen, torrent, fecha) VALUES ('$nombre', '$rutaimagen', '$rutatorrent', '$date')";
            $result = mysqli_query($connect, $SQL);

            if ($result) {
                echo "<p>Se ha registrado su juego con éxito</p>";
            } else {
                echo "<p>Ha ocurrido un error, intentalo de nuevo mas tarde</p>";
            }
        }
    } else {
        echo "<p>Ha ocurrido un error, intentalo de nuevo mas tarde</p>";
    }

    mysqli_close($connect);
}

/**
 * Sube un archivo al sistema de archivos haciendo uso de la variable $_FILES
 *
 * @param Array $archivo
 * @param String $rutaguardado
 * @return String
 */
function SubirArchivo($archivo, $rutaguardado) {
    move_uploaded_file($archivo["tmp_name"], $rutaguardado . "/" . $archivo["name"]);

    return $rutaguardado . $archivo["name"];
}

?>