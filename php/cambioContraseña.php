<?php
//Se inicia la sesion para obtener las variables de la sesion
session_start();
include('dbconnection.php');
$nuevaContraseña= $_POST["password"];
$id_usuario = intval($_SESSION['id_usuario']);
$hashedContraseña = md5($nuevaContraseña);
$query = "UPDATE usuario SET contraseña = '$hashedContraseña' WHERE id_usuario = '$id_usuario'";
$result = mysqli_query($con, $query);

if ($result) {
    // Actualización exitosa
    echo "success";
} else {
    // Error en la consulta SQL
    echo "error";
}