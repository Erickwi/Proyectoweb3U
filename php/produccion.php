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
if ($tipo_usuario === 'administrador') {
    // Si es administrador, redirigir a la página de administrador
    header('Location: administrador.php');
    exit();
}elseif ($tipo_usuario === 'bodeguero') {
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
  <link href="../css/sidenav.css" rel="stylesheet" type="text/css">
  <link rel="icon" href="../img/icon_logo.png" type="image/png" sizes="32x32"/>
    <link href="../css/estilo_administrador.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- SweetAlert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.js"></script>
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css"
        />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <div class="principal">
    <div class="encabezado">
        <div class="logo"><img src="../img/logo_alternativo.png"></div>
        <div class="informacion">
            <div class="nombre"><p><?php echo $nombre_usuario?></p></div>
            <div class="user-logo"><i class="fa-solid fa-user fa-2xl"></i></div>
            <div class="w3-dropdown-hover cerrarDrop">
                <button class="w3-button w3-light-gray w3-round-large cerrarDropBtn">Mi cuenta</button>
                <div class="w3-dropdown-content w3-bar-block w3-border">
                  <a id="cambiar_contraseña_btn" class="w3-bar-item w3-button">Cambiar contraseña</a>
                  <a id="cerrar_sesion_btn" class="w3-bar-item w3-button">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>
    <div class="portada-usuarios">
        <div class="principal">
      <?php 
        if($tipo_usuario == "producción"){
          include ("sidenav_produccion_module.php");
        }else{
          include ("sidenav_super_module.php");
        }
        
      ?>
 <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
          <h2>Bienvenid@ de nuevo</h2>
          <h3><?php echo $nombre_usuario?></h3>
    </div> 
    
      <script src="../js/sidenav.js"></script>
  <script src="../js/cerrarSesion.js"></script>
</body>
</html>