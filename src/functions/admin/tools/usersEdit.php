<?php

use Games\Classes\DB;

/**
 * Obtiene los datos modificables de un usuario por su ID
 *
 * @return array
 */
function getUserEdit(): array {
    $connect = new DB();
    $result = $connect -> Select("SELECT id, username, restorePassword FROM users WHERE id = '" . $_POST["userId"] . "'");
    
    return $result[0];
}

/**
 * Obtiene los permisos que pueden ser editados por el Usuario que edita
 *
 * @return void
 */
function getUserEditPermissions(): void {
    $connect = new DB();
    $result = $connect -> Select("SELECT * FROM permissions");

    $userEditPermissions = array_column($connect -> Select("SELECT permission FROM users_permissions WHERE user = '" . $_POST["userId"] . "'"), "permission");

    foreach ($result as $permission) {
        echo $_SESSION["user"] -> havePermission($permission["id"]) ? "<div><input type='checkbox' name='permissions[]' value='" . $permission["id"] . "' " . userEditHasPermission($permission["id"], $userEditPermissions) . "><label for='permissions'>" . $permission["action"] . "</label></div>" : "<div><input type='checkbox' name='permissions[]' value='" . $permission["id"] . "' disabled " . userEditHasPermission($permission["id"], $userEditPermissions) . "><label for='permissions'>" . $permission["action"] . "</label></div>";
    }
}

/**
 * Devuelve si el Usuario a editar tiene un permiso asignado
 *
 * @param int $permissionId ID del Permiso
 * @param array $userEditPermissions Permisos del Usuario a editar
 * @return string
 */
function userEditHasPermission(int $permissionId, array $userEditPermissions): string {
    return in_array($permissionId, $userEditPermissions) ? "checked" : "";
}

/**
 * Guarda los datos editados del Usuario
 *
 * @return void
 */
function modifyUser(): void {
    $connect = new DB();

    $username = $connect -> clearString($_POST["username"]);

    $connect -> Update("UPDATE users SET username = '$username', editedBy = '" . $_SESSION["user"] -> getId() . "', lastEdition = '" . date("Y/m/d H:i:s") . "' WHERE id = '" . $_POST["userId"] . "'");

    if (isset($_POST["restorePassword"])) {
        $newPassword = $connect -> clearString($_POST["newPassword"]);
        $restorePassword = $connect -> clearString($_POST["restorePassword"]);

        $connect -> Update("UPDATE users SET password = '$newPassword', restorePassword = '" . $restorePassword . "' WHERE id = '" . $_POST["userId"] . "'");
    }

    $permissions = array_column($connect -> Select("SELECT id FROM permissions"), "id");
    $userEditPermissions = array_column($connect -> Select("SELECT permission FROM users_permissions WHERE user = '" . $_POST["userId"] . "'"), "permission");

    if (isset($_POST["permissions"])) {
        foreach ($permissions as $permission) {
            if (in_array($permission, $userEditPermissions) && !in_array($permission, $_POST["permissions"]) && $_SESSION["user"] -> havePermission($permission)) $connect -> Remove("DELETE FROM users_permissions WHERE user = '" . $_POST["userId"] . "' AND permission = '$permission'");
            if (!in_array($permission, $userEditPermissions) && in_array($permission, $_POST["permissions"]) && $_SESSION["user"] -> havePermission($permission)) $connect -> Insert("INSERT INTO users_permissions (user, permission) VALUES ('" . $_POST["userId"] . "', '$permission')");
        }
    } else {
        foreach ($permissions as $permission) {
            if (in_array($permission, $userEditPermissions) && $_SESSION["user"] -> havePermission($permission)) $connect -> Remove("DELETE FROM users_permissions WHERE user = '" . $_POST["userId"] . "' AND permission = '$permission'");
        }
    }
}

?>