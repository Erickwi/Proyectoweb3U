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
}


?>

<!DOCTYPE html>
<html lang="en">
<head>


 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ver Productos</title>
    <link rel="icon" href="../img/icon_logo.png" type="image/png" sizes="32x32"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="css/estilo.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href="../css/estilo_administrador.css" rel="stylesheet" type="text/css" />
    <link href="../css/sidenav.css" rel="stylesheet" type="text/css" />
    <link href="../css/estiloBuscarCed.css" rel="stylesheet" type="text/css" />
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

  
 
  <link href="../css/productos.css" rel="stylesheet" type="text/css" />
    
</head>
<body>
  <?php
    include "sidenav_admin_module.php"
  ?>

    
      <main id="main">
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
    </div> </main>  
    </div>
  <div class="contenido">
          <h1 align="center">Ver Productos</h1>
        <form method="post" id="formulario_ver_productos">
            <button class="w3-btn w3-round-large w3-blue" type="submit" name="buscar" id="buscar_producto_btn">Buscar</button>
          <input type="number" id="codigo_buscar_p" name="codigo_buscar_p" placeholder="Ingrese el codigo de la orden" style="width:250px;">
          <button class="w3-btn w3-round-large w3-red" name="restablecer" id="restablecer_pro_btn" disabled>Restablecer</button>
        </form><br>
        <div class="w3-responsive">
          <table class="w3-table-all">
            <thead>
              <tr class="w3-light-grey">
                <th>Código</th>
                <th>Nombre</th>
                <th>Foto</th>

              </tr>
            </thead>
            <tbody id="tabla_body_productos">
              <?php  
               
                include('dbconnection.php');
                  $query = "SELECT * From productos;"; 
                  $productos = mysqli_query($con, $query);
                  if (mysqli_num_rows($productos) == 0) {
                    echo '<tr><th style="text-align:center; color:red;" colspan="6">No se han encontrado registros.</th></tr>';
                  } else {
                      while ($row = mysqli_fetch_assoc($productos)) {
                         echo '<tr>';
                          echo '<td>' . $row['codigo_productos'] . '</td>';
                          echo '<td>' . $row['nombre_productos'] . '</td>';
                          echo '<td><img src="' . $row['foto_producto'] . '"></td>';


                          echo '</tr>';
                      }
                  }
                ?>
            </tbody>
          </table>
        </div> 
      </div>  

<script>
$('#buscar_producto_btn').click(function(e) {
  alert('HolasP')
  e.preventDefault();
  var codigoBuscar = $('#codigo_buscar_p').val();
  // Validar que la entrada sea un número entero
    if (!/^\d{5}$/.test(codigoBuscar)) {
      // Mostrar una alerta SweetAlert
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Ingresa un número entero',
      });
      $("input[type='text']").val("");
      return; // Detener el proceso si la entrada es inválida
    }
  $.ajax({
    type: 'POST',
    url: '../php/cargar_productos.php',
    data: { codigo_buscar: codigoBuscar },
    success: function(response) {
      $('#tabla_body_productos').html(response);
    }
  });
  $("#restablecer_pro_btn").removeAttr("disabled");
});
</script>
  
  <script src="../js/acciones_bodeguero.js"></script>
    <script src="../js/sidenav.js"></script>
   
  
</body>
</html>