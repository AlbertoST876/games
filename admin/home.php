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
                    <li><a id="actual" href="./index.php">Inicio</a></li>
                    <li><a href="./users.php">Usuarios</a></li>
                    <li><a href="./games.php">Juegos</a></li>
                    <li><a href="./reports.php">Reportes</a></li>

                    <li class="logout"><a href="./index.php?logout">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <h1>Bienvenido <?php echo ucfirst($user -> getName()); ?></h1>
        </main>
    </body>
</html>