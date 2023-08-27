<?php
// Obtén la ruta del script actual
$current_page = basename($_SERVER['PHP_SELF']);

// Define un arreglo de enlaces y sus títulos
$links = array(
    'administrador.php' => 'Inicio',
    'agregarUsuario.php' => 'Agregar usuarios',
    'verUsuarios.php' => 'Ver usuarios',
    'verReportes.php' => 'Ver actividad usuarios',
    'agregarUsuario.php' => 'Agregar Usuarios',
    'editarCompra.php' => 'Ver inventario',
    'ingreso_producto.php' => 'Ingreso Productos',
);

?>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <?php
  foreach ($links as $link => $title) {
      $class = 'sidenav_' . strtolower(str_replace(' ', '_', $title));
      $active_class = ($current_page == $link) ? $class . '_active' : '';
      echo '<a href="' . $link . '" class="' . $class . ' ' . $active_class . '">' . $title . '</a>';
  }
  ?>
</div>
