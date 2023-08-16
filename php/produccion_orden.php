<?php
include('dbconnection.php');
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['tipo_usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../index.php');
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];
$nombre_usuario = $_SESSION['nombre_usuario'];
if ($tipo_usuario === 'administrador') {
    // Si es administrador, redirigir a la página de administrador
    header('Location: administrador.php');
    exit();
}elseif ($tipo_usuario === 'bodeguero') {
    header('Location: bodeguero.php');
    exit();
}

  //Databse Connection file

if(isset($_POST['submit']))
  {
  	//getting the post values
    $codigo_orden=$_POST['codigo_orden1'];
   $total_orden=$_POST['total_orden'];
    echo "<script>alert('submit');</script>";
  // Query for data insertion
     $query=mysqli_query($con, "insert into ordenes_produccion(codigo_orden,total_orden) value('$codigo_orden','$total_orden')");
    if ($query) {
    echo "<script>alert('Los datos han sido registrados correctamente');</script>";
    echo "<script type='text/javascript'> document.location ='agregarUsuario.php'; </script>";
  }
  else
    {
      echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }
}
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
        include "sidenav_produccion_module.php"
      ?>
    <div class="encabezado">
        <div class="logo"><img src="../img/logo_alternativo.png"></div>
        <div class="informacion">
            <div class="nombre"><p><?php echo $nombre_usuario?></p></div>
            <div class="user-logo"><i class="fa-solid fa-user fa-2xl"></i></div>
            <div class="cerrar" id="cerrar_sesion"><p>Cerrar Sesión</p> </div>
        </div>
    </div>
      <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
      <div class="contenido-informacion-orden">
      <div class="contenido-orden"> 
         <form method="post" >
          <h1>Orden de produccion</h1>
          <div class="informacion-orden">
            <div class="codigos-orden">
              <label for="codigo_orden">Código de la orden</label><br />
              <input
                class="w3-input"
                type="text"
                name="codigo_orden1"
                id="codigo_orden1"
              />
            </div>
            <div class="extra-orden">
              <br />
              <input
                class="w3-input"
                type="text"
                name="fecha_orden"
                id="fecha_compra" 
                placeholder=""
                readonly
              />
            </div>
          </div>
          <div class="informacion-producto">
            <div class="codigos-producto">
              <label for="codigo_material">Producto</label><br />
             <select name="productos" id="productos">
               <option value="">Selecciona el producto</option>
                <?php  
                include('dbconnection.php');
                $getProducto ="select * from productos order by nombre_productos";
                $getProducto1=mysqli_query($con,$getProducto);
                while( $row=mysqli_fetch_array($getProducto1)){
                    $id=$row['id_productos'];
                    $codigo_productos=$row['codigo_productos'];
                    $nombre_productos=$row['nombre_productos'];
                    $activo_producto=$row['activo_producto'];
                    ?>
                    <option value="<?php echo $id; ?>"> <?php echo $nombre_productos ?> </option>
                    <?php
                }
                
                ?>
        
            </select>
               <button class="w3-btn w3-round-large w3-blue" type="submit" name="buscar">Aceptar</button>
            </div>

          </div>
           <div class="enviar-orden">
            <input align="center" type="submit" name="submit" value="Generar orden" />
          </div>
        </form>
        </form></div>


        
    <div class="contenido-orden">
        <form method="post" >
          <?php  
if (isset($_POST['productos'])) {
 
  
    $codigo_buscar = mysqli_real_escape_string($con, $_POST['productos']); 
    $getMateriales = "SELECT codigo_productos,nombre_productos,costo_pm,cantidad_pm,foto_producto, nombre_material, cantidad_material, costo_material FROM inventario.productos p, inventario.materiales m, inventario.productos_materiales mp 
    WHERE p.id_productos=mp.productos_id_productos AND m.id_materiales=mp.materiales_id_materiales AND p.id_productos='$codigo_buscar' ";
    
    $getMateriales1 = mysqli_query($con, $getMateriales);
  $getMateriales2= mysqli_query($con, $getMateriales);
  $row1 = mysqli_fetch_assoc($getMateriales2);
  $total=0;
  ?>
          <h1>Orden de produccion</h1>
          
          <div class="informacion-producto">
            <div class="codigos-producto">
              <label for="codigo_material">Producto</label><br />
             <input class="w3-input" type="text" name="detalle_orden" id="detalle_orden" value="<?php echo $row1['codigo_productos']; ?>" readonly />
<label for="codigo_material">Producto</label><br />
             <input class="w3-input" type="text" name="detalle_orden" id="detalle_orden" value="<?php echo $row1['nombre_productos']; ?>" readonly />
            </div>
            
            
          
  <div class="imagen-orden"><img src="<?php echo  $row1['foto_producto']; ?>" alt="" /></div>
          </div><div class="contenido-materiales">
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
?>
            <div class="contenido-materiales">
                <div class="detalle-material">
                    <input class="w3-input" type="text" name="detalle_orden" id="detalle_orden" value="<?php echo $row['nombre_material']; ?>" readonly />
                </div>
                <div class="cantidad-material">
                    <input class="w3-input" type="text" name="cantidad_orden" id="cantidad_orden" value="<?php echo $row['cantidad_pm']; ?>" readonly  />
                </div>
                <div class="costo-material">
                    <input class="w3-input" type="text" name="costo_orden" id="costo_orden" value="<?php echo $row['costo_pm']; ?>" readonly />
                </div>
            </div>
         
        
<?php
          $total += ($row['cantidad_pm'] * $row['costo_pm']); // Sumamos al total
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
      </div>
        </div>
  <script src="../js/cerrarSesion.js"></script>
  <script src="../js/horaYFecha.js"></script>
  <script src="../js/eliminar_orden_compra.js"></script>
  <script src="../js/sidenav.js"></script>
</body>
</html>