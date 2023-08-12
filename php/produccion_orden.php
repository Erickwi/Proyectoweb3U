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
    <link href="../css/estilo_administrador.css" rel="stylesheet" type="text/css" />
  <link href="../css/estilo_produccion.css" rel="stylesheet" type="text/css" />
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
            <div class="cerrar" id="cerrar_sesion"><p>Cerrar Sesión</p> </div>
        </div>
    </div>
      <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
    <div class="contenido">
      <form id="formulario_orden_produccion" method="post">
        <h2>Orden de producción</h2>
        <div class="contenedor_orden">
          <div class="w3-row">
            <div class="w3-container w3-twothird">
              <label for="codigo_orden">Código de la orden</label>
              <input class="w3-input" type="text" name="codigo_orden" id="codigo_orden">
            </div>
            <div class="w3-container w3-third">
              <input class="w3-input" type="text" name="codigo_orden" id="codigo_orden" placeholder="Fecha ver">
            </div>
          </div>

          <div class="w3-row">
            <div class="w3-container w3-quarter">
               <label for="detalle_orden">Detalle</label>
               <input class="w3-input" type="text" name="detalle_orden" id="detalle_orden">
            </div>
            <div class="w3-container w3-quarter">
               <label for="cantidad_orden">Cantidad</label>
               <input class="w3-input" type="text" name="cantidad_orden" id="cantidad_orden">
            </div>
            <div class="w3-container w3-quarter">
               <label for="costo_orden">Costo</label>
               <input class="w3-input" type="text" name="costo_orden" id="costo_orden" placeholder="Costo unitario" readonly>
            </div>
          </div>

          <div class="w3-row w3-container">
            <div class="w3-col" style="width:40%"><p></p></div>
            <div class="w3-col" style="width:20%"><label for="total_orden">Total</label>
               <input class="w3-input" type="text" name="total_orden" id="total_orden" readonly>
            </div>
            <div class="w3-col" style="width:40%"><p></p></div>
          </div>
        </div>
        <input align="center" type="submit" value="Generar orden">
      <form>
    </div>  
        </div>
  <script src="../js/cerrarSesion.js"></script>
  <script src="../js/eliminar_orden_compra.js"></script>
  <script src="../js/sidenav.js"></script>
</body>
</html>