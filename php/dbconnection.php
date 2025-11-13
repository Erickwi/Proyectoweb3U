<?php
// Lee las variables inyectadas por EasyPanel
$serverName = getenv('DB_SERVER');
$port = getenv('DB_PORT');
$database = getenv('DB_NAME');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');

// Asegúrate de que las variables se lean correctamente
if (!$serverName || !$username || !$password) {
    die("Error: Las variables de entorno de la base de datos no están configuradas.");
}

// ZONA HORARIA
date_default_timezone_set("America/Guayaquil");

global $con;

$con = mysqli_init();

// Intenta establecer la conexión
if (!mysqli_real_connect($con, $serverName, $username, $password, $database, $port)) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

mysqli_set_charset($con, "utf8mb4");

?>