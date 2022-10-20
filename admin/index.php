<?php
    include "../vendor/autoload.php";
    session_start();

    if (isset($_GET["logout"])) logout();
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
            </nav>
        </header>

        <main>
            <h1 class="destacados">Iniciar Sesión</h1>

            <div class="login">
                <form action="./index.php" method="POST">
                    <div>
                        <label for="username">Nombre de Usuario:</label>
                    </div>

                    <div>
                        <input type="text" name="username" maxlength="25" required>
                    </div>

                    <div>
                        <label for="password">Contraseña:</label>
                    </div>

                    <div>
                        <input type="password" name="password" required>
                    </div>

                    <div>
                        <input type="submit" name="login" value="Iniciar Sesión">
                        <input type="reset" value="Cancelar">
                    </div>
                </form>

                <?php
                    if (isset($_POST["login"])) $_SESSION["user"] = login();
                    if (isLogin()) haveRestorePassword();
                ?>
            </div>
        </main>
    </body>
</html>