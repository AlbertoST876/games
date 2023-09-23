<?php

use Games\Classes\DB;
use Games\Classes\Game;

/**
 * Devuelve el catálogo con todos los juegos
 *
 * @return void
 */
function getGames(): void {
    $connect = new DB();
    $result = $connect -> Select("SELECT id, name, image, torrent FROM games ORDER BY name ASC");
    
    foreach ($result as $game) new Game($game["id"], $game["name"], $game["image"], $game["torrent"]);

    Game::showAll();
}

/**
 * Devuelve un catálogo con los juegos destacados del momento
 *
 * @return void
 */
function getFeaturedGames(): void {
    $connect = new DB();
    $result = $connect -> Select("SELECT id, name, image, torrent FROM games WHERE featured = 'T' ORDER BY name ASC");

    foreach ($result as $game) new Game($game["id"], $game["name"], $game["image"], $game["torrent"]);

    Game::showAll();
}

/**
 * Obtiene los juegos en diferentes páginas, si no se le especifica una cantidad, por defecto es 18
 *
 * @param int $amount Cantidad de juegos por página, 18 por defecto
 * @return void
 */
function getPaginatedGames(int $amount = 18): void {
    if (isset($_GET["page"])) {
        if ($_GET["page"] < 1) header("Location: ./games.php?page=1");
    }
    
    $connect = new DB();

    $compag = !isset($_GET["page"]) ? 1 : $_GET["page"];

    $TotalRegistro = ceil(count($connect -> Select("SELECT id FROM games")) / $amount);

    $result = $connect -> Select("SELECT id, name, image, torrent FROM games ORDER BY name ASC LIMIT " . $amount * ($compag - 1) . "," . $amount);

    foreach ($result as $game) new Game($game["id"], $game["name"], $game["image"], $game["torrent"]);
    
    Game::showAll();

    $IncrimentNum = $TotalRegistro >= ($compag + 1) ? $compag + 1 : 1;
    $DecrementNum = 1 > ($compag - 1) ? 1 : $compag - 1;
    
    echo "<ul><li class='btn'><a href='?page=" . $DecrementNum . "'>◀</a></li>";
    
    $Desde = $compag - (ceil($amount / 2) - 1);
    $Hasta = $compag + (ceil($amount / 2) - 1);

    $Desde = $Desde < 1 ? 1 : $Desde;
    $Hasta = $Hasta < $amount ? $amount : $Hasta;
    
    for ($i = $Desde; $i <= $Hasta; $i++) {
        if ($i <= $TotalRegistro) {
            echo $i == $compag ? "<li class='active'><a href='?page=" . $i . "'>" . $i . "</a></li>" : "<li><a href='?page=" . $i . "'>" . $i . "</a></li>";
        }
    }
    
    echo "<li class='btn'><a href='?page=" . $IncrimentNum . "'>▶</a></li></ul>";
}

?>