<?php

use Games\Classes\DB;

/**
 * Cambia la contraseña de un Usuario
 *
 * @return void
 */
function restorePassword(): void {
    if ($_POST["newPassword1"] == $_POST["newPassword2"]) {
        $connect = new DB(); 
        $connect -> Update("UPDATE users SET password = '" . password_hash($connect -> clearString($_POST["newPassword1"]), PASSWORD_DEFAULT) . "', restorePassword = 'F', lastPasswordChange = '" . date("Y/m/d H:i:s") . "' WHERE id = '" . $_SESSION["user"] -> getId() . "'");
    } else {
        echo "<p>Las contraseñas introducidas son diferentes, inténtalo de nuevo</p>";
    }
}

?>