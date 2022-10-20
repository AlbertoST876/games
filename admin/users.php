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
                    <li><a id="actual" href="./users.php">Usuarios</a></li>
                    <li><a href="./games.php">Juegos</a></li>
                    <li><a href="./reports.php">Reportes</a></li>

                    <li class="logout"><a href="./index.php?logout">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <h1>Gestión de Usuarios</h1>

            <?php if ($user -> havePermission(4)) { ?>
                <details>
                    <summary><img class="add" src="../assets/icons/plus.svg"></summary>

                    <form class="new" action="./users.php" method="POST">
                        <div>
                            <label for="username">Nombre de Usuario:</label>
                            <input type="text" name="username" maxlength="25" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" required>
                        </div>
                        
                        <div>
                            <label for="password">Contraseña (Temporal):</label>
                            <input type="password" name="password" maxlength="255" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" required>
                        </div>
                        
                        <div>
                            <label for="permissions">Permisos:</label>
                            <?php getListedPermissions(); ?>
                        </div>
                        
                        <div>
                            <input type="submit" name="add" value="Agregar">
                            <input type="reset" value="Cancelar">
                        </div>
                    </form>
                </details>
            <?php } ?>

            <?php
                if ($user -> havePermission(4) && isset($_POST["add"])) addUser();
                if ($user -> havePermission(8) && isset($_POST["delete"])) deleteUser();
            ?>

            <?php if ($user -> havePermission(1)) { ?>
                <table class="admin dataTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Ultimo Cambio de Contraseña</th>
                            <th>Ultimo Acceso</th>
                            <th>Editado Por</th>
                            <th>Ultima Edición</th>
                            <th>Creado Por</th>
                            <th>Registrado</th>
                            <?php if ($user -> havePermission(6) || $user -> havePermission(8)) echo "<th>Acciones</th>"; ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php getAllUsers(); ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No tienes permiso para ver la lista de usuarios, contacta con un Administrador o Usuario que tenga permisos de edición</p>
            <?php } ?>
        </main>
    </body>
</html>