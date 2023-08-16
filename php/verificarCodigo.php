<?php
include('dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $inputCodigo = $_POST["codigo"];
    $materiales = mysqli_query($con,"SELECT codigo_material FROM materiales;");
    $row = mysqli_fetch_assoc($materiales);
    
    if ($inputCodigo === $row['codigo_material']) {
        echo "existe";
    } else {
        echo "no_existe";
    }
}
?>
