<?php
  session_start();
  include('dbconnection.php');
  //INSERCIÓN EN MATERIALES
  $nombreMaterial = $_POST["nombreMaterial"];
  $codigoMaterial =$_POST['codigoCompra'];
  $cantidadMaterial = $_POST['cantidadCompra'];
  $costoMaterial = $_POST['costoCompra'];
  $unidadMedida = $_POST['unidadMedida'];

// Convierte la cantidad ingresada a gramos si la unidad no es "gramo"
  // Convierte la cantidad ingresada a gramos si la unidad no es "gramo"
  if (in_array($unidadMedida, ['kilogramo', 'libra'])) {
    if ($unidadMedida == 'kilogramo') {
      $cantidadMaterial *= 1000;  // Convertir kilogramos a gramos
      $unidadMedida = 'gramo';
    } elseif ($unidadMedida == 'libra') {
      $cantidadMaterial *= 453.592;  // Convertir libras a gramos
      $unidadMedida = 'gramo';
    }
  } elseif (in_array($unidadMedida, ['galones', 'litros', 'ml'])) {
    if ($unidadMedida == 'galones') {
      $cantidadMaterial *= 3.78541; // Convertir galones a litros
      $unidadMedida = 'litros';
    } elseif ($unidadMedida == 'ml') {
      $cantidadMaterial /= 1000; // Convertir mililitros a litros
      $unidadMedida = 'litros';
    }
  }
  $TotalMaterial = $_POST['precioTotalCompra'];

  $query = "INSERT INTO materiales(codigo_material,nombre_material,cantidad_material,costo_material,unidad_medida) VALUES('$codigoMaterial', '$nombreMaterial','$cantidadMaterial', '$costoMaterial','$unidadMedida')";
  $result = mysqli_query($con, $query);

 //INSERTAR EN LA TABLA INVENTARIOS_TOTAL;
  //se obtiene el id del usuario con el nombre del usuario que previamente en session se establecio y se cambia a entero porque es un string
  $idUsuario = intval($_SESSION['id_usuario']);

  //se omite los campos de id_inventario, fecha_inventario, activo_inventario porque lo hace automáticamente
  //aqui no se pasa la cantidad del nuevo valor porque es una nueva compra 
  $query = "INSERT INTO inventarios_total(codigo_inventario, detalle_inventario,cantidad_inventario, precio_unitario_inventario, precio_total, unidad_medida, tipo_proceso, usuario_id_usuario) VALUES('$codigoMaterial', '$nombreMaterial','$cantidadMaterial', '$costoMaterial','$TotalMaterial' ,'gramo','Compra nuevo material', $idUsuario)";
  $result = mysqli_query($con, $query);

  
  if ($result) {
    echo "Exito"; // Responde con un mensaje de éxito
  } else {
    echo "Error"; // Responde con un mensaje de error
  }

 
?>
