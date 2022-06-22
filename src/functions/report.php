<?php

use Games\Classes\DB;

/**
 * Obtiene la lista de juegos que hay en la Base de Datos
 *
 * @return void
 */
function ObtenerListaJuegos(): void {
    $connect = new DB();
    $result = $connect -> Select("SELECT id, nombre FROM games ORDER BY nombre ASC");
    
    for ($i = 0; $i < count($result); $i++) {
        echo "<option value=" . $result[$i]["id"] . ">" . $result[$i]["nombre"] . "</option>";
    }
}

/**
 * Reporta un juego mandando un mensaje que se almacena en la Base de Datos
 *
 * @param int $juego ID del juego
 * @param string $mensaje Mensaje del reporte
 * @return void
 */
function ReportarJuego(int $juego, string $mensaje): void {
    if (empty($juego) || empty($mensaje)) {
        echo "<p>Faltan uno o mas campos por rellenar</p>";
    } else {
        $connect = new DB();

        // Limpiar caracteres especiales
        $mensaje = $connect -> clearString($mensaje);

        // Registrar en la Base de Datos
        $result = $connect -> Insert("INSERT INTO reports (juego, mensaje) VALUES ('$juego', '$mensaje')");

        if ($result) {
            echo "<p>Tu reporte se a enviado y será validado por un administrador, gracias</p>";
        } else {
            echo "<p>Ha ocurrido un error, inténtalo de nuevo mas tarde</p>";
        }
    }
}

?>