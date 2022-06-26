<?php

use Games\Classes\DB;

/**
 * Devuelve el catálogo con todos los juegos
 *
 * @return void
 */
function ObtenerJuegos(): void {
    $connect = new DB();

    PaginarJuegos($connect);
}

/**
 * Pagina los juegos en diferentes páginas, sino se le especifica cantidad, por defecto es 18
 *
 * @param DB $connect Conexión con la Base de Datos
 * @param int $cantidad Cantidad de juegos por página
 * @return void
 */
function PaginarJuegos(DB $connect, int $cantidad = 18): void {
    $compag = !isset($_GET["pag"]) ? 1 : $_GET["pag"];

    $TotalRegistro = ceil(count($connect -> Select("SELECT nombre, imagen, torrent FROM games")) / $cantidad);

    $result = $connect -> Select("SELECT nombre, imagen, torrent FROM games ORDER BY nombre ASC LIMIT " . $cantidad * ($compag - 1) . "," . $cantidad);

    foreach ($result as $clave => $valor) {
        echo "<div class='game'><a href=" . $valor["torrent"] . "><img src=" . $valor["imagen"] . "></a><p>" . $valor["nombre"] . "</p></div>";
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