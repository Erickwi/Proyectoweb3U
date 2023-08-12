<?php
//database connection file
include('dbconnection.php');

//Code for deletion
if (isset($_GET['delid'])) {
    $rid = intval($_GET['delid']);
    $sql = mysqli_query($con, "DELETE FROM productos WHERE ID=$rid");
    echo "<script>alert('Data deleted');</script>";
    echo "<script>window.location.href = 'verUsuarios.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ver Usuarios</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/estilo.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href="../css/estilo_administrador.css" rel="stylesheet" type="text/css" />
    <link href="../css/sidenav.css" rel="stylesheet" type="text/css" />
    <style>
    .button {
        padding: 5px 16px; 
        border: none;
        border-radius: 5px;
        background-color: #3498db; 
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .button:hover {
        background-color: #5dbcd2; 
    }
    .search-bar {
        display: flex;
        align-items: center;
    }

    .search-bar input[type="text"] {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
    }
    </style>
</head>
<body>
<?php
    include "sidenav_admin_module.php"
  ?>

    <div class="principal">
      <main id="main">
    <div class="encabezado">
        <div class="logo"><img src="../img/LOGO1.png"></div>
        <div class="informacion">
            <div class="nombre"><p>Nombre del usuario</p></div>
            <div class="user-logo"> <img src="../img/usuario-logo.png" alt=""></div>
            <div class="cerrar"><p> <a href="logout.php">Cerrar Sesión</a></p> </div>
        </div>
    </div>
      
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
    </div> </main>  
    </div>
    <script src="../js/sidenav.js"></script>    
<center>
<h2><b>Usuarios Registrados</b></h2>
</center>

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="search-form">
                <form method="GET">
                <div class="search-bar">
                    <button type="submit" class="button">Buscar</button>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="search_cedula" placeholder="Ingrese cédula del Usuario">
                </div><br>
                </form>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cédula</th>
                        <th>Tipo Empleado</th>
                        <th>Usuario</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (isset($_GET['search_cedula'])) {
                    $searchCedula = mysqli_real_escape_string($con, $_GET['search_cedula']);
                    $query = "SELECT * FROM usuario WHERE cedula LIKE '%$searchCedula%'";
                    $ret = mysqli_query($con, $query);
                } else {
                    $ret = mysqli_query($con, "SELECT * FROM usuario");
                }

                while ($row = mysqli_fetch_assoc($ret)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id_usuario']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['apellido']; ?></td>
                        <td><?php echo $row['cedula']; ?></td>
                        <td><?php echo $row['tipo_usuario']; ?></td>
                        <td><?php echo $row['usuario']; ?></td>
                        <td>
                            <a href="php/read.php?viewid=<?php echo htmlentities($row['id_usuario']); ?>" class="view"
                               title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                            <a href="php/edit.php?editid=<?php echo htmlentities($row['id_usuario']); ?>" class="edit"
                               title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a href="index.php?delid=<?php echo ($row['id_usuario']); ?>" class="delete" title="Delete"
                               data-toggle="tooltip"
                               onclick="return confirm('Do you really want to Delete ?');"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    <?php
                    }
                    if (mysqli_num_rows($ret) == 0) {
                        ?>
                        <tr>
                            <th style="text-align:center; color:red;" colspan="6">No Record Found</th>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>
</body>
</html>
