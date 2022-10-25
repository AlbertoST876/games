<?php
    include "../../vendor/autoload.php";
    session_start();
    isAdminLogged();

    $user = $_SESSION["user"];

    if (!isset($_POST["gameId"])) {
        header("Location: ../games.php");
        exit();
    }
?>
<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Alberto Sánchez Torreblanca">
        <script src="../../assets/js/scripts.js"></script>
        <link rel="stylesheet" href="../../assets/css/style.css">
        <link rel="icon" href="../../assets/icon/icon.png">
        <title>AlbertoST Informática - Games - Administración</title>
    </head>

    <body>
        <header>
            <nav>
                <a href="../index.php"><img src="../../assets/icon/icon.png"></a>

                <span>Menu</span>
                <ul>
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a href="../users.php">Usuarios</a></li>
                    <li><a id="actual" href="../games.php">Juegos</a></li>
                    <li><a href="../reports.php">Reportes</a></li>

                    <li class="logout"><a href="../index.php?logout">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <h1>Editor de Juegos</h1>

            <?php
                if (isset($_POST["save"])) modifyGame();

                $gameEdit = getGameEdit();
                $gameEdit["image"] = "../." . $gameEdit["image"];
                $gameEdit["torrent"] = "../." . $gameEdit["torrent"];
            ?>

            <form class="new" action="./gamesEdit.php" method="POST" enctype="multipart/form-data">
                <?php getGamePreview($gameEdit["id"], $gameEdit["name"], $gameEdit["image"], $gameEdit["torrent"]); ?>
                <hr>

                <div>
                    <input type="checkbox" name="featured" value="T" <?php if ($gameEdit["featured"] == "T") echo "checked" ?>>
                    <label for="featured">Destacado</label>
                </div>

                <div>
                    <label for="name">Nombre del Juego:</label>
                    <input type="text" name="name" value="<?php echo $gameEdit["name"]; ?>" maxlength="50" required>
                </div>

                <div>
                    <label for="image">Cambiar Imagen:</label>
                    <input type="file" name="image" accept="image/*" size="1024">
                </div>

                <div>
                    <label for="torrent">Cambiar Torrent:</label>
                    <input type="file" name="torrent" accept=".torrent" size="1024">
                </div>

                <div>
                    <input type="hidden" name="imagePath" value="<?php echo $gameEdit["image"]; ?>">
                    <input type="hidden" name="torrentPath" value="<?php echo $gameEdit["torrent"]; ?>">
                    <input type="hidden" name="gameId" value="<?php echo $gameEdit["id"]; ?>">
                    <input type="submit" name="save" value="Guardar">
                    <input type="reset" value="Cancelar">
                </div>

                <div>
                    <a href="../games.php"><input type="button" value="Volver"></a>
                </div>
            </form>
        </main>
    </body>
</html>