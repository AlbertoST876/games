<?php include "./vendor/autoload.php"; ?>
<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Alberto Sánchez Torreblanca">
        <!-- NICE-SELECT2 -->
        <script src="https://cdn.jsdelivr.net/npm/nice-select2/dist/js/nice-select2.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nice-select2/dist/css/nice-select2.min.css">
        <!-- NICE-SELECT2 -->
        <script src="./assets/js/scripts.js"></script>
        <link rel="stylesheet" href="./assets/css/style.css">
        <link rel="icon" href="./assets/icon/icon.png">
        <title>AlbertoST Informática - Games - Reportar</title>
    </head>

    <body>
        <header>
            <nav>
                <a href="./index.php"><img src="./assets/icon/icon.png"></a>
        
                <span>Menu</span>
                <ul>
                    <li><a href="./index.php">Inicio</a></li>
                    <li><a href="./games.php">Juegos</a></li>
                    <li><a id="actual" href="./report.php">Reportar</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <div class="formularios">
                <div class="formulario">
                    <h1>Reportar un Juego</h1>

                    <form action="./report.php" method="POST">
                        <div>
                            <label for="game">Nombre del Juego:</label>
                            <select class="select2" name="game" required>
                                <option selected disabled hidden>Selecciona un Juego</option>

                                <?php getListedGames(); ?>
                            </select>
                        </div>

                        <div>
                            <label for="message">Razón del reporte:</label>
                        </div>

                        <div>
                            <textarea name="message" maxlength="255"></textarea>
                        </div>

                        <div>
                            <input type="submit" name="report" value="Enviar" onclick="return confirm('¿Estás seguro de que quieres enviar este reporte?');">
                            <input type="reset" value="Cancelar">
                        </div>
                    </form>
                </div>

                <?php if (isset($_POST["report"])) reportGame(); ?>
            </div>
        </main>
    </body>
</html>