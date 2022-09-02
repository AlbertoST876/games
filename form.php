
<?php include "./src/functions.php"; ?>
<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Alberto Sánchez Torreblanca">
        <!-- SELECT2 -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.full.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
        <script src="./assets/js/select2.js"></script>
        <!-- SELECT2 -->
        <script src="./assets/js/scripts.js"></script>
        <link rel="stylesheet" href="./assets/css/style.css">
        <link rel="icon" href="./assets/icon.png">
        <title>AlbertoST Informática - Games - Agregar/Reportar</title>
    </head>

    <body>
        <header>
            <nav>
                <a href="./index.php"><img src="./assets/icon.png"></a>
        
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
                        <select name="juego" id="juego" class="select2" required>
                            <option value="" selected disabled hidden>Selecciona un Juego</option>

                            <?php obtenerListaJuegos(); ?>
                        </select>

                        <br/>

                        <label for="mensaje">¿Por que quieres reportar este juego?</label> <br/>
                        <input type="text" name="mensaje" id="mensaje" required>

                        <br/>

                        <input type="submit" name="report" value="Enviar"><input type="reset" value="Resetear">
                    </form>
                </div>

                <?php 
                    if (isset($_POST["upload"])) subirJuego($_POST["juego"], $_FILES["imagen"], $_FILES["torrent"]);
                    if (isset($_POST["report"])) reportarJuego($_POST["juego"], $_POST["mensaje"]);
                ?>
            </div>
        </main>
    </body>
</html>