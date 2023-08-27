<?php//Databse Connection file
include('dbconnection.php');

  	//getting the post values
    $Nombre=$_POST['nombre'];
    $Apellido=$_POST['apellido'];
    $Cedula=$_POST['cedula'];
    $UsuarioN=$_POST['user'];
    $Tipoempleado=$_POST['tipo_empleado'];
    $Clave=md5($_POST['contraseña']);
   
  // Query for data insertion
     $query=mysqli_query($con, "insert into usuario(nombre,apellido, cedula, usuario, tipo_usuario, contraseña) value('$Nombre','$Apellido', '$Cedula', '$UsuarioN', '$Tipoempleado', '$Clave' )");
    if ($query) {
    echo "Exito";
  } else {
      echo "Error";
    }

?>