<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 30-03-2022 09:11:38
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 01-06-2022 11:35:32
 * @ Description: Función para obtener los juegos destacados para la página de inicio
 */

/**
 * Devuelve el catálogo de los juegos destacados
 *
 * @return void
 */
function ObtenerJuegosDestacados(): void {
    include "./modules/db/db.php";

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