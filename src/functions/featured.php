<?php

use Games\Classes\DB;

/**
 * Devuelve el catálogo de los juegos destacados
 *
 * @return void
 */
function ObtenerJuegosDestacados(): void {
    $connect = new DB();
    $result = $connect -> Select("SELECT nombre, imagen, torrent FROM games WHERE destacado = 'T' ORDER BY nombre ASC");

    foreach ($result as $clave => $valor) {
        echo "<div class='game'><a href=" . $valor["torrent"] . "><img src=" . $valor["imagen"] . "></a><p>" . $valor["nombre"] . "</p></div>";
    }
}


?>