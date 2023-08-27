<?php
include('dbconnection.php');

$searchCedula = "";

if (isset($_GET['search_cedula'])) {
    $searchCedula = mysqli_real_escape_string($con, $_GET['search_cedula']);
    $query = "SELECT * FROM usuario WHERE cedula LIKE '%$searchCedula%'";
    $result = mysqli_query($con, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr " . ($row['activo'] == 1 ? "style='background-color: #ffcccc;'" : "") . ">
                    <td>{$row['id_usuario']}</td>
                    <td>" . ($row['activo'] == 0 ? 'Activo' : 'Desactivado') . "</td>
                    <td>{$row['nombre']}</td>
                    <td>{$row['apellido']}</td>
                    <td>{$row['cedula']}</td>
                    <td>{$row['tipo_usuario']}</td>
                    <td>{$row['usuario']}</td>
                    <td>";
            
            if ($row['activo'] == 0) {
                echo "<a href='./verInfoUsuario.php?viewid=" . htmlentities($row['id_usuario']) . "' class='view'
                           title='View' data-toggle='tooltip'><i class='material-icons'>&#xE417;</i></a>
                      <a href='edit.php?editid=" . htmlentities($row['id_usuario']) . "' class='edit'
                           title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>
                      <a href='buscarUsuarios.php?delid=" . $row['id_usuario'] . "' class='delete' title='Delete'
                           data-toggle='tooltip'
                           onclick='return confirm(`Do you really want to Delete ?`);'><i class='material-icons'>&#xE872;</i></a>
                      <a href='buscarUsuarios.php?desactivar=" . $row['id_usuario'] . "' class='deactivate' title='Desactivar'
                           data-toggle='tooltip'><i class='material-icons' style='color: black;'>&#xE611;</i></a>";
            } elseif ($row['activo'] == 1) {
                echo "<a href='buscarUsuarios.php?activar=" . $row['id_usuario'] . "' class='activate' title='Activar'
                           data-toggle='tooltip'><i class='material-icons' style='color: green;'>&#xE876;</i></a>";
            }

            echo "</td>
                </tr>";
        }
    } else {
        echo "<tr>
                <th style='text-align:center; color:red;' colspan='6'>No se han encontrado registros.</th>
            </tr>";
    }
} else {
    
}

// Código para manejar las acciones de activar y desactivar
if (isset($_GET['desactivar'])) {
    $rid = intval($_GET['desactivar']);
    mysqli_query($con, "UPDATE usuario SET activo='1' WHERE id_usuario=$rid");
    header("Location: verUsuarios.php?search_cedula=$searchCedula");
    exit();
}

if (isset($_GET['activar'])) {
    $rid = intval($_GET['activar']);
    mysqli_query($con, "UPDATE usuario SET activo='0' WHERE id_usuario=$rid");
    header("Location: verUsuarios.php?search_cedula=$searchCedula");
    exit();
}
?>
