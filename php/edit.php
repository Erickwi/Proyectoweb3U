<?php

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['tipo_usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../index.php');
    exit();
}

$nombre_usuario = $_SESSION['nombre_usuario'];

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

    //Query for data updation
     $query=mysqli_query($con, "update  usuario set nombre='$nombre',apellido='$apellido', usuario='$user', contraseña='$contraseña', tipo_usuario='$tipo' where id_usuario='$eid'");
     
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
</head>
<body>
<?php
    include "sidenav_admin_module.php"
  ?>

    <div class="principal">
      <main id="main">
    <div class="encabezado">
        <div class="logo"><img src="../img/logo_alternativo.png"></div>
        <div class="informacion">
            <div class="nombre"><p style="font-weight: bold; font-size: 24px; font-family: 'Times New Roman', Times, serif; color: blue;"><?php echo $nombre_usuario ?></p></div>
            <div class="user-logo"> <img src="../img/usuario-logo.png" alt=""></div>
            <div class="cerrar"><p> <a href="logout.php">Cerrar Sesión</a></p> </div>
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
        <div class="col">
            <label for="nombre">Nuevo Usuario</label>
            <input type="text" class="form-control" name="usuario" value="<?php  echo $row['usuario'];?>" required="true" maxlength="10">
        </div>
        <div class="col">
          <label for="nombre">Nueva Contraseña</label>
        	<input type="text" class="form-control" name="contraseña" value="<?php  echo $row['contraseña'];?>" required="true">
        </div>
      </div><br>
        <div class="form-group">
        <label for="tipo">Seleccione el Nuevo Tipo Usuario:</label>
        <select name="tipo_usuario" id="tipo_usuario" required="true">
          <option value="administrador" <?php if ($row['tipo_usuario'] == 'administrador') echo 'selected'; ?>>Administrador</option>
          <option value="producción" <?php if ($row['tipo_usuario'] == 'producción') echo 'selected'; ?>>Producción</option>
          <option value="bodeguero" <?php if ($row['tipo_usuario'] == 'bodeguero') echo 'selected'; ?>>Bodeguero</option>
        </select>
        </div>      
      <?php 
}?>
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Actualizar</button>
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
</body>
</html>