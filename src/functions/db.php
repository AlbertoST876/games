<?php

// Rellene los siguientes campos para la conexión a su base de datos
$hostname = "localhost"; // Servidor - Por defecto: "localhost"
$username = "root"; // Usuario - Por defecto: "root"
$password = ""; // Contraseña
$database = "es_games"; // Base de Datos - Por defecto: "es_games"

$connect = mysqli_connect($hostname, $username, $password, $database);
mysqli_set_charset($connect, "UTF8");

if (!$connect) {
    echo "<p>Fallo al conectar con la Base de Datos: " . mysqli_connect_error() . "</p>";
    exit();
}

?>