<!DOCTYPE html>

<html lang="es">
    <head>
        <?php include "./modules/html/head.php"; ?>

        <title>Games - Agregar/Reportar</title>
    </head>

    <body>
        <header>
            <nav>
                <a href="./index.php"><img src="./resources/icon.png"></a>
        
                <span>Menu</span>
                <ul>
                    <li><a href="./index.php">Inicio</a></li>
                    <li><a href="./games.php">Juegos</a></li>
                    <li><a id="actual" href="./form.php">Agregar / Reportar Juego</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <div class="formularios">
                <div class="formulario">
                    <h1>Agregar un Juego</h1>

                    <form action="form.php" method="POST" enctype="multipart/form-data">
                        <label for="juego">Nombre del Juego:</label>
                        <input type="text" name="juego" id="juego" required>
                            
                        <br/>

                        <label for="imagen">Imagen del Juego:</label>
                        <input type="file" name="imagen" id="imagen" accept="image/*" size="1024" required>

                        <br/>
                            
                        <label for="torrent">Torrent del Juego:</label>
                        <input type="file" name="torrent" id="torrent" accept=".torrent" size="1024" required>

                        <br/>

                        <input type="submit" name="upload" value="Enviar"><input type="reset" value="Resetear">
                    </form>
                </div>

                <div class="formulario">
                    <h1>Reportar un Juego</h1>

                    <form action="form.php" method="POST">
                        <label for="juego">Nombre del Juego:</label>
                        <select name="juego" id="juego" required>
                            <option value="" selected disabled hidden>Selecciona un Juego</option>

                            <?php ObtenerListaJuegos(); ?>
                        </select>

                        <br/>

                        <label for="mensaje">¿Por que quieres reportar este juego?</label> <br/>
                        <input type="text" name="mensaje" id="mensaje" required>

                        <br/>

                        <input type="submit" name="report" value="Enviar"><input type="reset" value="Resetear">
                    </form>
                </div>

                <?php 
                    if (isset($_POST["upload"])) SubirJuego($_POST["juego"], $_FILES["imagen"], $_FILES["torrent"]);
                    if (isset($_POST["report"])) ReportarJuego($_POST["juego"], $_POST["mensaje"]);
                ?>
            </div>
        </main>
    </body>
</html>