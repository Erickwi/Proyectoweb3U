<?php
// Obtén la ruta del script actual
$current_page = basename($_SERVER['PHP_SELF']);

// Define un arreglo de enlaces y sus títulos
$links = array(
    'bodeguero.php' => 'Inicio',
    'bodeguero_compras.php' => 'Compras',
    'bodeguero_ver_compras.php' => 'Ver Compras'
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