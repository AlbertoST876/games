<?php

use Games\Classes\DB;
use Games\Classes\Game;

/**
 * Obtiene la lista de juegos que hay en la Base de Datos
 *
 * @return void
 */
function obtenerJuegosListados(): void {
    $connect = new DB();
    $result = $connect -> Select("SELECT id, nombre FROM games ORDER BY nombre ASC");
    
    foreach ($result as $game) new Game($game["id"], $game["nombre"]);
    
    Game::mostrarTodosListados();
}

/**
 * Reporta un juego mandando un mensaje que se almacena en la Base de Datos
 *
 * @param int $juego ID del juego
 * @param string $mensaje Mensaje del reporte
 * @return void
 */
function reportarJuego(int $juego, string $mensaje): void {
    if (empty($juego) || empty($mensaje)) {
        echo "<p>Faltan uno o mas campos por rellenar</p>";
    } else {
        $connect = new DB();

        $mensaje = $connect -> clearString($mensaje);

        $result = $connect -> Insert("INSERT INTO reports (juego, mensaje) VALUES ('$juego', '$mensaje')");

        if ($result) {
            echo "<p>Tu reporte se a enviado y será validado por un administrador, gracias</p>";
        } else {
            echo "<p>Ha ocurrido un error, inténtalo de nuevo mas tarde</p>";
        }
    }
}

?>