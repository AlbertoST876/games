<?php

use Games\Classes\DB;

/**
 * Devuelve el catálogo de los juegos destacados
 *
 * @return void
 */
function ObtenerJuegosDestacados():void {
    $connect = new DB();
    $result = $connect -> Select("SELECT nombre, imagen, torrent FROM games WHERE destacado = 'yes' ORDER BY nombre ASC");

    for ($i = 0; $i < count($result); $i++) {
        echo "<div class='game'><a href=" . $result[$i]["torrent"] . "><img src=" . $result[$i]["imagen"] . "></a><p>" . $result[$i]["nombre"] . "</p></div>";
    }
}


?>