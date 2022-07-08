<?php

use Games\Classes\DB;
use Games\Classes\Game;

/**
 * Devuelve el catálogo de juegos que coincidan con la búsqueda realizada
 *
 * @param string $juego Nombre del juego
 * @return void
 */
function buscarJuegos(string $juego): void {
    if (empty($juego)) {
        echo "<p>Debe rellenar el campo de búsqueda</p>";
    } else {
        $connect = new DB();

        $juego = $connect -> clearString($juego);

        $result = $connect -> Select("SELECT id, nombre, imagen, torrent FROM games WHERE nombre LIKE '%$juego%' ORDER BY nombre ASC");

        if (count($result) == 0) {
            echo "<p>No se encontró ningún resultado</p>";
        } 
        
        if (count($result) > 0) {
            foreach ($result as $game) new Game($game["id"], $game["nombre"], $game["imagen"], $game["torrent"]);

            Game::mostrarTodos();
        }
    }
}

?>