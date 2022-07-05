<?php

use Games\Classes\DB;
use Games\Classes\Game;

/**
 * Devuelve el catálogo de los juegos destacados
 *
 * @return void
 */
function ObtenerJuegosDestacados(): void {
    $connect = new DB();
    $result = $connect -> Select("SELECT id, nombre, imagen, torrent FROM games WHERE destacado = 'T' ORDER BY nombre ASC");

    foreach ($result as $game) {
        new Game($game["id"], $game["nombre"], $game["imagen"], $game["torrent"]);
    }

    Game::mostrarTodos();
}

?>