<?php
// Obtén la ruta del script actual
$current_page = basename($_SERVER['PHP_SELF']);

// Define un arreglo de enlaces y sus títulos
$links = array(
    'SuperUsuario.php' => 'Inicio',
    'agregarUsuario.php' => 'Agregar usuarios',
    'verUsuarios.php' => 'Ver usuarios',
    'actividadUsuario.php' => 'Actividad usuario',
    'Inventario.php' => 'Inventario',
    'verProductos.php' => 'Productos',
    'bodeguero_ver_compras.php' => 'Materiales',
    'ingreso_producto.php' => 'Ingreso Productos',
    'produccion_orden.php' => 'Orden de producción',
    'produccion_ver_ordenes.php' => 'Ver orden',
    'bodeguero_compras.php' => 'Comprar Material',
    'bodeguero_nueva_compra.php' => 'Comprar Nuevo Material'
);

?>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <?php
  foreach ($links as $link => $title) {
      $class = 'sidenav_' . strtolower(str_replace(' ', '_', $title));
      echo '<a href="' . $link . '" class="' . $class . '">' . $title . '</a>';
  }
  ?>
</div>
