<?php  
include('dbconnection.php');
  $query = "SELECT codigo_orden, max(o.fecha) as fechas,group_concat(nombre_productos,'/',cantidad_productos,'  ')  as Detalle, sum(costo_productos)  as total , MAX(concat(nombre,' ',apellido)) as Usuario from ordenes_produccion o, productos p, usuario u where o.productos_id_productos=p.id_productos and u.id_usuario=o.usuario_id_usuario group by o.codigo_orden;
"; 
  $materiales = mysqli_query($con, $query);
  if (mysqli_num_rows($materiales) == 0) {
    echo '<tr><th style="text-align:center; color:red;" colspan="6">No se han encontrado registros.</th></tr>';
  } else {
      while ($row = mysqli_fetch_assoc($materiales)) {
         echo '<tr>';
          echo '<td>' . $row['codigo_orden'] . '</td>';
          echo '<td>' . $row['fechas'] . '</td>';
          echo '<td>' . $row['Detalle'] . '</td>';
          echo '<td>' . "$". number_format($row['total'], 2) . '</td>';
          echo '<td>' . $row['Usuario'] . '</td>';
          echo '</tr>';
      }
  }
?>
