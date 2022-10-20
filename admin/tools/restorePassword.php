<?php
    include "../../vendor/autoload.php";
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
        <script src="../../assets/js/scripts.js"></script>
        <link rel="stylesheet" href="../../assets/css/style.css">
        <link rel="icon" href="../../assets/icons/icon.png">
        <title>AlbertoST Informática - Games - Administración</title>
    </head>

    <body>
        <header>
            <nav>
                <a href="../index.php"><img src="../../assets/icons/icon.png"></a>
            </nav>
        </header>

        <main>
            <h1 class="destacados">Restablecer contraseña</h1>

            <div class="login">
                <form action="./restorePassword.php" method="POST">
                    <div>
                        <label for="newPassword1">Nueva contraseña:</label>
                    </div>

                    <div>
                        <input type="password" name="newPassword1" maxlength="255" required>
                    </div>

                    <div>
                        <label for="newPassword2">Nueva contraseña repetida:</label>
                    </div>

                    <div>
                        <input type="password" name="newPassword2" required>
                    </div>

                    <div>
                        <input type="submit" name="restorePassword" value="Cambiar contraseña">
                        <input type="reset" value="Cancelar">
                    </div>
                </form>

                <?php
                    if (isset($_POST["restorePassword"])) {
                        restorePassword();
                        
                        header("Location: ../home.php");
                        exit();
                    }
                ?>
            </div>
        </main>
    </body>
</html>