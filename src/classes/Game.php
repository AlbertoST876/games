<?php

namespace Games\Classes;

/**
 * Clase que define un juego
 */
class Game {
    private int $id;
    private string $nombre;
    private string $imagen;
    private string $torrent;

    private static array $games = [];

    /**
     * Constructor del juego
     *
     * @param int $id ID del juego
     * @param string $nombre Nombre del juego
     * @param string $imagen Ruta de la imagen del juego
     * @param string $torrent Ruta del torrent del juego
     */
    public function __construct(int $id, string $nombre, string $imagen = "", string $torrent = "") {
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> imagen = $imagen;
        $this -> torrent = $torrent;

        self::$games[] = $this;
    }

    /**
     * Devuelve la ID del juego
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
     * Devuelve la ruta de la imagen del juego
     *
     * @return string
     */
    public function getRutaImagen(): string {
        return $this -> imagen;
    }

    /**
     * Devuelve la ruta del torrent del juego
     *
     * @return string
     */
    public function getRutaTorrent(): string {
        return $this -> torrent;
    }

    /**
     * Muestra todos los juegos
     *
     * @return void
     */
    public static function mostrarTodos(): void {
        foreach (self::$games as $game) $game -> mostrar();
    }

    /**
     * Muestra listados todos los juegos
     *
     * @return void
     */
    public static function mostrarTodosListados(): void {
        foreach (self::$games as $game) $game -> mostrarListado();
    }

    /**
     * Muestra un juego en concreto
     *
     * @return void
     */
    public function mostrar(): void {
        echo "<div class='game'><a href=" . $this -> torrent . "><img src=" . $this -> imagen . "></a><p>" . $this -> nombre . "</p></div>";
    }

    /**
     * Muestra listado un juego en concreto
     *
     * @return void
     */
    public function mostrarListado(): void {
        echo "<option value=" . $this -> id . ">" . $this -> nombre . "</option>";
    }
}

?>