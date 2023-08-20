<?php
include('dbconnection.php');

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['tipo_usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../index.php');
    exit();
}

$nombre_usuario = $_SESSION['nombre_usuario'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detalles del Usuario</title>
    <link rel="icon" href="../img/icon_logo.png" type="image/png" sizes="32x32"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href="../css/estilo_administrador.css" rel="stylesheet" type="text/css" />
    <link href="../css/sidenav.css" rel="stylesheet" type="text/css" />
    <link href="../css/estiloInfoUs.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
    include "sidenav_admin_module.php"
  ?>

<div class="principal">
    <main id="main">
        <div class="encabezado">
            <div class="logo"><img src="../img/logo_alternativo.png"></div>
            <div class="informacion">
                <div class="nombre">
                    <p style="font-weight: bold; font-size: 24px; font-family: 'Times New Roman', Times, serif; color: blue;"><?php echo $nombre_usuario ?></p>
                </div>
                <div class="user-logo"> <img src="../img/usuario-logo.png" alt=""></div>
                <div class="cerrar"><p> <a href="logout.php">Cerrar Sesión</a></p> </div>
            </div>
        </div>
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
    </main>
</div>
<script src="../js/sidenav.js"></script>   
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2 style="font-weight: bold; color: #333;">Detalles del Usuario</h2>
                    </div>
                </div>
            </div>
            <table class="display table table-bordered" id="hidden-table-info">
                <tbody>
                    <?php
                    $vid = $_GET['viewid'];
                    $ret = mysqli_query($con, "SELECT * FROM usuario WHERE id_usuario = $vid");
                    $cnt = 1;
                    while ($row = mysqli_fetch_array($ret)) {
                        ?>
                        <tr>
                            <th>ID del Usuario</th>
                            <td><?php echo $row['id_usuario']; ?></td>
                            <th>Cédula</th>
                            <td><?php echo $row['cedula']; ?></td>
                        </tr>
                        <tr>
                            <th>Nombre</th>
                            <td><?php echo $row['nombre']; ?></td>
                            <th>Apellido</th>
                            <td><?php echo $row['apellido']; ?></td>
                        </tr>
                        <tr>
                            <th>Usuario</th>
                            <td><?php echo $row['usuario']; ?></td>
                            <th>Contraseña</th>
                            <td><?php echo $row['contraseña']; ?></td>
                        </tr>
                        <tr style="text-align: center;">
                            <th>Tipo de Empleado</th>
                            <td colspan="3"><?php echo $row['tipo_usuario']; ?></td>
                        </tr>
                        <?php
                        $cnt = $cnt + 1;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>
<center>
    <a href="./verUsuarios.php"><i class="material-icons" style="vertical-align: middle;">keyboard_arrow_left</i> Regresar a los usuarios</a>
</center>
</body>
</html>
