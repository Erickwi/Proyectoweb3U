<?php
 include('dbconnection.php');
if(isset($_POST['codigo'])) {
  
  $codigo = $_POST['codigo'];

  // Consulta SQL para verificar si el código existe
  $sql = "SELECT * FROM usuario WHERE cedula = '$codigo'";
  $getCedula = mysqli_query($con, $sql);
  $numFilas = mysqli_num_rows($getCedula);
   
  
  if ($numFilas > 0) {
    echo 'repetido';
  } else {
    echo 'disponible';
  }
}
?>
