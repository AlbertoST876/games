<!DOCTYPE html>

<html lang="es">
    <head>
        <?php include "./modules/html/head.php"; ?>
        <title>AlbertoST Informática - Games - Inicio</title>
    </head>

    <body>
        <header>
            <nav>
                <a href="./index.php"><img src="./resources/icon.png"></a>
        
                <span>Menu</span>
                <ul>
                    <li><a id="actual" href="./index.php">Inicio</a></li>
                    <li><a href="./games.php">Juegos</a></li>
                    <li><a href="./form.php">Agregar / Reportar Juego</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <h1 class="destacados">Juegos Destacados</h1>

            <div class="games">
                <?php ObtenerJuegosDestacados(); ?>
            </div>            
        </main>
    </body>
</html>