<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 30-03-2022 09:11:38
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 01-04-2022 14:12:57
 * @ Description: Funciones para obtener los juegos para la página de juegos, incluida la paginación de los mismos
 */

/**
 * Devuelve el catálogo con todos los juegos
 *
 * @return void
 */
function ObtenerJuegos() {
    include "./modules/db/db.php";

    if ($connect) {
        PaginarJuegos($connect);
    } else {
        echo "<p>Ha ocurrido un error, intentalo de nuevo mas tarde</p>";
    }

    mysqli_close($connect);
}

/**
 * Pagina los juegos en diferentes páginas, sino se le especifica cantidad, por defecto es 18
 *
 * @param Mysqli $connect
 * @param Int $cantidad
 * @return void
 */
function PaginarJuegos($connect, $cantidad = 18) {
    $compag = !isset($_GET["pag"]) ? 1 : $_GET["pag"];

    $TotalRegistro = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT nombre, imagen, torrent FROM games")) / $cantidad);

    $SQL = "SELECT nombre, imagen, torrent FROM games ORDER BY nombre ASC LIMIT " . $cantidad * ($compag - 1) . "," . $cantidad;
    $result = mysqli_query($connect, $SQL);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='game'><a href=" . $row["torrent"] . "><img src=" . $row["imagen"] . "></a><p>" . $row["nombre"] . "</p></div>";
    }

    $IncrimentNum = $TotalRegistro >= ($compag + 1) ? $compag + 1 : 1;
    $DecrementNum = 1 > ($compag - 1) ? 1 : $compag - 1;
        
    echo "<ul><li class='btn'><a href='?pag=" . $DecrementNum . "'>◀</a></li>";
    
    $Desde = $compag - (ceil($cantidad / 2) - 1);
    $Hasta = $compag + (ceil($cantidad / 2) - 1);

    $Desde = $Desde < 1 ? 1 : $Desde;
    $Hasta = $Hasta < $cantidad ? $cantidad : $Hasta;
    
    for ($i = $Desde; $i <= $Hasta; $i++) {
        if ($i <= $TotalRegistro) {
            if ($i == $compag) {
                echo "<li class='active'><a href='?pag=" . $i . "'>" . $i . "</a></li>";
            } else {
                echo "<li><a href='?pag=" . $i . "'>" . $i . "</a></li>";
            }     		
        }
    }
    
    echo "<li class='btn'><a href='?pag=" . $IncrimentNum . "'>▶</a></li></ul>";
}

?>