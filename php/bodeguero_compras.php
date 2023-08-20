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
}elseif ($tipo_usuario === 'producción') {
    header('Location: produccion.php');
    exit();
}

include('consultasBodeguero/agregarMaterial.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacer compras</title>
  <link rel="icon" href="../img/icon_logo.png" type="image/png" sizes="32x32"/>
   <link href="../css/estilo_bodeguero.css" rel="stylesheet" type="text/css" />
    <link href="../css/estilo_administrador.css" rel="stylesheet" type="text/css" />
  
  <link href="../css/sidenav.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        include "sidenav_bodeguero_module.php"
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
      <div class="contenido-orden">
          <form id="formulario_compras" method="post" class="formulario">
          <h2 class="titulo_compras">Compras</h2>
            <div class="contenedor_orden">
              <div class="w3-row codigo_compras">
                <div class="w3-container w3-third">
                  <label for="codigo_compra_opcion">Material</label>
                  <select class="w3-select" name="material_compra_opcion" id="material_compra_opcion">
                    <option value="" disabled selected>Seleccione un material</option>
                    <?php 
                      $codigoMaterial=mysqli_query($con,"select * from materiales");
                      while( $row=mysqli_fetch_array($codigoMaterial)){
                          $id=$row['id_materiales'];
                          $nombreMaterial=$row['nombre_material'];
                          
                          echo '<option value="' . $id . '">' . $nombreMaterial . '</option>';

                      }
                      ?>
                    <option value="nuevo_material" >Añadir un nuevo material</option>
                  </select>
                    <label class="w3-hide nombre_compra" for="nombre_compra">Nombre material</label>
                    <input class="w3-input w3-hide nombre_compra" type="text" name="nombre_compra" id="nombre_compra" placeholder="Ingrese el nombre del material">
                </div>
                <div class="w3-container w3-third">
                  <label for="codigo_compra">Código del producto</label>
                  <input class="w3-input" type="text" name="codigo_compra" id="codigo_compra" placeholder="Ej. 123876" readonly disabled>
                </div>
                <div class="w3-container w3-third">
                  <label for="fecha_compra">Fecha y hora</label>
                  <input class="w3-input" type="text" name="fecha_compra" id="fecha_compra" placeholder="" readonly>
                </div>
              </div>
    
              <div class="w3-row">
                <div class="w3-container w3-quarter">
                  <label for="costo_compra">Costo</label>
                  <input class="w3-input costo_compra" type="text" name="costo_compra" placeholder="$0.00" readonly disabled>
                </div>
                <div class="w3-container w3-quarter">
                  <label for="cantidad_compra">Cantidad</label>
                  <input class="w3-input cantidad_compra" type="text" name="cantidad_compra" placeholder="0" disabled>
                </div>
                <div class="w3-container w3-quarter button_container w3-center">
                  <button class="w3-btn w3-green w3-round-large aumentar_cantidad" disabled>+</button>
                  <button class="w3-btn w3-red w3-round-large disminuir_cantidad" disabled>-</button>
                </div>
                <div class="w3-container w3-quarter">
                  <label for="total_compra">Total</label>
                   <input class="w3-input" type="text" name="total_compra" id="total_compra" readonly disabled placeholder="$0.00">
                </div>
              </div>
            </div>
          <input align="center" type="submit" value="Comprar producto" class="w3-btn w3-show guardar_btn" id="guardar_btn" disabled>
            <input align="center" type="submit" value="Añadir Producto" class="w3-btn w3-blue w3-hide producto_btn">
          <form>
        </div>
    </div>  
            <div class="loading-spinner">
    <i class="fas fa-spinner fa-spin"></i> Cargando...
</div>
  <script src="../js/cerrarSesion.js"></script>
  <script src="../js/horaYFecha.js"></script>
  <script src="../js/acciones_bodeguero.js"></script>
  <script src="../js/sidenav.js"></script>
</body>
</html>