<?php
session_start();
include('dbconnection.php');
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
}elseif ($tipo_usuario === 'bodeguero.php') {
    header('Location: bodeguero.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver ordenes</title>
  <link rel="icon" href="../img/icon_logo.png" type="image/png" sizes="32x32"/>
    <link href="../css/estilo_administrador.css" rel="stylesheet" type="text/css" />
  <link href="../css/sidenav.css" rel="stylesheet" type="text/css">
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
  <style>
    .contenido{
      width:80%;
      margin:auto;
    }
  </style>
</head>
<body>
    <div class="principal">
      <?php 
        include "sidenav_produccion_module.php"
      ?>
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
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
      <div class="contenido">
          <h1 align="center">Ver Ordenes</h1>
        <form method="post" id="formulario_ver_compras">
            <button class="w3-btn w3-round-large w3-blue" type="submit" name="buscar" id="buscar_orden_btn">Buscar</button>
          <input type="text" id="codigo_buscar" name="codigo_buscar" placeholder="Ingrese el código del producto" style="width:250px;">
          <button class="w3-btn w3-round-large w3-red" name="restablecer" id="restablecer_orden_btn" disabled>Restablecer</button>
        </form><br>
        <div class="w3-responsive">
          <table class="w3-table-all">
            <thead>
              <tr class="w3-light-grey">
                <th>Código</th>
                <th>Fecha</th>
                <th>Detalle</th>
                <th>Total</th>
                <th>Usuario</th>

              </tr>
            </thead>
            <tbody id="tabla_body_ordenes">
            </tbody>
          </table>
        </div> 
      </div>  
    </div>
  <script src="../js/cerrarSesion.js"></script>
  <script src="../js/sidenav.js"></script>
  <script src="../js/acciones_bodeguero.js"></script>
</body>
</html>