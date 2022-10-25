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
                    <li><a href="../games.php">Juegos</a></li>
                    <li><a id="actual" href="../reports.php">Reportes</a></li>

                    <li class="logout"><a href="../index.php?logout">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <h1>Editor de Reportes</h1>

            <?php
                if (isset($_POST["save"])) modifyReport();

                $reportEdit = getReportEdit();
            ?>

            <form class="new" action="./reportsEdit.php" method="POST">
                <h2><?php echo $reportEdit["game"]; ?></h2>
                <p><?php echo $reportEdit["message"]; ?></p>
                <hr>

                <div>
                    <input type="checkbox" name="attended" <?php if (!is_null($reportEdit["attendedBy"])) echo "checked" ?>>
                    <label for="resolved">Atendido</label>
                </div>

                <div>
                    <input type="checkbox" name="resolved" value="T" <?php if ($reportEdit["resolved"] == "T") echo "checked" ?>>
                    <label for="resolved">Resuelto</label>
                </div>

                <div>
                    <input type="hidden" name="reportId" value="<?php echo $reportEdit["id"]; ?>">
                    <input type="submit" name="save" value="Guardar">
                    <input type="reset" value="Cancelar">
                </div>

                <div>
                    <a href="../reports.php"><input type="button" value="Volver"></a>
                </div>
            </form>
        </main>
    </body>
</html>