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
        <link rel="icon" href="../assets/icon/icon.png">
        <title>AlbertoST Informática - Games - Administración</title>
    </head>

    <body>
        <header>
            <nav>
                <a href="./index.php"><img src="../assets/icon/icon.png"></a>

                <span>Menu</span>
                <ul>
                    <li><a href="./index.php">Inicio</a></li>
                    <li><a href="./users.php">Usuarios</a></li>
                    <li><a href="./games.php">Juegos</a></li>
                    <li><a id="actual" href="./reports.php">Reportes</a></li>

                    <li class="logout"><a href="./index.php?logout">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <h1>Atención de Reportes</h1>

            <?php if ($user -> havePermission(3)) { ?>
                <table class="admin dataTable">
                    <thead>
                        <tr>
                            <th>Juego</th>
                            <th>Problema</th>
                            <th>Reportado</th>
                            <th>Atendido Por</th>
                            <th>Atendido</th>
                            <th>Resuelto</th>
                            <?php if ($user -> havePermission(10)) echo "<th>Acciones</th>"; ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php getAllReports(); ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No tienes permiso para ver los reportes realizados, contacta con un Administrador o Usuario que tenga permisos de edición</p>
            <?php } ?>
        </main>
    </body>
</html>