<?php
$serverName = getenv('DB_SERVER') ?: 'localhost';
$port = getenv('DB_PORT') ?: '3306';
$database = getenv('DB_NAME') ?: 'inventario';
$username = getenv('DB_USER') ?: 'admin';
$password = getenv('DB_PASS') ?: 'admin';

date_default_timezone_set("America/Guayaquil");

$con = mysqli_init();

if ($serverName === 'localhost' || $serverName === '127.0.0.1') {
    mysqli_real_connect($con, 'localhost', $username, $password, $database, intval($port));
} else {
    mysqli_real_connect($con, $serverName, $username, $password, $database, intval($port));
}

if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

mysqli_set_charset($con, "utf8mb4");
?>
