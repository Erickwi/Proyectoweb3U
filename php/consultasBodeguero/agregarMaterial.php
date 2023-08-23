<?php
include('dbconnection.php');
// Capturar los valores enviados por AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $query = "SELECT *, (cantidad_material * costo_material) as precio_total materiales = WHERE codigo_material = '$codigoMaterial'";
  $actualizarMaterial = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($actualizarMaterial);
  
  $codigoMaterial = $_POST['codigo_compra'];
  $costoMaterial = $_POST['costo_compra'];
  $cantidadMaterial = $_POST['cantidad_compra'];
  $nombreMaterial = $row['nombre_material'];
  $TotalMaterial = $row['precio_total'];
  
  $query = "UPDATE materiales SET cantidad_material = '$cantidadMaterial', costo_material = '$costoMaterial' WHERE codigo_material = '$codigoMaterial'";
  $actualizarMaterial = mysqli_query($con, $query);


  //INSERTAR EN LA TABLA INVENTARIOS_TOTAL;
  //se obtiene el id del usuario con el nombre del usuario que previamente en session se establecio
  $nombre_usuario = $_SESSION['nombre_usuario'];
  $query = "SELECT * from usuario where nombre = '$nombre_usuario'";
  $row = mysqli_fetch_assoc($query);
  //se cambia a entero el id del usuario
  $idUsuario = $row["id_materiales"];

  //se omite los campos de id_inventario, fecha_inventario, activo_inventario porque lo hace automáticamente

  $query = "INSERT INTO inventarios_total(codigo_inventario, detalle_inventario,cantidad_inventario, precio_unitario_inventario, precio_total, unidad_medida, tipo_proceso, usuario_id_usuario) VALUES('$codigoMaterial', '$nombreMaterial','$cantidadMaterial', '$costoMaterial','$TotalMaterial' ,'gramos','Compra y actualización de material', $idUsuario)";
  $result = mysqli_query($con, $query);
  
}
?>
