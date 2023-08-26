<?php
include('dbconnection.php');
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['tipo_usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../index.php');
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];
$nombre_usuario = $_SESSION['nombre_usuario'];

  $nombre_usuario = $_SESSION['nombre_usuario'];
  $query = "SELECT id_usuario from usuario where nombre = '$nombre_usuario'";
  $getP1 = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($getP1);

  //se cambia a entero el id del usuario
  $idUsuario = $row["id_usuario"];
if ($tipo_usuario === 'administrador') {
    // Si es administrador, redirigir a la página de administrador
    header('Location: administrador.php');
    exit();
}elseif ($tipo_usuario === 'bodeguero') {
    header('Location: bodeguero.php');
    exit();
}



///////////////////////////7777

  
  //Databse Connection file

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de producción</title>
    <link rel="icon" href="../img/icon_logo.png" type="image/png" sizes="32x32"/>
   <link href="../css/estilo_orden_p.css" rel="stylesheet" type="text/css" />
    <link href="../css/estilo_administrador.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
      <div class="contenido-informacion-orden">
      <div class="contenido-orden"> 
         <form method="post" id="ordenProduccionForm" >
          <h1>Orden de produccion</h1>
            
           
          
          <div class="informacion-orden"> 
            <div class="codigos-orden">
              <label for="codigo_orden">Código de la orden</label><br />
              <input
                class="ocultar"
                type="text"
                name="id_usuario"
                id="id_usuario"
                value="<?php echo $idUsuario;?>"
              />
              <input
                class="w3-input"
                type="number"
                name="codigo_orden1"
                id="codigo_orden1"
                
              />
             
            </div>
            <div class="extra-orden">
              <br />
              <input
                class="w3-input"
                type="text"
                name="fecha_orden"
                id="fecha_compra" 
                placeholder=""
                readonly
              />
            </div>
          </div>
          
           <div class="informacion-orden">
             <div class="informacion-orden informacion-orden1"> 
            <div class="codigos-orden">
              <label for="codigo_material">Productos</label>
             
             <select name="productos" id="productos">
               <option value="">Selecciona el producto</option>
                <?php  
                include('dbconnection.php');
                $getProducto ="select * from productos order by nombre_productos";
                $getProducto1=mysqli_query($con,$getProducto);
                while( $row=mysqli_fetch_array($getProducto1)){
                    $id=$row['id_productos'];
                    $codigo_productos=$row['codigo_productos'];
                    $nombre_productos=$row['nombre_productos'];
                    $activo_producto=$row['activo_producto'];
                    ?>
                    <option value="<?php echo $id; ?>"> <?php echo $nombre_productos ?> </option>
                    <?php
                }
                
                ?>
        
            </select>
             
              </div>
               <div class="costo-material"> <label for="cantidad">Cantidad</label><br><input
                class="w3-input"
                type="number"
                name="cantidad_producto1"
                id="cantidad_producto1" 
                placeholder=""
                min=1 
              /></div>
            </div>
            <div class="extra-orden margen-extra">              
              <br>
  <button class="w3-btn w3-round-large w3-blue" type="button" id="submitInfoBtn">Ver</button>
  <button class="w3-btn w3-round-large w3-blue" type="button" id="submitOrdenBtn" name="submitOrdenBtn">Agregar</button>
              
            </div>
          </div>
         
<div id="informacionORDEN"> </div>
          

        </form></div>


        
    <div class="contenido-orden">
        <form method="post" id="informacionProductoForm">
  </form>     
  </div>  
      </div>
        </div>
          <script>
$(document).ready(function() {
  $('#submitOrdenBtn').click(function() {
    $.ajax({
      type: 'POST',
      url: 'muestraproducto.php', // Replace with the actual PHP script URL for Orden de producción
      data: $('#ordenProduccionForm').serialize(),
      success: function(response) {
       $('#informacionORDEN').html(response);
        // Handle response or update UI here
      },
      error: function() {
        alert('An error occurred while submitting Orden de producción data.');
      }
    });
  });

  $('#submitInfoBtn').click(function() {
    $.ajax({
      type: 'POST',
      url: 'produccion_orden (copy).php', // Replace with the actual PHP script URL for informacion-producto
      data: $('#ordenProduccionForm').serialize(),
      success: function(response) {
        $('#informacionProductoForm').html(response);
        // Handle response or update UI here
      },
      error: function() {
        alert('An error occurred while submitting Informacion producto data.');
      }
    });
  });
});
</script>





          
  <script src="../js/cerrarSesion.js"></script>
  <script src="../js/horaYFecha.js"></script>
  <script src="../js/eliminar_orden_compra.js"></script>
  <script src="../js/sidenav.js"></script>
</body>
</html>