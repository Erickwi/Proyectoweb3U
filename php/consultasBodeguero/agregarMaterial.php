<?php
include('dbconnection.php');
// Capturar los valores enviados por AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $codigoMaterial = $_POST['codigo_compra'];
  $costoMaterial = $_POST['costo_compra'];
  $cantidadMaterial = $_POST['cantidad_compra'];
  
  $query = "UPDATE materiales SET cantidad_material = '$cantidadMaterial', costo_material = '$costoMaterial' WHERE codigo_material = '$codigoMaterial'";
  $actualizarMaterial = mysqli_query($con, $query);
}
?>
