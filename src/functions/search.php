<?php

use Games\Classes\DB;
use Games\Classes\Game;

/**
 * Devuelve el catálogo de juegos paginados que coincidan con la búsqueda realizada
 *
 * @param string $juego Nombre del juego
 * @param int $cantidad Cantidad de juegos por página, 18 por defecto
 * @return void
 */
function buscarJuegosPaginados(string $juego, int $cantidad = 18): void {
    if (empty($juego)) {
        echo "<p>Debe rellenar el campo de búsqueda</p>";
    } else {
        $connect = new DB();

        $juegoSQL = $connect -> clearString($juego);

        $compag = !isset($_GET["pag"]) ? 1 : $_GET["pag"];
    
        $TotalRegistro = ceil(count($connect -> Select("SELECT id FROM games WHERE nombre LIKE '%$juegoSQL%'")) / $cantidad);
    
        $result = $connect -> Select("SELECT id, nombre, imagen, torrent FROM games WHERE nombre LIKE '%$juegoSQL%' ORDER BY nombre ASC LIMIT " . $cantidad * ($compag - 1) . "," . $cantidad);
    
        if ($TotalRegistro == 0) echo "<p>No se encontró ningún resultado</p>";

        if ($TotalRegistro > 0) {
            foreach ($result as $game) new Game($game["id"], $game["nombre"], $game["imagen"], $game["torrent"]);
    
            Game::mostrarTodos();
        
            $IncrimentNum = $TotalRegistro >= ($compag + 1) ? $compag + 1 : 1;
            $DecrementNum = 1 > ($compag - 1) ? 1 : $compag - 1;
            
            echo "<ul><li class='btn'><a href='?juego=" . $juego . "&pag=" . $DecrementNum . "'>◀</a></li>";
            
            $Desde = $compag - (ceil($cantidad / 2) - 1);
            $Hasta = $compag + (ceil($cantidad / 2) - 1);
        
            $Desde = $Desde < 1 ? 1 : $Desde;
            $Hasta = $Hasta < $cantidad ? $cantidad : $Hasta;
            
            for ($i = $Desde; $i <= $Hasta; $i++) {
                if ($i <= $TotalRegistro) {
                    if ($i == $compag) {
                        echo "<li class='active'><a href='?juego=" . $juego . "&pag=" . $i . "'>" . $i . "</a></li>";
                    } else {
                        echo "<li><a href='?juego=" . $juego . "&pag=" . $i . "'>" . $i . "</a></li>";
                    }
                }
            }
            
            echo "<li class='btn'><a href='?juego=" . $juego . "&pag=" . $IncrimentNum . "'>▶</a></li></ul>";
        }
    }
}

?>