<?php

/**
 * Devuelve el catálogo de juegos que coincidan con la búsqueda realizada
 *
 * @param string $juego
 * @param int $cantidad
 * @return void
 */
function buscarJuegos(string $juego, int $cantidad = 18): void {
    include "./src/functions/db.php";

    if ($connect) {
        if (empty($juego)) {
            echo "<p>Debe rellenar el campo de búsqueda</p>";
        } else {
            $juego = mysqli_real_escape_string($connect, $juego);
    
            $compag = !isset($_GET["pag"]) ? 1 : $_GET["pag"];
        
            $TotalRegistro = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT id FROM games WHERE nombre LIKE '%$juego%'")) / $cantidad);
        
            $result = mysqli_query($connect, "SELECT nombre, imagen, torrent FROM games WHERE nombre LIKE '%$juego%' ORDER BY nombre ASC LIMIT " . $cantidad * ($compag - 1) . "," . $cantidad);
        
            if ($TotalRegistro == 0) echo "<p>No se encontró ningún resultado</p>";
    
            if ($TotalRegistro > 0) {
                while ($row = mysqli_fetch_assoc($result)) echo "<div class='game'><a href=" . $row["torrent"] . "><img src=" . $row["imagen"] . "></a><p>" . $row["nombre"] . "</p></div>";
            
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
    } else {
        echo "<p>Ha ocurrido un error, inténtalo de nuevo mas tarde</p>";
    }

    mysqli_close($connect);
}

?>