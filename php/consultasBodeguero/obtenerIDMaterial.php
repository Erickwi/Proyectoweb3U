<?php
include('dbconnection.php');

$id_material = $_POST["id_material"];
$query = "SELECT id_materiales FROM materiales WHERE id_materiales = '$id_material'";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $material = mysqli_fetch_assoc($result);
    echo json_encode($material);
} else {
    echo json_encode(array("error" => "Material no encontrado"));
}
?>
