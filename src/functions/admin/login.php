<?php

use Games\Classes\DB;
use Games\Classes\User;

/**
 * Inicia sesión de un Usuario
 *
 * @return User|null
 */
function login(): User|null {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        echo "<p>Faltan uno o mas campos por rellenar</p>";
    } else {
        $connect = new DB();

        $username = $connect -> clearString($_POST["username"]);
        $password = $connect -> clearString($_POST["password"]);

        $result = $connect -> Select("SELECT id, username, password, restorePassword FROM users WHERE username = '$username'");
        
        if (count($result) == 1 && verifyPassword($result[0]["restorePassword"], $password, $result[0]["password"])) {
            $connect -> Update("UPDATE users SET lastAccess = '" . date("Y/m/d H:i:s") . "' WHERE id = '" . $result[0]["id"] . "'");

            return new User($result[0]["id"], $result[0]["username"], $result[0]["password"]);
        } else {
            echo "<p>Tus credenciales son incorrectas, inténtalo de nuevo</p>";
        }
    }

    return null;
}

/**
 * Verifica si la contraseña del Usuario es correcta
 *
 * @param string $restore Indica si la contraseña debe cambiarse
 * @param string $password Contraseña introducida por el Usuario
 * @param string $passwordDB Contraseña del Usuario
 * @return bool
 */
function verifyPassword(string $restore, string $password, string $passwordDB): bool {
    return $restore == "T" ? $password == $passwordDB : password_verify($password, $passwordDB);
}

/**
 * Cambia la contraseña de un Usuario
 *
 * @return void
 */
function restorePassword(): void {
    if ($_POST["newPassword1"] == $_POST["newPassword2"]) {
        $connect = new DB();

        $hash = password_hash($connect -> clearString($_POST["newPassword1"]), PASSWORD_DEFAULT);
        
        $connect -> Update("UPDATE users SET password = '$hash', restorePassword = 'F', lastPasswordChange = '" . date("Y/m/d H:i:s") . "' WHERE id = '" . $_SESSION["user"] -> getId() . "'");
    } else {
        echo "<p>Las contraseñas introducidas son diferentes, inténtalo de nuevo</p>";
    }
}

/**
 * Cierra la sesión de un Usuario
 *
 * @return void
 */
function logout(): void {
    unset($_SESSION["user"]);
    
    header("Location: ./index.php");
    exit();
}

?>