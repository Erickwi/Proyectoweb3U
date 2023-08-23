<?php
  include('dbconnection.php');
  //INSERCIÓN EN MATERIALES
  $nombreMaterial = $_POST["nombreMaterial"];
  $codigoMaterial =$_POST['codigoCompra'];
  $cantidadMaterial = $_POST['cantidadCompra'];
  $costoMaterial = $_POST['costoCompra'];
  $TotalMaterial = $_POST['precioTotalCompra'];

  $query = "INSERT INTO materiales(codigo_material,nombre_material,cantidad_material,costo_material) VALUES('$codigoMaterial', '$nombreMaterial','$cantidadMaterial', '$costoMaterial')";
  $result = mysqli_query($con, $query);

 //INSERTAR EN LA TABLA INVENTARIOS_TOTAL;
  //se obtiene el id del usuario con el nombre del usuario que previamente en session se establecio
  $nombre_usuario = $_SESSION['nombre_usuario'];
  $query = "SELECT id_usuario from usuario where nombre = '$nombre_usuario'";
  //se cambia a entero el id del usuario
  $idUsuario = intval(mysqli_query($con, $query));

  //se omite los campos de id_inventario, fecha_inventario, activo_inventario porque lo hace automáticamente

  $query = "INSERT INTO inventarios_total(codigo_inventario, detalle_inventario,cantidad_inventario, precio_unitario_inventario, precio_total, unidad_medida, tipo_proceso, usuario_id_usuario) VALUES('$codigoMaterial', '$nombreMaterial','$cantidadMaterial', '$costoMaterial','$TotalMaterial' ,'gramos','Compra material', $idUsuario)";
  $result = mysqli_query($con, $query);

  
  if ($result) {
    echo "Exito"; // Responde con un mensaje de éxito
  } else {
    echo "Error"; // Responde con un mensaje de error
  }

 
?>
