<?php

use Games\Classes\DB;
use Games\Classes\Game;

/**
 * Obtiene la lista de juegos que hay en la Base de Datos
 *
 * @return void
 */
function getListedGames(): void {
    $connect = new DB();
    $result = $connect -> Select("SELECT id, name FROM games ORDER BY name ASC");
    
    foreach ($result as $game) new Game($game["id"], $game["name"]);
    
    Game::showAllsListed();
}

/**
 * Reporta un juego mandando un mensaje que se almacena en la Base de Datos
 *
 * @return void
 */
function reportGame(): void {
    if (empty($_POST["game"]) || empty($_POST["message"])) {
        echo "<p>Faltan uno o mas campos por rellenar</p>";
    } else {
        $connect = new DB();

        $gameId = $_POST["game"];
        $message = $connect -> clearString($_POST["message"]);

        $result = $connect -> Insert("INSERT INTO reports (game, message) VALUES ('$gameId', '$message')");

        echo $result ? "<p>Tu reporte se a enviado y será validado por un administrador, gracias</p>" : "<p>Ha ocurrido un error, inténtalo de nuevo mas tarde</p>";
    }
}

?>