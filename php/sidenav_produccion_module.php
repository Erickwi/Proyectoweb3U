<?php
// Obtén la ruta del script actual
$current_page = basename($_SERVER['PHP_SELF']);

// Define un arreglo de enlaces y sus títulos
$links = array(
    'produccion.php' => 'Inicio',
    'produccion_orden.php' => 'Orden de producción',
    'produccion_ver_ordenes.php' => 'Ver orden'
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