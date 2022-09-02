<?php

/**
 * Devuelve el catálogo con todos los juegos
 *
 * @return void
 */
function obtenerJuegos(): void {
    include "./src/functions/db.php";

    if ($connect) {
        PaginarJuegos($connect);
    } else {
        echo "<p>Ha ocurrido un error, inténtalo de nuevo mas tarde</p>";
    }

    mysqli_close($connect);
}

/**
 * Pagina los juegos en diferentes páginas, sino se le especifica cantidad, por defecto es 18
 *
 * @param mysqli $connect
 * @param int $cantidad
 * @return void
 */
function paginarJuegos(mysqli $connect, int $cantidad = 18): void {
    $compag = !isset($_GET["pag"]) ? 1 : $_GET["pag"];

    $TotalRegistro = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT nombre, imagen, torrent FROM games")) / $cantidad);

    $SQL = "SELECT nombre, imagen, torrent FROM games ORDER BY nombre ASC LIMIT " . $cantidad * ($compag - 1) . "," . $cantidad;
    $result = mysqli_query($connect, $SQL);

    while ($row = mysqli_fetch_assoc($result)) echo "<div class='game'><a href=" . $row["torrent"] . "><img src=" . $row["imagen"] . "></a><p>" . $row["nombre"] . "</p></div>";

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