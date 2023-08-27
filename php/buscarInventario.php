<?php
include('dbconnection.php');
  $material_buscar = mysqli_real_escape_string($con, $_POST['codigo_buscar']); 
  $query = "SELECT inventarios_total.*, CONCAT(usuario.nombre, ' ', usuario.apellido) AS Usuario
FROM inventarios_total
JOIN usuario ON inventarios_total.usuario_id_usuario = usuario.id_usuario
WHERE inventarios_total.detalle_inventario = '$material_buscar';";
  $materiales = mysqli_query($con, $query);
  if (mysqli_num_rows($materiales) == 0) {
    echo '<tr><th style="text-align:center; color:red;" colspan="6">No se han encontrado registros.</th></tr>';
  } else {
      while ($row = mysqli_fetch_assoc($materiales)) {
          echo '<tr>';
          echo '<td>' . $row['id_inventario'] . '</td>';
          echo '<td>' . $row['codigo_inventario'] . '</td>';
          echo '<td>' . $row['fecha_inventario'] . '</td>';
          echo '<td>' . $row['detalle_inventario'] . '</td>';
          echo '<td>' . $row['cantidad_inventario'] . '</td>';
          echo '<td>' . "$". $row['precio_unitario_inventario'] . '</td>';
          echo '<td>' . "$". number_format($row['precio_total'], 2) . '</td>';
		  echo '<td>' . $row['tipo_proceso'] . '</td>';
          echo '<td>' . $row['Usuario'] . '</td>';
          echo '</tr>';
      }
  }
?>
