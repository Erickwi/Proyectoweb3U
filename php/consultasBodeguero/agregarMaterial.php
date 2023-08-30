<?php
include('dbconnection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $codigoMaterial = $_POST['codigo_compra'];
  $costoMaterial = $_POST['costo_compra'];
  $cantidadMaterial = $_POST['cantidad_compra'];
  
  // Obtén el valor actual de cantidad_material desde la base de datos
  $query = "SELECT cantidad_material, nombre_material, (cantidad_material * costo_material) as precio_total, costo_material FROM materiales WHERE codigo_material = '$codigoMaterial'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  
  $valorActual = $row['cantidad_material'];
  $costoActual = $row['costo_material'];
  $nombreMaterial = $row['nombre_material'];
  $TotalMaterial = $row['precio_total'];
  $unidadMedida = $_POST['unidad_medida_compra_opcion'];
  
  // Convierte la cantidad ingresada a gramos si la unidad no es "gramo"
  if ($unidadMedida != 'gramo') {
    if ($unidadMedida == 'kilogramo') {
      $cantidadMaterial *= 1000;  // Convertir kilogramos a gramos
    } elseif ($unidadMedida == 'libra') {
      $cantidadMaterial *= 453.592;  // Convertir libras a gramos
    }
  }
  
  // Calcula el nuevo valor sumando el valor actual y la cantidad nueva
  $nuevoValor = $valorActual + $cantidadMaterial;

  //Calcular el nuevo valor del costo haciendo un promedio
  $nuevoValorCosto = ($costoActual + $costoMaterial)/2;
  
  // Actualiza la base de datos con el nuevo valor
  $queryUpdate = "UPDATE materiales SET cantidad_material = '$nuevoValor', costo_material = '$nuevoValorCosto' WHERE codigo_material = '$codigoMaterial'";
  mysqli_query($con, $queryUpdate);

  //INSERTAR EN LA TABLA INVENTARIOS_TOTAL;
  //se obtiene el id del usuario con el nombre del usuario que previamente en session se estableció y se cambia a entero porque es un string
  session_start(); // Asegurarse de iniciar la sesión
  $idUsuario = intval($_SESSION['id_usuario']);

  //se omite los campos de id_inventario, fecha_inventario, activo_inventario porque lo hace automáticamente
  //se pasa la cantidad del material el nuevo valor 
  $queryInsert = "INSERT INTO inventarios_total(codigo_inventario, detalle_inventario,cantidad_inventario, precio_unitario_inventario, precio_total, unidad_medida, tipo_proceso, usuario_id_usuario) VALUES('$codigoMaterial', '$nombreMaterial','$nuevoValor', '$nuevoValorCosto','$TotalMaterial' ,'gramos','Compra y actualización de material', $idUsuario)";
  $resultInsert = mysqli_query($con, $queryInsert);

  if ($resultInsert) {
    echo "Exito"; // Responde con un mensaje de éxito
  } else {
    echo "Error"; // Responde con un mensaje de error
  }
}


?>
