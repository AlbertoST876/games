<?php
/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 30-03-2022 09:11:38
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 23-05-2022 09:45:25
 * @ Description: Define la conexión con la base de datos
 */

// Rellene los siguientes campos para la conexión a su base de datos
$hostname = ""; // Servidor - Por defecto: "localhost"
$username = ""; // Usuario - Por defecto: "root"
$password = ""; // Contraseña
$database = ""; // Base de Datos - Por defecto: "es_games"

$connect = mysqli_connect($hostname, $username, $password, $database);
mysqli_set_charset($connect, "UTF8");

if (!$connect) {
    die("<p>Fallo al conectar con la Base de Datos: " . mysqli_connect_error() . "</p>");
}

?>