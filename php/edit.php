<?php

session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['tipo_usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../index.php');
    exit();
}

$nombre_usuario = $_SESSION['nombre_usuario'];
$tipo_usuario = $_SESSION['tipo_usuario'];
if ($tipo_usuario === 'bodeguero') {
     //Si es administrador, redirigir a la página de administrador
    header('Location: bodeguero.php');
    exit();
}elseif ($tipo_usuario === 'producción') {
    header('Location: produccion.php');
   exit();
}
//database connection file
include('dbconnection.php');
if(isset($_POST['submit']))
  {
  	$eid=$_GET['editid'];
  	//Getting Post Values
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $user=$_POST['usuario'];
    $contraseña=$_POST['contraseña'];
    $tipo=$_POST['tipo_usuario'];

    // Set the time zone to America/Guayaquil
    date_default_timezone_set('America/Guayaquil');
    $fecha_actual = date('Y-m-d H:i:s');

    //Query for data updation
     $query=mysqli_query($con, "update  usuario set nombre='$nombre',apellido='$apellido', usuario='$user', contraseña='$contraseña', tipo_usuario='$tipo', fecha='$fecha_actual' where id_usuario='$eid'");
     
    if ($query) {
    echo "<script>alert('Tus datos han sido actualizados correctamente');</script>";
    echo "<script type='text/javascript'> document.location ='verUsuarios.php'; </script>";
  }
  else
    {
      echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
  <title>Editar Usuario</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="../css/estilo_2.css" rel="stylesheet" type="text/css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <link href="../css/estilo_administrador.css" rel="stylesheet" type="text/css" />
  <link href="../css/sidenav.css" rel="stylesheet" type="text/css" />
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
      .btn-custom-orange {
    background-color: #ff8c00; /* Color naranja personalizado */
    border-color: #ff8c00; /* Color del borde */
    color: white; /* Color del texto */
}
    </style>
</head>
<body>
  <?php
        if($tipo_usuario === "administrador"){
          include ("sidenav_admin_module.php");
        }else{
          include ("sidenav_super_module.php");
        }
  ?>

    <div class="principal">
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
    </main>  
    </div> 
<div class="signup-form">
    <form  method="POST">
 <?php
$eid=$_GET['editid'];
$ret=mysqli_query($con,"select * from usuario where id_usuario='$eid'");
while ($row=mysqli_fetch_array($ret)) {
?>
		<h2>Editar</h2>
		<p class="hint-text">Actualización de Información</p>
        <div class="form-group">
			<div class="row">
				<div class="col">
          <label for="nombre">Actualizar Nombre</label>
          <input type="text" class="form-control" name="nombre" value="<?php  echo $row['nombre'];?>" required="true"></div>
				<div class="col">
          <label for="nombre">Actualizar Apellido</label>
          <input type="text" class="form-control" name="apellido" value="<?php  echo $row['apellido'];?>" required="true"></div>
			  </div>        	
      </div>
      <div class="row">
        <div class="col"><center>
            <label for="nombre">Nuevo Usuario</label>
            <input type="text" class="form-control" name="usuario" value="<?php  echo $row['usuario'];?>" required="true" maxlength="10">
</center></div>
        
      </div><br><center>
        <div class="form-group">
        <label for="tipo">Seleccione el Nuevo Tipo Usuario:</label>
        <select name="tipo_usuario" id="tipo_usuario" required="true">
          <option value="administrador" <?php if ($row['tipo_usuario'] == 'administrador') echo 'selected'; ?>>Administrador</option>
          <option value="producción" <?php if ($row['tipo_usuario'] == 'producción') echo 'selected'; ?>>Producción</option>
          <option value="bodeguero" <?php if ($row['tipo_usuario'] == 'bodeguero') echo 'selected'; ?>>Bodeguero</option>
        </select>
        </div>     
      </center> 
      <?php 
}?>
		<div class="form-group">
      <button type="submit" class="btn btn-custom-orange btn-lg btn-block" name="submit">Actualizar</button>
    </div>

		<div class="form-group">
        <?php
          date_default_timezone_set('America/Guayaquil');
          $hora_actual = date('H:i:s');
          $fecha_actual = date('d-m-Y');
         ?>
          <center>
          <p>Hora actual: <?php echo $hora_actual; ?></p>
          <p>Fecha actual: <?php echo $fecha_actual; ?></p>
          </center>
    </div>
    </form>

</div>
	<script src="../js/cerrarSesion.js"></script>
</body>
</html>
