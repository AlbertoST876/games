<?php

use Games\Classes\DB;

/**
 * Comprueba si un Administrador ha iniciado sesión
 *
 * @return bool
 */
function isLogin(): bool {
    return isset($_SESSION["user"]) || !empty($_SESSION["user"]);
}

/**
 * Comprueba si el Administrador debe restaurar la contraseña y lo envía ha restorePassword, si no necesita cambiarla lo envía al home
 *
 * @return void
 */
function haveRestorePassword(): void {
    $connect = new DB();
    $result = $connect -> Select("SELECT restorePassword FROM users WHERE id = '" . $_SESSION["user"] -> getId() . "'");

    header($result[0]["restorePassword"] == "T" ? "Location: ./tools/restorePassword.php" : "Location: ./home.php");
    exit();
}

/**
 * Si el usuario no ha iniciado sesión, lo manda al index
 *
 * @return void
 */
function isAdminLogged(): void {
    if (!isLogin()) {
        header("Location: ./index.php");
        exit();
    }
}

?>