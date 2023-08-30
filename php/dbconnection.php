<?php
$serverName = "proyecto-web-3u.mysql.database.azure.com";
$database = "inventario";
$username = "erick_web";
$password = "proyecto_web_3";

//ZONA HORARIA
date_default_timezone_set("America/Guayaquil");
global $con;
// Crear la conexión
$con = mysqli_init();

// Verificar si la conexión será local o a Azure
if ($_SERVER['SERVER_NAME'] !== "localhost") {
    mysqli_ssl_set($con, NULL, NULL, NULL, NULL, NULL);
    mysqli_real_connect($con, $serverName, $username, $password, $database, 3306, NULL, MYSQLI_CLIENT_SSL);
} else {
    mysqli_real_connect($con, 'localhost', 'admin', 'admin', $database, 3306);
}

if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>
