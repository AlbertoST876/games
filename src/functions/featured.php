<?php

/**
 * Devuelve el catálogo de los juegos destacados
 *
 * @return void
 */
function obtenerJuegosDestacados(): void {
    include "./src/functions/db.php";

    if ($connect) {
        $SQL = "SELECT nombre, imagen, torrent FROM games WHERE destacado = 'yes' ORDER BY nombre ASC";
        $result = mysqli_query($connect, $SQL);
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) echo "<div class='game'><a href=" . $row["torrent"] . "><img src=" . $row["imagen"] . "></a><p>" . $row["nombre"] . "</p></div>";
        } else {
            echo "<p>Ha ocurrido un error, inténtalo de nuevo mas tarde</p>";
        }
    }
    
    mysqli_close($connect);
}

?>