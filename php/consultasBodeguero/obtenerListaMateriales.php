<?php
include('dbconnection.php');

 $codigoMaterial=mysqli_query($con,"select * from materiales order by nombre_material");
  echo '<option value="" disabled selected>Seleccione un material</option>';
  while( $row=mysqli_fetch_array($codigoMaterial)){
      $id=$row['id_materiales'];
      $nombreMaterial=$row['nombre_material'];
                          
      echo '<option value="' . $id . '">' . $nombreMaterial . '</option>';

  }
?>
