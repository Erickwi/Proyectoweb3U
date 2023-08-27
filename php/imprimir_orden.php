<?php
if (isset($_GET['codigoOrden']) && isset($_GET['idUsuario'])) {
    $codigoOrden = $_GET['codigoOrden'];
    $idUsuario = $_GET['idUsuario'];
  
} else {
    echo "No se recibió ningún valor.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ORDEN DE PRODUCION</title>
</head>
<body>
   <link href="../css/antes_imp.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="../css/imprimir.css" media="print" />
</body>
<div class="Imprimir-ordenes">
  <div class="Prinicipal-imprimir"> 
  <h1> ORDEN DE PRODUCION</h1>
  <div class="codigo-fecha">  
    <div class="codigo-fecha1"> Empleado encargado: <br>  <input type="text"  name="codigo_orden" id="codigo_orden" value="<?php echo  $idUsuario; ?>"  /> </div>
    <div class="codigo-fecha1"> Codigo de la Orden <br>  <input type="text"  name="codigo_orden" id="codigo_orden" value="<?php echo $codigoOrden; ?>"  />  </div>
    <div class="codigo-fecha1">Fecha de emision <br>  <input type="text"  name="codigo_orden" id="codigo_orden" value="<?php echo date('Y-m-d'); ?>"  />  </div>
   
  </div>

    <?php
  include('dbconnection.php');
  $getPro= "Select DISTINCT codigo_productos,nombre_productos, cantidad_productos  from ordenes_produccion op, productos p,productos_materiales pm, materiales m where pm.materiales_id_materiales=m.id_materiales and op.productos_id_productos=p.id_productos and pm.productos_id_productos=p.id_productos and codigo_orden='$codigoOrden';
";
  $getPro1= mysqli_query($con, $getPro);


while ($rowP = mysqli_fetch_assoc($getPro1)){

?>
    <div class="codigo-fecha">  
    <div class="codigo-producto"> Codigo del producto: <br>  <input type="text"  name="codigo_orden" id="codigo_orden" value="<?php echo $rowP['codigo_productos']; ?>" readonly /> </div>
    <div class="codigo-producto"> Nombre del producto <br>  <input type="text"  name="codigo_orden" id="codigo_orden" value="<?php echo $rowP['nombre_productos']; ?>" readonly />  </div>
    <div class="cantidad-producto">  Cantidad <br>  <input type="text"  name="codigo_orden" id="codigo_orden" value="<?php echo $rowP['cantidad_productos']; ?>" readonly />  </div>
   
  </div>
    <br>
    <div class="codigo-fecha nuevo-titulo">  
    <div class="informacion-material-codigo "> codigo del material </div>
    <div class="informacion-material-nombre "> Detalles  </div>
    <div class="informacion-material ">  Cantidad   </div>
    <div class="informacion-material ">  Costo  </div>
   
  </div>
  <?php

    $getM= "Select codigo_orden,codigo_productos,nombre_productos,codigo_material, nombre_material,cantidad_pm,costo_material  from ordenes_produccion op, productos p,productos_materiales pm, materiales m where pm.materiales_id_materiales=m.id_materiales and op.productos_id_productos=p.id_productos and pm.productos_id_productos=p.id_productos AND codigo_orden='$codigoOrden';
";
    $getM1= mysqli_query($con, $getM);
    $rowM = mysqli_fetch_assoc($getM1);
  
  while ($rowP = mysqli_fetch_assoc($getM1)){
  
  ?>
    <div class="tamaño-nuevo">  
    <div class="informacion-material-codigo "><input type="text"  name="codigo_material" id="codigo_material" value="<?php echo $rowP['codigo_material']; ?>"  /> </div>
    <div class="informacion-material-nombre "><input type="text"  name="codigo_orden" id="codigo_orden" value="<?php echo $rowP['nombre_material']; ?>"  />  </div>
    <div class="informacion-material "> <input type="text"  name="codigo_orden" id="codigo_orden" value="<?php echo $rowP['cantidad_pm']; ?>"  />  </div>
    <div class="informacion-material "><input type="text"  name="codigo_orden" id="codigo_orden" value="<?php echo $rowP['costo_material']; ?>"  />  </div>
    </div>
    
    <br>
<?php
  }
}
?>
    
</div>
  
</html>