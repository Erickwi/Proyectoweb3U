<?php
include('dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["codigo"])) {
    $codigo = $_POST["codigo"];
    
    $sql = "SELECT COUNT(*) AS count FROM materiales WHERE codigo_material = '$codigo'";
    $result = $con->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["count"] > 0) {
            echo "Existe"; // El código ya existe en la base de datos
        } else {
            echo "NoExiste"; // El código está disponible
        }
    } else {
        echo "Error en la consulta";
    }
} else {
    echo "Error";
}
?>
