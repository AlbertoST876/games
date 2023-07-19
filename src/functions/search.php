<?php

use Games\Classes\DB;
use Games\Classes\Game;

/**
 * Devuelve el catálogo de juegos que coincidan con la búsqueda realizada
 *
 * @return void
 */
function searchGames() {
    if (empty($_GET["game"])) {
        echo "<p>Debe rellenar el campo de búsqueda</p>";
    } else {
        $connect = new DB();

        $gameName = $connect -> clearString($_GET["game"]);

        $result = $connect -> Select("SELECT id, name, image, torrent FROM games WHERE name LIKE '%$gameName%' ORDER BY name ASC");

        foreach ($result as $game) new Game($game["id"], $game["name"], $game["image"], $game["torrent"]);

        Game::showAll();
    }
}

/**
 * Devuelve un catálogo de juegos paginados que coincidan con el nombre del juego buscado
 *
 * @param int $amount Cantidad de juegos por página, 18 por defecto
 * @return void
 */
function searchPaginatedGames(int $amount = 18): void {
    if (empty($_GET["game"])) {
        echo "<p>Debe rellenar el campo de búsqueda</p>";
    } else {
        $connect = new DB();

        $gameName = $connect -> clearString($_GET["game"]);

        $compag = !isset($_GET["page"]) ? 1 : $_GET["page"];
    
        $TotalRegistro = ceil(count($connect -> Select("SELECT id FROM games WHERE name LIKE '%$gameName%'")) / $amount);
    
        $result = $connect -> Select("SELECT id, name, image, torrent FROM games WHERE name LIKE '%$gameName%' ORDER BY name ASC LIMIT " . $amount * ($compag - 1) . "," . $amount);
    
        if ($TotalRegistro == 0) echo "<p>No se encontró ningún resultado</p>";

        if ($TotalRegistro > 0) {
            foreach ($result as $game) new Game($game["id"], $game["name"], $game["image"], $game["torrent"]);
    
            Game::showAll();
        
            $IncrimentNum = $TotalRegistro >= ($compag + 1) ? $compag + 1 : 1;
            $DecrementNum = 1 > ($compag - 1) ? 1 : $compag - 1;
            
            echo "<ul><li class='btn'><a href='?game=" . $gameName . "&page=" . $DecrementNum . "'>◀</a></li>";
            
            $Desde = $compag - (ceil($amount / 2) - 1);
            $Hasta = $compag + (ceil($amount / 2) - 1);
        
            $Desde = $Desde < 1 ? 1 : $Desde;
            $Hasta = $Hasta < $amount ? $amount : $Hasta;
            
            for ($i = $Desde; $i <= $Hasta; $i++) {
                if ($i <= $TotalRegistro) {
                    echo $i == $compag ? "<li class='active'><a href='?game=" . $gameName . "&page=" . $i . "'>" . $i . "</a></li>" : "<li><a href='?game=" . $gameName . "&page=" . $i . "'>" . $i . "</a></li>";
                }
            }
            
            echo "<li class='btn'><a href='?game=" . $gameName . "&page=" . $IncrimentNum . "'>▶</a></li></ul>";
        }
    }
}

?>