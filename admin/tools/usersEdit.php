<?php
    include "../../vendor/autoload.php";
    session_start();
    isAdminLogged();

    $user = $_SESSION["user"];

    if (!isset($_POST["userId"])) {
        header("Location: ../users.php");
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
                    <li><a id="actual" href="../users.php">Usuarios</a></li>
                    <li><a href="../games.php">Juegos</a></li>
                    <li><a href="../reports.php">Reportes</a></li>

                    <li class="logout"><a href="../index.php?logout">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <h1>Editor de Usuarios</h1>

            <?php
                if (isset($_POST["save"])) modifyUser();

                $userEdit = getUserEdit();
            ?>

            <form class="new" action="./usersEdit.php" method="POST">
                <h2><?php echo $userEdit["username"]; ?></h2>
                <hr>

                <div>
                    <label for="username">Nombre de Usuario:</label>
                    <input type="text" name="username" value="<?php echo $userEdit["username"]; ?>" maxlength="25" required>
                </div>

                <div>
                    <input type="checkbox" name="restorePassword" value="T" <?php if ($userEdit["restorePassword"] == "T") echo "checked" ?>>
                    <label for="newPassword">Nueva Contraseña:</label>
                    <input type="password" name="newPassword" maxlength="255" autocomplete="false" readonly onfocus="this.removeAttribute('readonly');">
                </div>

                <div>
                    <label for="permissions">Permisos:</label>
                    <?php getUserEditPermissions(); ?>
                </div>

                <div>
                    <input type="hidden" name="userId" value="<?php echo $userEdit["id"]; ?>">
                    <input type="submit" name="save" value="Guardar" onclick="return confirm('¿Estás seguro de que quieres editar este usuario?');">
                    <input type="reset" value="Cancelar">
                </div>

                <div>
                    <a href="../users.php"><input type="button" value="Volver"></a>
                </div>
            </form>
        </main>
    </body>
</html>