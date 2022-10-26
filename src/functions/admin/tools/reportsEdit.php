<?php

use Games\Classes\DB;

/**
 * Obtiene los datos modificables de un reporte por su ID
 *
 * @return array
 */
function getReportEdit(): array {
    $connect = new DB();
    $result = $connect -> Select("SELECT reports.id, games.name AS game, reports.message, reports.attendedBy, reports.resolved FROM reports INNER JOIN games ON reports.game = games.id WHERE reports.id = '" . $_POST["reportId"] . "'");
    
    return $result[0];
}

/**
 * Guarda los datos editados del Reporte
 *
 * @return void
 */
function modifyReport(): void {
    $connect = new DB();
    $connect -> Update("UPDATE reports SET attendedBy = NULL, attended = NULL, resolved = 'F' WHERE id = '" . $_POST["reportId"] . "'");

    if (isset($_POST["attended"])) $connect -> Update("UPDATE reports SET attendedBy = '" . $_SESSION["user"] -> getId() . "', attended = '" . date("Y/m/d H:i:s") . "' WHERE id = '" . $_POST["reportId"] . "'");
    if (isset($_POST["resolved"])) $connect -> Update("UPDATE reports SET resolved = '" . $_POST["resolved"] . "' WHERE id = '" . $_POST["reportId"] . "'");
}

?>