<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['tipo_usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../index.php');
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];
$nombre_usuario = $_SESSION['nombre_usuario'];
if ($tipo_usuario === 'admin') {
    // Si es administrador, redirigir a la página de administrador
    header('Location: administrador.php');
    exit();
}elseif ($tipo_usuario === 'bode') {
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
  <link rel="icon" href="../img/icon_logo.png" type="image/png" sizes="32x32"/>
    <link href="../css/estilo_administrador.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <!-- SweetAlert 2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.js"></script>
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css"
        />
</head>
<body>
    <div class="principal">
    <div class="encabezado">
        <div class="logo"><img src="../img/logo_alternativo.png"></div>
        <div class="informacion">
            <div class="nombre"><p><?php echo $nombre_usuario?></p></div>
            <div class="user-logo"> <img src="../img/usuario-logo.png" alt=""></div>
            <div class="cerrar" id="cerrar_sesion"><p>Cerrar Sesión</p> </div>
        </div>
    </div>
    <div class="portada-usuarios">
        <img src="../img/portada_administrador1.jpg" alt="">
    </div> 
    <div class="contenido">
        
        <div class="segundo-contenido contenido-s">
            <div id="orden_pro" class="centrado"><a href="produccion_orden.php">Orden produccion</a></div>
            <div id="orden_v" class="centrado"><a href="produccion_ver_ordenes.php">Ver orden</a></div>
            
        </div>
    </div>   
    </div>
  <script src="../js/cerrarSesion.js"></script>
</body>
</html>