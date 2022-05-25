<!DOCTYPE html>

<html lang="es">
    <head>
        <?php include "./modules/html/head.php"; ?>

        <title>AlbertoST Informática - Games - Juegos</title>
    </head>

    <body>
        <header>
            <nav>
                <a href="./index.php"><img src="./resources/icon.png"></a>
        
                <span>Menu</span>
                <ul>
                    <li><a href="./index.php">Inicio</a></li>
                    <li><a id="actual" href="./games.php">Juegos</a></li>
                    <li><a href="./form.php">Agregar / Reportar Juego</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <div class="search">
                <h1>Buscar Juego</h1>

                <form action="./games.php" method="POST">
                    <input type="text" name="juego" id="juego">
                    <input type="submit" name="search" id="search" value="Buscar">
                    <a href="./games.php"><input type="button" value="Mostrar Todos"></a>
                </form>
            </div>

            <div class="games">
                <?php isset($_POST["search"]) ? BuscarJuegos($_POST["juego"]) : ObtenerJuegos(); ?>
            </div>
        </main>
    </body>
</html>