<?php

use Games\Classes\DB;

/**
 * Devuelve el catálogo de juegos que coincidan con la búsqueda realizada
 *
 * @param string $juego Nombre del juego
 * @return void
 */
function BuscarJuegos(string $juego): void {
    if (empty($juego)) {
        echo "<p>Debe rellenar el campo de búsqueda</p>";
    } else {
        $connect = new DB();

        // Limpiar caracteres especiales
        $juego = $connect -> clearString($juego);

        $result = $connect -> Select("SELECT nombre, imagen, torrent FROM games WHERE nombre LIKE '%$juego%' ORDER BY nombre ASC");

        if (count($result) == 0) {
            echo "<p>No se encontró ningún resultado</p>";
        } elseif (count($result) > 0) {
            for ($i = 0; $i < count($result); $i++) {        
                echo "<div class='game'><a href=" . $result[$i]["torrent"] . "><img src=" . $result[$i]["imagen"] . "></a><p>" . $result[$i]["nombre"] . "</p></div>";
            } 
        } else {
            echo "<p>Ha ocurrido un error, inténtalo de nuevo mas tarde</p>";
        }
    }
}

?>