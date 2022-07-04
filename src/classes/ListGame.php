<?php

namespace Games\Classes;

/**
 * Clase que define un juego a listar
 */
class ListGame {
    private int $id;
    private string $nombre;

    private static array $games = [];

    /**
     * Constructor del juego a listar
     *
     * @param integer $id ID del juego
     * @param string $nombre Nombre del juego
     */
    public function __construct(int $id, string $nombre) {
        $this -> id = $id;
        $this -> nombre = $nombre;

        self::$games[] = $this;
    }

    /**
     * Obtiene la ID del juego
     *
     * @return int
     */
    public function getId(): int {
        return $this -> id;
    }

    /**
     * Devuelve el nombre del juego
     *
     * @return string
     */
    public function getNombre(): string {
        return $this -> nombre;
    }

    /**
     * Muestra listados todos los juegos
     *
     * @return void
     */
    public static function mostrarTodos(): void {
        foreach (self::$games as $game) {
            $game -> mostrar();
        }
    }

    /**
     * Muestra listado un juego en concreto
     *
     * @return void
     */
    public function mostrar(): void {
        echo "<option value=" . $this -> id . ">" . $this -> nombre . "</option>";
    }
}

?>