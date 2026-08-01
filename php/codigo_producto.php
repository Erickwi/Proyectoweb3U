<?php
 include('dbconnection.php');
if(isset($_POST['codigo'])) {
  $codigo = $_POST['codigo'];

  // Consulta SQL para verificar si el código existe
  $sql = "SELECT * FROM productos WHERE codigo_productos = '$codigo'";
  $getProductos = mysqli_query($con, $sql);
  $numFilas = mysqli_num_rows($getProductos);

  if ($numFilas > 0) {
    echo 'repetido';
  } else {
    echo 'disponible';
  }
}
?>
