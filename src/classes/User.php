<?php

namespace Games\Classes;
use Games\Classes\DB;

/**
 * Clase que define un Usuario
 */
class User {
    private int $id;
    private string $name;
    private string $password;
    private array $permissions;

    /**
     * Constructor del Usuario
     *
     * @param int $id ID del Usuario
     * @param string $name Nombre del Usuario
     * @param string $password Contraseña del Usuario
     */
    public function __construct(int $id, string $name, string $password) {
        $this -> id = $id;
        $this -> name = $name;
        $this -> password = $password;

        $this -> getPermissions();
    }

    /**
     * Obtiene la ID del Usuario
     *
     * @return int
     */
    public function getId(): int {
        return $this -> id;
    }

    /**
     * Obtiene el nombre del Usuario
     *
     * @return string
     */
    public function getName(): string {
        return $this -> name;
    }

    /**
     * Obtiene la contraseña del Usuario
     *
     * @return string
     */
    public function getPassword(): string {
        return $this -> password;
    }

    /**
     * Establece los permisos del Usuario
     *
     * @return void
     */
    private function getPermissions(): void {
        $connect = new DB();

        $this -> permissions = array_column($connect -> Select("SELECT permission FROM users_permissions WHERE user = '" . $this -> id . "'"), "permission");
    }

    /**
     * Comprueba si el Usuario tiene un permiso en especifico
     *
     * @param int $permission ID del permiso a comprobar
     * @return bool
     */
    public function havePermission(int $permission): bool {
        return in_array($permission, $this -> permissions);
    }
}

?>