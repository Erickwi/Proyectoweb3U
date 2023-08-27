<?php
include('dbconnection.php');

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['tipo_usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../index.php');
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];
$nombre_usuario = $_SESSION['nombre_usuario'];
if ($tipo_usuario === 'bodeguero') {
     //Si es administrador, redirigir a la página de administrador
    header('Location: bodeguero.php');
    exit();
}elseif ($tipo_usuario === 'producción') {
    header('Location: produccion.php');
   exit();
}
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
	  <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- SweetAlert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.js"></script>
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css"
        />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
                <div class="nombre"><p><?php echo $nombre_usuario?></p></div>
                <div class="user-logo"><i class="fa-solid fa-user fa-2xl"></i></div>
            <div class="w3-dropdown-hover cerrarDrop">
                <button class="w3-button w3-light-gray w3-round-large cerrarDropBtn">Mi cuenta</button>
                <div class="w3-dropdown-content w3-bar-block w3-border">
                  <a id="cambiar_contraseña_btn" class="w3-bar-item w3-button">Cambiar contraseña</a>
                  <a id="cerrar_sesion_btn" class="w3-bar-item w3-button">Cerrar sesión</a>
                </div>
              </div>
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
                        <tr>
                            <th>Fecha de Creación</th>
                            <td><?php  echo $row['fecha'];?></td>
                            <th>Estado del Usuario</th>
                            <td>
                                <?php
                                    if ($row['activo'] == 0) {
                                        echo "Activo";
                                    } elseif ($row['activo'] == 1) {
                                        echo "Desactivado";
                                    }
                                ?>
                            </td>
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
	<script src="../js/cerrarSesion.js"></script>
</body>
</html>
