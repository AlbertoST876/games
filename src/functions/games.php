<?php

use Games\Classes\DB;
use Games\Classes\Game;

/**
 * Devuelve el catálogo con todos los juegos sin paginar
 *
 * @return void
 */
function obtenerJuegos(): void {
    $connect = new DB();
    $result = $connect -> Select("SELECT id, nombre, imagen, torrent FROM games ORDER BY nombre ASC");
    
    foreach ($result as $game) new Game($game["id"], $game["nombre"], $game["imagen"], $game["torrent"]);

    Game::mostrarTodos();
}

/**
 * Devuelve el catálogo de los juegos destacados
 *
 * @return void
 */
function obtenerJuegosDestacados(): void {
    $connect = new DB();
    $result = $connect -> Select("SELECT id, nombre, imagen, torrent FROM games WHERE destacado = 'T' ORDER BY nombre ASC");

    foreach ($result as $game) new Game($game["id"], $game["nombre"], $game["imagen"], $game["torrent"]);

    Game::mostrarTodos();
}

/**
 * Pagina los juegos en diferentes páginas, sino se le especifica cantidad, por defecto es 18
 *
 * @param int $cantidad Cantidad de juegos por página, 18 por defecto
 * @return void
 */
function obtenerJuegosPaginados(int $cantidad = 18): void {
    $connect = new DB();

    $compag = !isset($_GET["pag"]) ? 1 : $_GET["pag"];

    $TotalRegistro = ceil(count($connect -> Select("SELECT id FROM games")) / $cantidad);

    $result = $connect -> Select("SELECT id, nombre, imagen, torrent FROM games ORDER BY nombre ASC LIMIT " . $cantidad * ($compag - 1) . "," . $cantidad);

    foreach ($result as $game) new Game($game["id"], $game["nombre"], $game["imagen"], $game["torrent"]);

    Game::mostrarTodos();

    $IncrimentNum = $TotalRegistro >= ($compag + 1) ? $compag + 1 : 1;
    $DecrementNum = 1 > ($compag - 1) ? 1 : $compag - 1;
    
    echo "<ul><li class='btn'><a href='?pag=" . $DecrementNum . "'>◀</a></li>";
    
    $Desde = $compag - (ceil($cantidad / 2) - 1);
    $Hasta = $compag + (ceil($cantidad / 2) - 1);

    $Desde = $Desde < 1 ? 1 : $Desde;
    $Hasta = $Hasta < $cantidad ? $cantidad : $Hasta;
    
    for ($i = $Desde; $i <= $Hasta; $i++) {
        if ($i <= $TotalRegistro) {
            if ($i == $compag) {
                echo "<li class='active'><a href='?pag=" . $i . "'>" . $i . "</a></li>";
            } else {
                echo "<li><a href='?pag=" . $i . "'>" . $i . "</a></li>";
            }
        }
    }
    
    echo "<li class='btn'><a href='?pag=" . $IncrimentNum . "'>▶</a></li></ul>";
}

?>