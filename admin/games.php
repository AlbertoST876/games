<?php
    include "../vendor/autoload.php";
    session_start();
    isAdminLogged();

    $user = $_SESSION["user"];
?>
<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Alberto Sánchez Torreblanca">
        <!-- DATATABLE -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <script src="../assets/js/dataTables.js"></script>
        <!-- DATATABLE -->
        <script src="../assets/js/scripts.js"></script>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="icon" href="../assets/icons/icon.png">
        <title>AlbertoST Informática - Games - Administración</title>
    </head>

    <body>
        <header>
            <nav>
                <a href="./index.php"><img src="../assets/icons/icon.png"></a>

                <span>Menu</span>
                <ul>
                    <li><a href="./index.php">Inicio</a></li>
                    <li><a href="./users.php">Usuarios</a></li>
                    <li><a id="actual" href="./games.php">Juegos</a></li>
                    <li><a href="./reports.php">Reportes</a></li>

                    <li class="logout"><a href="./index.php?logout">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <h1>Gestión de Juegos</h1>

            <?php if ($user -> havePermission(5)) { ?>
                <details>
                    <summary><img class="add" src="../assets/icons/plus.svg"></summary>

                    <form class="new" action="./games.php" method="POST" enctype="multipart/form-data">
                        <div>
                            <label for="name">Nombre del Juego:</label>
                            <input type="text" name="name" maxlength="50" required>
                        </div>

                        <div>
                            <label for="image">Imagen del Juego:</label>
                            <input type="file" name="image" accept="image/*" size="1024" required>
                        </div>

                        <div>
                            <label for="torrent">Torrent del Juego:</label>
                            <input type="file" name="torrent" accept=".torrent" size="1024" required>
                        </div>

                        <div>
                            <input type="submit" name="add" value="Agregar">
                            <input type="reset" value="Cancelar">
                        </div>
                    </form>
                </details>
            <?php } ?>

            <?php 
                if ($user -> havePermission(5) && isset($_POST["add"])) addGame();
                if ($user -> havePermission(9) && isset($_POST["delete"])) deleteGame();
            ?>

            <?php if ($user -> havePermission(2)) { ?>
                <table class="admin dataTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Ruta Imagen</th>
                            <th>Ruta Torrent</th>
                            <th>Destacado</th>
                            <th>Editado Por</th>
                            <th>Ultima Edición</th>
                            <th>Creado Por</th>
                            <th>Registrado</th>
                            <?php if ($user -> havePermission(7) || $user -> havePermission(9)) echo "<th>Acciones</th>"; ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php getAllGames(); ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No tienes permiso para ver la lista de juegos, contacta con un Administrador o Usuario que tenga permisos de edición</p>
            <?php } ?>
        </main>
    </body>
</html>