<?php

use Games\Classes\DB;
use Games\Classes\Game;

/**
 * Devuelve en una tabla HTML los juegos existentes en la Base de Datos
 *
 * @param string $dateFormat Formato en el que se mostrarán las fechas provenientes de la Base de Datos
 * @return void
 */
function getAllGames(string $dateFormat = "%d/%m/%Y %H:%i:%s"): void {
    $connect = new DB();
    $result = $connect -> Select("SELECT id, name, image, torrent, featured, editedBy, DATE_FORMAT(lastEdition, '$dateFormat') AS lastEditionESP, createdBy, DATE_FORMAT(registered, '$dateFormat') AS registeredESP FROM games ORDER BY name ASC");

    foreach ($result as $game) echo $_SESSION["user"] -> havePermission(7) || $_SESSION["user"] -> havePermission(9) ? "<tr><td>" . $game["name"] . "</td><td>" . $game["image"] . "</td><td>" . $game["torrent"] . "</td><td>" . getStringFeatured($game["featured"]) . "</td><td>" . getUsernameById($connect, $game["editedBy"]) . "</td><td>" . $game["lastEditionESP"] . "</td><td>" . getUsernameById($connect, $game["createdBy"]) . "</td><td>" . $game["registeredESP"] . "</td><td>" . getGamesActions($game["id"]) . "</td></tr>" : "<tr><td>" . $game["name"] . "</td><td>" . $game["image"] . "</td><td>" . $game["torrent"] . "</td><td>" . getStringFeatured($game["featured"]) . "</td><td>" . getUsernameById($connect, $game["editedBy"]) . "</td><td>" . $game["lastEditionESP"] . "</td><td>" . getUsernameById($connect, $game["createdBy"]) . "</td><td>" . $game["registeredESP"] . "</td></tr>";
}

/**
 * Devuelve si el Juego es destacado o no
 *
 * @param string $featured Introduce "T" o "F"
 * @return string
 */
function getStringFeatured(string $featured): string {
    return $featured == "T" ? "Sí" : "No";
}

/**
 * Obtiene el nombre de un Juego por su ID
 *
 * @param DB $connect Conexión a la Base de Datos
 * @param int|null $gameId ID del Juego
 * @return string|null
 */
function getGameNameById(DB $connect, int|null $gameId): string|null {
    if (!is_null($gameId)) {
        $result = $connect -> Select("SELECT name FROM games WHERE id = '$gameId'");

        return $result[0]["name"];
    }

    return null;
}

/**
 * Obtiene las acciones que puede realizar un usuario a los juegos según sus permisos
 *
 * @param int $gameId ID del Juego con el que se realizarán las acciones
 * @return string
 */
function getGamesActions(int $gameId): string {
    $string = "";

    if ($_SESSION["user"] -> havePermission(7)) $string .= "<form class='action' action='./tools/gamesEdit.php' method='POST'><input type='hidden' name='gameId' value='$gameId'><input class='edit' type='submit' name='edit' value=''></form>";
    if ($_SESSION["user"] -> havePermission(9)) $string .= "<form class='action' action='./games.php' method='POST'><input type='hidden' name='gameId' value='$gameId'><input class='delete' type='submit' name='delete' value=''></form>";

    return $string;
}

/**
 * Añade un Juego a la Base de Datos
 *
 * @return void
 */
function addGame(): void {
    if (empty($_POST["name"]) || empty($_FILES["image"]) || empty($_FILES["torrent"])) {
        echo "<p>Faltan uno o mas campos por rellenar</p>";
    } else {
        $connect = new DB();

        $name = $connect -> clearString($_POST["name"]);

        resizeImg($_FILES["image"]["tmp_name"]);

        $connect -> Insert("INSERT INTO games (name, image, torrent, createdBy) VALUES ('$name', '" . saveFile($_FILES["image"], "../assets/img/", 1) . "', '" . saveFile($_FILES["torrent"], "../assets/torrent/", 1) . "', '" . $_SESSION["user"] -> getId() . "')");
    }
}

/**
 * Guarda un archivo en el sistema haciendo uso de la variable $_FILES
 *
 * @param array $file Archivo guardado en la variable $_FILES
 * @param string $path Ruta donde se guardará el archivo
 * @param int $substr Cantidad de dígitos a eliminar de la ruta por la izquierda, predeterminado 0
 * @return string
 */
function saveFile(array $file, string $path, int $substr = 0): string {
    $savePath = $path . $file["name"];

    move_uploaded_file($file["tmp_name"], $savePath);

    return substr($savePath, $substr);
}

/**
 * Dimensiona una imagen a las medidas de idóneas para las caratulas de los juegos
 *
 * @param string $filePath Ruta del Archivo
 * @param int $newWidth Nuevo ancho, predeterminado 170
 * @param int $newHeight Nuevo alto, predeterminado 250
 * @return void
 */
function resizeImg(string $filePath, int $newWidth = 170, int $newHeight = 250): void {
    $source = imagecreatefromjpeg($filePath);
    $width = imagesx($source);
    $height = imagesy($source);

    $thumb = imagecreatetruecolor($newWidth, $newHeight);

    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    imagejpeg($thumb, $filePath, 100);
}

/**
 * Elimina un Juego de la Base de Datos
 *
 * @return void
 */
function deleteGame(): void {
    $connect = new DB();
    $result = $connect -> Select("SELECT image, torrent FROM games WHERE id = '" . $_POST["gameId"] . "'");

    unlink("." . $result[0]["image"]);
    unlink("." . $result[0]["torrent"]);

    $connect -> Remove("DELETE FROM games WHERE id = '" . $_POST["gameId"] . "'");
}

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