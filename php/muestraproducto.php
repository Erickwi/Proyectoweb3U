<?php
include('dbconnection.php');

  //Databse Connection file
if(isset($_POST['productos'])) {
    // Getting the post values
    $codigo = $_POST['codigo_orden1'];
    $cantidad = $_POST['cantidad_producto1'];
    $id_usuario=$_POST['id_usuario'];
    $codigo_buscar = mysqli_real_escape_string($con, $_POST['productos']); 
    
  $TotalS = mysqli_real_escape_string($con, $codigo_buscar);

    $getP = "SELECT productos_id_productos, SUM(cantidad_pm * costo_pm) as totalP FROM productos_materiales WHERE productos_id_productos='$TotalS 'GROUP BY productos_id_productos";
    $getP1 = mysqli_query($con, $getP);
    $rowP = mysqli_fetch_assoc($getP1);
    
    // Define and initialize $total before using it in the query
    $total = 0; // Replace 0 with the actual value

    // Query for data insertion
   $query = mysqli_query($con, "INSERT INTO ordenes_produccion (codigo_orden,total_orden, usuario_id_usuario, productos_id_productos,cantidad_productos, costo_productos) VALUES ( '$codigo',  '$total',  '$id_usuario',  ' $codigo_buscar', '$cantidad',   '{$rowP['totalP']}')");
    
}

/////////////////////////////////////////////////////////////////////

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de producción</title>
    <link rel="icon" href="../img/icon_logo.png" type="image/png" sizes="32x32"/>
   <link href="../css/estilo_orden_p.css" rel="stylesheet" type="text/css" />
    <link href="../css/estilo_administrador.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="../css/sidenav.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- SweetAlert 2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.js"></script>
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css"
        />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
 
</head>
<body>
    <div class="principal">
     
 
          <?php  

if (isset($_POST['codigo_orden1'])) {


    $codigo_buscar = mysqli_real_escape_string($con, $_POST['codigo_orden1']); 
    $getMateriales = "select codigo_orden,nombre_productos,id_productos,cantidad_productos,costo_productos from inventario.ordenes_produccion c, productos p where p.id_productos=c.productos_id_productos and c.codigo_orden='$codigo_buscar '";
    
    $getMateriales1 = mysqli_query($con, $getMateriales);
  $getMateriales2= mysqli_query($con, $getMateriales);
  $total=0;
  ?>
          
          
         <div class="contenido-materiales titulo-contenido">
            <div class="detalle-material">
              <label for="detalle_orden">Detalle</label>
             
            </div>
            <div class="cantidad-material">
              <label for="cantidad_orden">Cantidad</label>
              
            </div>
            <div class="costo-material">
              <label for="costo_orden">Costo</label>
              
            </div></div>
<?php 
    
    if (mysqli_num_rows($getMateriales1) > 0) {
      
        while ($row = mysqli_fetch_assoc($getMateriales1)) {
           $TotalS= mysqli_real_escape_string($con, $row['id_productos']); 
    $getP = "select sum(cantidad_pm*costo_pm) as totalP from productos_materiales where productos_id_productos='$TotalS' GROUP BY productos_id_productos";
    
    $getP1= mysqli_query($con, $getP);
          $rowP = mysqli_fetch_assoc($getP1)
?>
            <div class="contenido-materiales">
                <div class="detalle-material">
                    <input class="w3-input" type="text" name="detalle_orden" id="detalle_orden" value="<?php echo $row['nombre_productos']; ?>" readonly />
                </div>
                <div class="cantidad-material">
                    <input class="w3-input" type="text" name="cantidad_orden" id="cantidad_orden" value="<?php echo $row['cantidad_productos']; ?>" readonly  />
                </div>
                <div class="costo-material">
                    <input class="w3-input" type="text" name="costo_orden" id="costo_orden" value="<?php echo $rowP['totalP'];?>" readonly />
                </div>
            </div>
         
        
<?php
          $total += ($row['cantidad_productos'] * $rowP['totalP']); // Sumamos al total
        }
      ?>
      <div class="contenido-materiales">
            <div class="total-orden-suma">
                <label for="total_orden">Total</label>
                <input  type="number" name="total_orden" id="total_orden" value="<?php echo $total; ?>" readonly  >
            </div>
          </div>
      <?php
    } else {
?>
        <h4><?php echo $codigo_buscar; ?> No se han encontrado registros</h4>
<?php
    }
}
?>
    </div>
  <script src="../js/cerrarSesion.js"></script>
  <script src="../js/horaYFecha.js"></script>
  <script src="../js/eliminar_orden_compra.js"></script>
  <script src="../js/sidenav.js"></script>
</body>
</html>