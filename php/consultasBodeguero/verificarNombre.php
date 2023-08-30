<?php
include('dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombreMaterial"])) {
    $nombreMaterial = strtolower($_POST["nombreMaterial"]); // Convertir a minúsculas
    
    $sql = "SELECT COUNT(*) AS count FROM materiales WHERE LOWER(nombre_material) = '$nombreMaterial'";
    $result = $con->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["count"] > 0) {
            echo "Existe"; // El nombre ya existe en la base de datos
        } else {
            echo "NoExiste"; // El nombre está disponible
        }
    } else {
        echo "Error en la consulta";
    }
} else {
    echo "Error";
}
?>
