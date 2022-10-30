<?php

namespace Games\Classes;

/**
 * Clase que define un juego
 */
class Game {
    private int $id;
    private string $name;
    private string $image;
    private string $torrent;

    private static array $games = [];

    /**
     * Constructor del juego
     *
     * @param int $id ID del juego
     * @param string $name Nombre del juego
     * @param string $image Ruta de la imagen del juego
     * @param string $torrent Ruta del torrent del juego
     */
    public function __construct(int $id, string $name, string $image = "", string $torrent = "") {
        $this -> id = $id;
        $this -> name = $name;
        $this -> image = $image;
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
    public function getName(): string {
        return $this -> name;
    }

    /**
     * Devuelve la ruta de la imagen del juego
     *
     * @return string
     */
    public function getPathImage(): string {
        return $this -> image;
    }

    /**
     * Devuelve la ruta del torrent del juego
     *
     * @return string
     */
    public function getTorrentPath(): string {
        return $this -> torrent;
    }

    /**
     * Muestra todos los juegos
     *
     * @return void
     */
    public static function showAll(): void {
        foreach (self::$games as $game) $game -> show();
    }

    /**
     * Muestra listados todos los juegos
     *
     * @return void
     */
    public static function showAllListed(): void {
        foreach (self::$games as $game) $game -> showListed();
    }

    /**
     * Muestra un juego en concreto
     *
     * @return void
     */
    public function show(): void {
        echo "<div class='game'><a href='" . $this -> torrent . "'><img src='" . $this -> image . "'></a><p>" . $this -> name . "</p></div>";
    }

    /**
     * Muestra listado un juego en concreto
     *
     * @return void
     */
    public function showListed(): void {
        echo "<option value='" . $this -> id . "'>" . $this -> name . "</option>";
    }
}

?>