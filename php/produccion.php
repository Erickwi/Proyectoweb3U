<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../index.php');
    exit();
}

  $usuario = $_SESSION['usuario'];
if ($usuario === 'admin') {
    // Si es administrador, redirigir a la página de administrador
    header('Location: administrador.php');
    exit();
}elseif ($usuario === 'bode') {
    header('Location: bodeguero.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produccion</title>
    <link href="../css/estilo_administrador.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="principal">
    <div class="encabezado">
        <div class="logo"><img src="../img/LOGO1.png"></div>
        <div class="informacion">
            <div class="nombre"><p>Nombre del usuario</p></div>
            <div class="user-logo"> <img src="../img/usuario-logo.png" alt=""></div>
            <div class="cerrar"> <p> <a href="logout.php">Cerrar Sesión</a></p></div>
        </div>
    </div>
    <div class="portada-usuarios">
        <img src="../img/portada_administrador1.jpg" alt="">
    </div> 
    <div class="contenido">
        
        <div class="segundo-contenido contenido-s">
            <div id="orden_pro"> <p>Orden produccion</p></div>
            <div id="orden_v"><p>Ver orden</p></div>
            
        </div>
    </div>   
    </div>
    
</body>
</html>