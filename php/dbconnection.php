<?php

$serverName = getenv('DB_SERVER');
$port = getenv('DB_PORT');
$database = getenv('DB_NAME');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');

// ZONA HORARIA
date_default_timezone_set("America/Guayaquil");

global $con;

// Crear la conexión usando mysqli_real_connect con el puerto especificado
// Aquí se conecta directamente, sin la lógica condicional de 'localhost' o SSL
$con = mysqli_init();

// Intenta establecer la conexión
if (!mysqli_real_connect($con, $serverName, $username, $password, $database, $port)) {
    // Si falla, imprime el error y detiene la ejecución
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Opcional: Establecer el juego de caracteres a UTF-8 para evitar problemas con tildes/ñ
mysqli_set_charset($con, "utf8mb4");

// Si la conexión es exitosa, $con ahora contiene el recurso de conexión.
// Puedes usar $con para ejecutar consultas SQL.

// Ejemplo de uso (opcional):
// echo "Conexión exitosa a la base de datos '$database'.";

?>