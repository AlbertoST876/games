<?php

use Games\Classes\DB;

/**
 * Devuelve en una tabla HTML los reportes realizados por los usuarios
 *
 * @param string $dateFormat Formato en el que se mostrarán las fechas provenientes de la Base de Datos
 * @return void
 */
function getAllReports(string $dateFormat = "%d/%m/%Y %H:%i:%s"): void {
    $connect = new DB();
    $result = $connect -> Select("SELECT id, game, message, DATE_FORMAT(reported, '$dateFormat') AS reportedESP, attendedBy, DATE_FORMAT(attended, '$dateFormat') AS attendedESP, resolved FROM reports ORDER BY reportedESP DESC");

    foreach ($result as $report) echo $_SESSION["user"] -> havePermission(10) ? "<tr><td>" . getGameNameById($connect, $report["game"]) . "</td><td>" . $report["message"] . "</td><td>" . $report["reportedESP"] . "</td><td>" . getUsernameById($connect, $report["attendedBy"]) . "</td><td>" . $report["attendedESP"] . "</td><td>" . getStringResolved($report["resolved"]) . "</td><td><form class='action' action='./tools/reportsEdit.php' method='POST'><input type='hidden' name='reportId' value='" . $report["id"] . "'><input class='edit' type='submit' name='edit' value=''></form></td></tr>" : "<tr><td>" . getGameNameById($connect, $report["game"]) . "</td><td>" . $report["message"] . "</td><td>" . $report["reportedESP"] . "</td><td>" . getUsernameById($connect, $report["attendedBy"]) . "</td><td>" . $report["attendedESP"] . "</td><td>" . getStringResolved($report["resolved"]) . "</td></tr>";
}

/**
 * Devuelve si el reporte a sido resuelto o no
 *
 * @param string $resolved Introduce "T" o "F"
 * @return string
 */
function getStringResolved(string $resolved): string {
    return $resolved == "T" ? "Sí" : "No";
}

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

function modifyReport(): void {
    $connect = new DB();
    $connect -> Update("UPDATE reports SET attendedBy = NULL, attended = NULL, resolved = 'F' WHERE id = '" . $_POST["reportId"] . "'");

    if (isset($_POST["attended"])) $connect -> Update("UPDATE reports SET attendedBy = '" . $_SESSION["user"] -> getId() . "', attended = '" . date("Y/m/d H:i:s") . "' WHERE id = '" . $_POST["reportId"] . "'");
    if (isset($_POST["resolved"])) $connect -> Update("UPDATE reports SET resolved = '" . $_POST["resolved"] . "' WHERE id = '" . $_POST["reportId"] . "'");
}

?>