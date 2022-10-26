<?php

use Games\Classes\DB;

/**
 * Obtiene todos los permisos disponibles listados
 *
 * @return void
 */
function getListedPermissions(): void {
    $connect = new DB();
    $result = $connect -> Select("SELECT * FROM permissions");

    foreach ($result as $permission) {
        echo $_SESSION["user"] -> havePermission($permission["id"]) ? "<div><input type='checkbox' name='permissions[]' value='" . $permission["id"] . "'><label for='permissions'>" . $permission["action"] . "</label></div>" : "<div><input type='checkbox' name='permissions[]' value='" . $permission["id"] . "' disabled><label for='permissions'>" . $permission["action"] . "</label></div>";
    }
}

/**
 * Devuelve en una tabla HTML los usuarios existentes en la Base de Datos
 *
 * @param string $dateFormat Formato en el que se mostrarán las fechas provenientes de la Base de Datos
 * @return void
 */
function getAllUsers(string $dateFormat = "%d/%m/%Y %H:%i:%s"): void {
    $connect = new DB();
    $result = $connect -> Select("SELECT id, username, DATE_FORMAT(lastPasswordChange, '$dateFormat') AS lastPasswordChangeESP, DATE_FORMAT(lastAccess, '$dateFormat') AS lastAccessESP, editedBy, DATE_FORMAT(lastEdition, '$dateFormat') AS lastEditionESP, createdBy, DATE_FORMAT(registered, '$dateFormat') AS registeredESP FROM users ORDER BY username ASC");

    foreach ($result as $user) echo $_SESSION["user"] -> havePermission(6) || $_SESSION["user"] -> havePermission(8) ? "<tr><td>" . $user["username"] . "</td><td>" . $user["lastPasswordChangeESP"] . "</td><td>" . $user["lastAccessESP"] . "</td><td>" . getUsernameById($connect, $user["editedBy"]) . "</td><td>" . $user["lastEditionESP"] . "</td><td>" . getUsernameById($connect, $user["createdBy"]) . "</td><td>" . $user["registeredESP"] . "</td><td>" . getUsersActions($user["id"]) . "</td></tr>" : "<tr><td>" . $user["username"] . "</td><td>" . $user["lastPasswordChangeESP"] . "</td><td>" . $user["lastAccessESP"] . "</td><td>" . getUsernameById($connect, $user["editedBy"]) . "</td><td>" . $user["lastEditionESP"] . "</td><td>" . getUsernameById($connect, $user["createdBy"]) . "</td><td>" . $user["registeredESP"] . "</td></tr>";
}

/**
 * Obtiene el nombre de Usuario por su ID
 *
 * @param DB $connect Conexión a la Base de Datos
 * @param int|null $userId ID del Usuario
 * @return string|null
 */
function getUsernameById(DB $connect, int|null $userId): string|null {
    if (!is_null($userId)) {
        $result = $connect -> Select("SELECT username FROM users WHERE id = '$userId'");

        return $result[0]["username"];
    }

    return null;
}

/**
 * Obtiene las acciones que puede realizar un usuario según sus permisos
 *
 * @param int $userId ID del Usuario con el que se realizarán las acciones
 * @return string
 */
function getUsersActions(int $userId): string {
    $string = "";

    if ($_SESSION["user"] -> havePermission(6) && $_SESSION["user"] -> getId() != $userId && $userId != 1) $string .= "<form class='action' action='./tools/usersEdit.php' method='POST'><input type='hidden' name='userId' value='$userId'><input class='edit' type='submit' name='edit' value=''></form>";
    if ($_SESSION["user"] -> havePermission(8) && $_SESSION["user"] -> getId() != $userId && $userId != 1) $string .= "<form class='action' action='./users.php' method='POST'><input type='hidden' name='userId' value='$userId'><input class='delete' type='submit' name='delete' value=''></form>";

    return $string;
}

/**
 * Añade un Usuario a la Base de Datos
 *
 * @return void
 */
function addUser(): void {
    $connect = new DB();

    $username = $connect -> clearString($_POST["username"]);
    $password = $connect -> clearString($_POST["password"]);

    $result = $connect -> Select("SELECT username FROM users WHERE username = '$username'");

    if (count($result) == 0) {
        $connect -> Insert("INSERT INTO users (username, password, createdBy) VALUES ('$username', '$password', '" . $_SESSION["user"] -> getId() . "')");

        if (isset($_POST["permissions"])) {
            $result = $connect -> Select("SELECT id FROM users WHERE username = '$username'");

            foreach ($_POST["permissions"] as $permission) $connect -> Insert("INSERT INTO users_permissions (user, permission) VALUES ('" . $result[0]["id"] . "', '$permission')");
        }
    } else {
        echo "<p>El nombre de usuario introducido ya existe</p>";
    }
}

/**
 * Elimina un Usuario de la Base de Datos
 *
 * @return void
 */
function deleteUser(): void {
    $connect = new DB();
    $connect -> Remove("DELETE FROM users WHERE id = '" . $_POST["userId"] . "'");
}

?>