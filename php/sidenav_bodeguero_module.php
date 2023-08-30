<?php
// Obtén la ruta del script actual
$current_page = basename($_SERVER['PHP_SELF']);

// Define un arreglo de enlaces y sus títulos
$links = array(
    'bodeguero.php' => 'Inicio',
    'bodeguero_compras.php' => 'Comprar material',
    'bodeguero_nueva_compra.php' => 'Comprar nuevo material',
    'bodeguero_ver_compras.php' => 'Ver Materiales'
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