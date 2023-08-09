<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../index.php');
    exit();
}
$usuario = $_SESSION['usuario'];
if ($usuario == 'bodeguero') {
     //Si es administrador, redirigir a la página de administrador
    header('Location: bodeguero.php');
    exit();
}elseif ($usuario == 'producción') {
    header('Location: produccion.php');
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link href="../css/estilo_administrador.css" rel="stylesheet" type="text/css" />
  <link href="../css/sidenav.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <?php
    include "sidenav_admin_module.php"
  ?>

    <div class="principal">
      <main id="main">
    <div class="encabezado">
        <div class="logo"><img src="../img/LOGO1.png"></div>
        <div class="informacion">
            <div class="nombre"><p>Nombre del usuario</p></div>
            <div class="user-logo"> <img src="../img/usuario-logo.png" alt=""></div>
            <div class="cerrar"><p> <a href="logout.php">Cerrar Sesión</a></p> </div>
        </div>
    </div>
      
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menú</span>
    <div class="portada-usuarios">
        <img src="../img/portada_administrador1.jpg" alt="">
    </div> 
    <div class="contenido">
        <div class="primer-contenido">
            <div id="agregar"><p>Agregar Usario</p></div>
            <div id="reporte"><p>Ver reporte</p></div>
            <div id="usuario"><p>Ver usuario</p></div>
            <div id="actividad_usuario"><p>Ver actividad de<br>usuario</p></div>
        </div>
        <div class="segundo-contenido">
            <div id="editar_orden"> <p>Editar Orden de<br>produccion</p></div>
            <div id="editar_compra"><p>Editar Compra</p></div>
            
        </div>
    </div> </main>  
    </div>
    <script src="../js/sidenav.js"></script>
</body>
</html>


