<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 31-03-2022 16:01:57
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 01-06-2022 11:35:20
 * @ Description: Función que realiza la búsqueda de juegos por su nombre, usada en search
 */

/**
 * Devuelve el catálogo de juegos que coincidan con la búsqueda realizada
 *
 * @param string $juego
 * @return void
 */
function BuscarJuegos(string $juego):void {
    include "./modules/db/db.php";

    if ($connect) {
        if (empty($juego)) {
            echo "<p>Debe rellenar el campo de búsqueda</p>";
        } else {
            $juego = mysqli_real_escape_string($connect, $juego);

            $SQL = "SELECT nombre, imagen, torrent FROM games WHERE nombre LIKE '%$juego%' ORDER BY nombre ASC";
            $result = mysqli_query($connect, $SQL);

            if (mysqli_num_rows($result) == 0) {
                echo "<p>No se encontró ningún resultado</p>";
            } elseif (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {        
                    echo "<div class='game'><a href=" . $row["torrent"] . "><img src=" . $row["imagen"] . "></a><p>" . $row["nombre"] . "</p></div>";
                } 
            } else {
                echo "<p>Ha ocurrido un error, inténtalo de nuevo mas tarde</p>";
            }
        }
    } else {
        echo "<p>Ha ocurrido un error, inténtalo de nuevo mas tarde</p>";
    }

    mysqli_close($connect);
}

?>