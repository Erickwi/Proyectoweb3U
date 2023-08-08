<?php
$serverName = "proyecto-web-3.mysql.database.azure.com";
$database = "inventario";
$username = "erick_web";
$password = "proyecto_web_3";

//ZONA HORARIA
date_default_timezone_set("America/Guayaquil");
global $con;
$con = mysqli_init();
mysqli_ssl_set($con, NULL, NULL,NULL, NULL, NULL);
mysqli_real_connect($con, $serverName, $username, $password, $database, 3306, NULL, MYSQLI_CLIENT_SSL);

if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

?>