<?php include "./vendor/autoload.php"; ?>
<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Alberto Sánchez Torreblanca">
        <script src="./assets/js/scripts.js"></script>
        <link rel="stylesheet" href="./assets/css/style.css">
        <link rel="icon" href="./assets/icon.png">
        <title>AlbertoST Informática - Games - Juegos</title>
    </head>

    <body>
        <header>
            <nav>
                <a href="./index.php"><img src="./assets/icon.png"></a>
        
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

                <form action="./search.php" method="GET">
                    <input type="text" name="juego" id="juego">
                    <input type="submit" value="Buscar">
                    <a href="./games.php"><input type="button" value="Mostrar Todos"></a>
                </form>
            </div>

            <div class="games">
                <?php buscarJuegosPaginados($_GET["juego"]); ?>
            </div>
        </main>
    </body>
</html>