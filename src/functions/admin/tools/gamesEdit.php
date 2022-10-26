<?php

use Games\Classes\DB;
use Games\Classes\Game;

/**
 * Obtiene los datos modificables de un juego por su ID
 *
 * @return array
 */
function getGameEdit(): array {
    $connect = new DB();
    $result = $connect -> Select("SELECT id, name, image, torrent, featured FROM games WHERE id = '" . $_POST["gameId"] . "'");
    
    return $result[0];
}

/**
 * Guarda los datos editados del Juego
 *
 * @return void
 */
function modifyGame(): void {
    $connect = new DB();

    $name = $connect -> clearString($_POST["name"]);

    $connect -> Update("UPDATE games SET name = '$name', featured = 'F', editedBy = '" . $_SESSION["user"] -> getId() . "', lastEdition ='" . date("Y/m/d H:i:s") . "' WHERE id = '" . $_POST["gameId"] . "'");

    if ($_FILES["image"]["name"] != null) {
        unlink($_POST["imagePath"]);

        $connect -> Update("UPDATE games SET image = '". saveFile($_FILES["image"], "../../assets/img/", 4) . "' WHERE id = '" . $_POST["gameId"] . "'");
    }

    if ($_FILES["torrent"]["name"] != null) {
        unlink($_POST["torrentPath"]);

        $connect -> Update("UPDATE games SET torrent = '" . saveFile($_FILES["torrent"], "../../assets/torrent/", 4) . "' WHERE id = '" . $_POST["gameId"] . "'");
    }

    if (isset($_POST["featured"])) $connect -> Update("UPDATE games SET featured = '" . $_POST["featured"] . "' WHERE id = '" . $_POST["gameId"] . "'");
}

/**
 * Obtiene la vista previa de un Juego
 *
 * @param int $gameId ID del Juego
 * @param string $gameName Nombre del Juego
 * @param string $gameImage Ruta de la Imagen del Juego
 * @param string $gameTorrent Ruta del Torrent del Juego
 * @return void
 */
function getGamePreview(int $gameId, string $gameName, string $gameImage, string $gameTorrent): void {
    $game = new Game($gameId, $gameName, $gameImage, $gameTorrent); 
    $game -> show();
}

?>