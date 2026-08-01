<?php
 include('dbconnection.php');
if(isset($_POST['codigo'])) {
  $codigo = $_POST['codigo'];

  // Consulta SQL para verificar si el código existe
  $sql = "Select codigo_orden from ordenes_produccion where codigo_orden= '$codigo'";
  $getProductos = mysqli_query($con, $sql);
  $numFilas = mysqli_num_rows($getProductos);

  if ($numFilas > 0) {
    echo 'repetido';
  } else {
    echo 'disponible';
  }
}
?>
