<?php

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['tipo_usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../index.php');
    exit();
}

$nombre_usuario = $_SESSION['nombre_usuario'];
$tipo_usuario = $_SESSION['tipo_usuario'];
if ($tipo_usuario === 'bodeguero') {
     //Si es administrador, redirigir a la página de administrador
    header('Location: bodeguero.php');
    exit();
}elseif ($tipo_usuario === 'producción') {
    header('Location: produccion.php');
   exit();
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="../css/sidenav.css" rel="stylesheet" type="text/css">
    <link href="../css/ingreso_producto.css" rel="stylesheet" type="text/css">
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
         include "sidenav_admin_module.php"
      ?>
    <div class="encabezado">
        <div class="logo"><img src="../img/logo_alternativo.png"></div>
        <div class="informacion">
            <div class="nombre"><p><?php echo $nombre_usuario?></p></div>
            <div class="user-logo"><i class="fa-solid fa-user fa-2xl"></i></div>
            <div class="w3-dropdown-hover cerrarDrop">
                <button class="w3-button w3-light-gray w3-round-large cerrarDropBtn">Mi cuenta</button>
                <div class="w3-dropdown-content w3-bar-block w3-border">
                  <a id="cambiar_contraseña_btn" class="w3-bar-item w3-button">Cambiar contraseña</a>
                  <a id="cerrar_sesion_btn" class="w3-bar-item w3-button">Cerrar sesión</a>
                </div>
              </div>
        </div>
    </div>
       <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
      <div class="contenido-ingreso-productos"> 
      <div class = "ingreso-productos-nuevo">
        <h1>Ingreso Productos <a href="mostrar_materiales.php"> sss</a></h1>
         
        <div class="ingreso-nuevo-producto">
        <div class="ingreso-informacion">
          <form method="post" id="materiales-producto" >
        <div class="ingreso-codigo-producto">
        <label for="codigo producto">Código del producto</label><br>
              <input
                type="text"
                name="productos"
                id="productos"
              />
      </div>
          <div class="ingreso-codigo-producto">
             <label for="codigo producto">Nombre Producto</label><br>
              <input
                type="text"
                name="nombre"
                id="nombre"
              />
      
              </div>
          <div class="ingreso-codigo-producto flex">
            <div class="selecionar-materiales"><label for="codigo_material">Material</label> <br>
             <select name="material" id="material">
               <option value="seleccionarOpcion">Selecciona el producto</option>
                <?php  
                include('dbconnection.php');
                $getProducto ="select * from materiales order by nombre_material";
                $getProducto1=mysqli_query($con,$getProducto);
                while( $row=mysqli_fetch_array($getProducto1)){
                    $id=$row['id_materiales'];
                    $codigo_productos=$row['codigo_material'];
                    $nombre_material=$row['nombre_material'];
                    ?>
                    <option value="<?php echo $id; ?>"> <?php echo  $nombre_material ?> </option>
                    <?php
                }
                
                ?>
        
            </select> </div>
            <div class="cantidad-materiales"><label for="number">Cantidad:</label><br>
            <input type="number" name="cantidad" id="cantidad" min=1> </div>

          </div>
           <div class="ingreso-codigo-producto ingreso-imagen" >
            <label for="number">Imagen:</label><br>
             <h6> <input type="file" id="subirMaterial" name ="subirMaterial" accept="image/*" /> <button id="materialCarga" class="material-insertar" style="cursor:pointer;" >  Subir </button></h6>
          </div>
          </form>
        </div>
        <div class="ingreso-img" >
         <div class="carga-img" id="imagenContenedor">
         <img /> 
         </div>
          <div> <p> <button class="cargar-producto" onclick="subirImagen(1)" style="cursor:pointer;">  Mostrar </button></p> </div>
        </div>
         
        </div>
         
       <div class="mostrar-material-producto" id="materiales"></div>
        </div>

        
        
      </div>
     

      
 </div>

 <!-- ... (código HTML previo) ... -->

<script>
$(document).ready(function() {
  $('#materialCarga').click(function(e) {
    e.preventDefault();
	  var formulario = $(this).closest('#materiales-producto');
    var codigo = formulario.find("input[name='productos']").val();
	var nombreMaterial = formulario.find("input[name='nombre']").val();
	var cantidad = formulario.find("input[name='cantidad']").val();
	var archivo = formulario.find("input[name='subirMaterial']").prop("files")[0];
	var opcion = formulario.find("select[name='material']").val(); // Update 'selectOption' with the actual name
    var formData = new FormData($('#materiales-producto')[0]);
    formData.append('subirMaterial', $('#subirMaterial')[0].files[0]); // Agrega el archivo al FormData
	if (!/^\d{5}$/.test(codigo)) {
      // Mostrar una alerta SweetAlert
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Ingresa un número entero de 5 dígitos en el campo de código.',
      });
      $("input[type='text']").val("");
      return; // Detener el proceso si la entrada es inválida
    }
	  if (!validarNombreMaterial(nombreMaterial)) {
        Swal.fire({
          icon: 'error',
          title: 'Campo incorrecto',
          text: 'El campo Nombre Material debe tener al menos 10 caracteres y contener solo letras y espacios'
        });
        return;
      }
	  if (cantidad === "") {
      Swal.fire({
        icon: 'error',
        title: 'Campo vacío',
        text: 'El campo Cantidad no puede estar en blanco'
      });
      return;
    }
	if (opcion === "seleccionarOpcion") {
	  Swal.fire({
	    icon: 'error',
	    title: 'Oops...',
	    text: 'Debes seleccionar un material',
	  });
	  return; // Stop the process if the selection is invalid
	}
	
	if (!archivo) {
	  Swal.fire({
	    icon: 'error',
	    title: 'Imagen Material faltante',
	    text: 'Por favor, sube la imagen del material para cargar.',
	  });
	  return; // Detener el proceso si no se ha seleccionado ningún archivo
	}
    $.ajax({
      type: 'POST',
      url: 'mostrar_materiales.php', // Reemplaza con la URL correcta del script PHP
      data: formData,
      processData: false,
      contentType: false,
      success: function(response) {
       
        $('#materiales').html(response);
        // Manejar la respuesta o actualizar la interfaz aquí
      },
      error: function() {
        alert('Ocurrió un error al enviar los datos de Información del producto.');
      }
    });
  });
	
	function validarNombreMaterial(nombre) {
	    const regex = /^[A-Za-z\s]+$/;
	    return regex.test(nombre) && nombre.length >= 10;
	}
});
</script>

<!-- ... (resto del código HTML) ... -->


    
  <script src="../js/cerrarSesion.js"></script>
  <script src="../js/eliminar_orden_compra.js"></script>
  <script src="../js/sidenav.js"></script>
  <script src="../js/imagen_carga.js"></script>
</body>
</html>