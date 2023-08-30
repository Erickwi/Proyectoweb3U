<?php
session_start();
include("dbconnection.php");
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Inventario</title>
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
        if($tipo_usuario === "administrador"){
          include ("sidenav_admin_module.php");
        }else{
          include ("sidenav_super_module.php");
        }
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
          <h1 align="center">Ver Inventario</h1>
        <form method="post" id="formulario_ver_inventario">
            <button class="w3-btn w3-round-large w3-blue" type="submit" name="buscar" id="buscar_inventario_btn">Buscar</button>
          <input type="text" id="nombre_buscar_material" name="nombre_buscar_material" placeholder="Ingrese el material a buscar" style="width:250px;">
          <button class="w3-btn w3-round-large w3-green" name="primerIngreso" id="primer_ingreso_btn">Ver Inventario Inicial</button>
          <button class="w3-btn w3-round-large w3-red" name="restablecer" id="restablecer_inventario_btn" disabled>Restablecer</button>
        </form><br>
        <div class="w3-responsive">
          <table class="w3-table-all">
            <thead>
              <tr class="w3-light-grey">
				<th>Id</th>
                <th>Código</th>
                <th>Fecha y hora</th>
                <th>Detalle</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Precio total</th>
                <th>Tipo de proceso</th>
                <th>Usuario responsable</th>
              </tr>
            </thead>
            <tbody id="tabla_body_inventario">
            </tbody>
          </table>
        </div> 
      </div>  
    </div>
  <script src="../js/cerrarSesion.js"></script>
  <script src="../js/verInventario.js"></script>
  <script src="../js/sidenav.js"></script>
</body>
</html>