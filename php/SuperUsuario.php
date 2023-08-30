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
if ($tipo_usuario === 'bodeguero') {
     //Si es administrador, redirigir a la página de administrador
    header('Location: bodeguero.php');
    exit();
}elseif ($tipo_usuario === 'producción') {
    header('Location: produccion.php');
   exit();
}elseif ($tipo_usuario === 'administrador') {
    header('Location: produccion.php');
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Usuario</title>
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
    <div class="w3-sidebar w3-bar-block" style="width:15%">
      <h3 class="w3-bar-item">Menu</h3>
      <a href="agregarUsuario.php" class="w3-bar-item w3-button">Agregar Usuario</a>
      <a href="ingreso_producto.php" class="w3-bar-item w3-button">Ingresar Productos</a>
      <div class="w3-bar-item w3-button" onclick="myAccFunc()">
  Materiales<i class="fa fa-caret-down"></i></div>
      <div id="demoAcc" class="w3-hide w3-white w3-card-4">
        <a href="bodeguero_ver_compras.php" class="w3-bar-item w3-button">Ver Materiales</a>
        <a href="bodeguero_compras.php" class="w3-bar-item w3-button">Comprar Material</a>
        <a href="bodeguero_nueva_compra.php" class="w3-bar-item w3-button">Comprar Nuevo Material</a>
      </div>
        
      <a href="produccion_orden.php" class="w3-bar-item w3-button">Orden de producción</a>
      <a href="verProductos.php" class="w3-bar-item w3-button">Ver Productos</a>
      <a href="actividadUsuario.php" class="w3-bar-item w3-button">Ver Actividad de usuarios</a>
      <a href="verUsuarios.php" class="w3-bar-item w3-button">Ver usuarios</a>
      <a href="Inventario.php" class="w3-bar-item w3-button">Ver Inventario</a>
      <a href="produccion_ver_ordenes.php" class="w3-bar-item w3-button">Ver Orden de producción</a>
    </div>
    <div class="principal" style="margin-left:15%">
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
      <script src="../js/sidenav.js"></script>
    <div class="bienvenida">
          <h2>Bienvenid@ de nuevo</h2>
          <h3><?php echo $nombre_usuario?></h3>
      <br>  <br>  <br>  <br>  <br> <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>
      </div>
    </div>  
    </div>
  <script src="../js/cerrarSesion.js"></script>
    <script>function myAccFunc() {
  var x = document.getElementById("demoAcc");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-white";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-white", "");
  }
}</script>
</body>
</html>
