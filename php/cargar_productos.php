<?php  
include('dbconnection.php');
if (isset($_POST['codigo_buscar'])) {
  $codigo_buscar = $_POST['codigo_buscar'];
  $query = "SELECT * from  productos where id_productos='$codigo_buscar';";
  $materiales = mysqli_query($con, $query);
  if (mysqli_num_rows($materiales) == 0) {
    echo '<tr><th style="text-align:center; color:red;" colspan="6">No se han encontrado registros.</th></tr>';
  } else {
      while ($row = mysqli_fetch_assoc($materiales)) {
          echo '<tr>';
                          echo '<td>' . $row['codigo_productos'] . '</td>';
                          echo '<td>' . $row['nombre_productos'] . '</td>';
                          echo '<td><img src="' . $row['foto_producto'] . '"></td>';

                         
                          echo '</tr>';
      }
  }}
?>
