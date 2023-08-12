<?php 
//Databse Connection file
include('dbconnection.php');
if(isset($_POST['submit']))
  {
  	//getting the post values
    $Nombre=$_POST['nombre'];
    $Apellido=$_POST['apellido'];
    $Cedula=$_POST['cedula'];
    $UsuarioN=$_POST['user'];
    $Tipoempleado=$_POST['tipo_empleado'];
    $Clave=$_POST['contraseña'];
   
  // Query for data insertion
     $query=mysqli_query($con, "insert into usuario(nombre,apellido, cedula, usuario, tipo_usuario, contraseña) value('$Nombre','$Apellido', '$Cedula', '$UsuarioN', '$Tipoempleado', '$Clave' )");
    if ($query) {
    echo "<script>alert('Los datos han sido registrados correctamente');</script>";
    echo "<script type='text/javascript'> document.location ='agregarUsuario.php'; </script>";
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <title>Agregar Usuario</title>
    <link href="../css/estilo_administrador.css" rel="stylesheet" type="text/css" />
    <link href="../css/sidenav.css" rel="stylesheet" type="text/css" />
    <link href="../css/estilo_agrusu.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
    include "sidenav_admin_module.php"
  ?>

    <div class="principal">
      <main id="main">
    <div class="encabezado">
        <div class="logo"><img src="../img/LOGO1.png"></div>
        <div class="informacion">
            <div class="nombre"><p>Nombre del usuario</p></div>
            <div class="user-logo"> <img src="../img/usuario-logo.png" alt=""></div>
            <div class="cerrar"><p> <a href="logout.php">Cerrar Sesión</a></p> </div>
        </div>
    </div>
      
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
    </div> </main>  
    </div>
    <script src="../js/sidenav.js"></script>
    <center>
        <h2>Agregar Usuario</h2>
    </center>
    <div class="form-container">
        <form method="POST">
            <div class="form-row">
                <div class="half-width">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Ingrese el Nombre" required>
                </div>
                <div class="half-width">
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" id="apellido" placeholder="Ingrese el Apellido" required>
                </div>
            </div>
            <div class="form-row">
                <div class="half-width">
                    <label for="cedula">Cédula</label>
                    <input type="number" name="cedula" id="cedula" placeholder="Ingrese la Cédula" maxlength="10" pattern="[0-9]+" required>
                </div>
                <div class="half-width">
                    <label for="tipo_empleado">Tipo de Empleado</label>
                    <select name="tipo_empleado" id="tipo_empleado" required>
                        <option value="producción">Producción</option>
                        <option value="administrador">Administrador</option>
                        <option value="bodeguero">Bodeguero</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="half-width">
                    <label for="usuario">Nombre de Usuario</label>
                    <input type="text" name="user" placeholder="Ingrese un Nombre de Usuario" required>
                </div>
                <div class="half-width">
                    <label for="contraseña">Contraseña</label>
                    <input type="password" name="contraseña" id="contraseña" placeholder="Ingrese la Contraseña" required>
                </div>
            </div>
            <div class="centered-button">
                <button type="submit" name="submit">Agregar</button>
            </div>
        </form>
    </div>
    <p class="redirect-link">
        <a href="./administrador.php">Dirigir a la pantalla de Inicio</a>
    </p>
</body>
</html>
