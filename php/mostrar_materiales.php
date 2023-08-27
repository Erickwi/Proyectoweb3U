<?php
include('dbconnection.php');


if(isset($_POST['productos'])) {
    // Getting the post values
     $codigo = $_POST['productos'];
    $material = $_POST['material'];
    $cantidad=$_POST['cantidad'];
    $nombre=$_POST['nombre'];
 if(isset($_FILES["subirMaterial"])){
    
    $file = $_FILES['subirMaterial'];
    $nombreFoto = $file['name'];
    $rutaTemporal = $file['tmp_name'];
    $tipo = $file['type'];
    $carpeta = '../img/';

    if($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png'){
        echo "     Error, archivo no válido";
    } else {
        $src = $carpeta . $nombreFoto;
        move_uploaded_file($rutaTemporal, $src);
        $materialFoto = $src;
       
    }
}

$codigo_buscar = mysqli_real_escape_string($con, $codigo); 
 $getMateriales = "Select id_productos,codigo_productos from productos where codigo_productos='$codigo';";
$getMateriales1 = mysqli_query($con, $getMateriales);
   
if (mysqli_num_rows($getMateriales1) > 0){
 
   $row = mysqli_fetch_assoc($getMateriales1);
   $id_producto=$row['id_productos'];
  $query = mysqli_query($con, "INSERT INTO productos_materiales(productos_id_productos,materiales_id_materiales,cantidad_pm) values ('$id_producto','$material','$cantidad') ");
}else{
  $query = mysqli_query($con, "INSERT INTO productos(codigo_productos,nombre_productos,foto_producto) values ('$codigo','$nombre','$src') ");
  $getMateriales = "Select id_productos,codigo_productos from productos where codigo_productos='$codigo';";
$getMateriales1 = mysqli_query($con, $getMateriales);
   $row = mysqli_fetch_assoc($getMateriales1);
   $id_producto=$row['id_productos'];
  $query = mysqli_query($con, "INSERT INTO productos_materiales(productos_id_productos,materiales_id_materiales,cantidad_pm) values ('$id_producto','$material','$cantidad') ");
}


}

/////////////////////////////////////////////////////////////////////

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de producción</title>
     <link href="../css/ingreso_producto.css" rel="stylesheet" type="text/css">
   <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>
<body>
    <div class="contenido-materiales-producto">
      <div> 
      <div class="titulos-contenido">
      <div class="detalle-material">MATERIAL </div>
        <div class="cantidad-material"> CANTIDAD</div>
      </div>
<?php

$getMateriales = "select productos_id_productos,nombre_material, cantidad_pm from materiales m, productos p, productos_materiales pm  where m.id_materiales=pm.materiales_id_materiales and p.id_productos=pm.productos_id_productos and pm.productos_id_productos='$id_producto';";
$getMateriales1 = mysqli_query($con, $getMateriales);
if (mysqli_num_rows($getMateriales1) > 0) {
  while ($row = mysqli_fetch_assoc($getMateriales1)) {
  ?>


        <div class="contenido-material-todo">
      <div class="detalle-material">
        <input class="w3-input" type="text" name="cantidad_orden" id="cantidad_orden" value="<?php echo $row['nombre_material']; ?>" readonly  /> 
      </div>
        <div class="cantidad-material">
          <input class="w3-input" type="text" name="cantidad_orden" id="cantidad_orden" value="<?php echo $row['cantidad_pm']; ?>" readonly  />
        </div>
      </div>
        <?php
  }
}
      ?>
      </div>
    </div>
</body>
</html>