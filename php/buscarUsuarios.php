<?php
include('dbconnection.php');

if (isset($_GET['search_cedula'])) {
    $searchCedula = mysqli_real_escape_string($con, $_GET['search_cedula']);
    $query = "SELECT * FROM usuario WHERE cedula LIKE '%$searchCedula%'";
    $result = mysqli_query($con, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id_usuario']}</td>
                    <td>{$row['nombre']}</td>
                    <td>{$row['apellido']}</td>
                    <td>{$row['cedula']}</td>
                    <td>{$row['tipo_usuario']}</td>
                    <td>{$row['usuario']}</td>
                    <td>
                        <a href='./verInfoUsuario.php?viewid=" . htmlentities($row['id_usuario']) . "' class='view'
                           title='View' data-toggle='tooltip'><i class='material-icons'>&#xE417;</i></a>
                        <a href='edit.php?editid=" . htmlentities($row['id_usuario']) . "' class='edit'
                           title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>
                        <a href='index.php?delid=" . $row['id_usuario'] . "' class='delete' title='Delete'
                           data-toggle='tooltip'
                           onclick='return confirm(`Do you really want to Delete ?`);'><i class='material-icons'>&#xE872;</i></a>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr>
                <th style='text-align:center; color:red;' colspan='6'>No se han encontrado registros.</th>
            </tr>";
    }
} else {
    echo "<tr>
            <th style='text-align:center; color:red;' colspan='6'>No se ha especificado una cédula para la búsqueda.</th>
        </tr>";
}
?>
