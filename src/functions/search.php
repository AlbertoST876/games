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

        $juego = $connect -> clearString($juego);

        $result = $connect -> Select("SELECT nombre, imagen, torrent FROM games WHERE nombre LIKE '%$juego%' ORDER BY nombre ASC");

        if (count($result) == 0) {
            echo "<p>No se encontró ningún resultado</p>";
        } 
        
        if (count($result) > 0) {
            foreach ($result as $clave => $valor) {        
                echo "<div class='game'><a href=" . $valor["torrent"] . "><img src=" . $valor["imagen"] . "></a><p>" . $valor["nombre"] . "</p></div>";
            } 
        }
    }
}

?>