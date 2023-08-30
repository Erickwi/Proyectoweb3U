<?php

include('dbconnection.php');
session_start();

if (!isset($_SESSION['tipo_usuario'])) {
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

if (isset($_GET['delid'])) {
    $rid = intval($_GET['delid']);
    $sql = mysqli_query($con, "DELETE FROM usuario WHERE id_usuario=$rid");
    echo "<script>alert('Usuario Eliminado Correctamente');</script>";
    echo "<script>window.location.href = 'verUsuarios.php'</script>";
}

if (isset($_GET['desactivar'])) {
    $rid = intval($_GET['desactivar']);
    $sql = mysqli_query($con, "UPDATE usuario SET activo='1' WHERE id_usuario=$rid");
    echo "<script>window.location.href = 'verUsuarios.php'</script>";
}

if (isset($_GET['activar'])) {
    $rid = intval($_GET['activar']);
    $sql = mysqli_query($con, "UPDATE usuario SET activo='0' WHERE id_usuario=$rid");
    echo "<script>window.location.href = 'verUsuarios.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ver Usuarios</title>
    <link rel="icon" href="../img/icon_logo.png" type="image/png" sizes="32x32"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="css/estilo.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href="../css/estilo_administrador.css" rel="stylesheet" type="text/css" />
    <link href="../css/sidenav.css" rel="stylesheet" type="text/css" />
    <link href="../css/estiloBuscarCed.css" rel="stylesheet" type="text/css" />
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
    <script>
        $(document).ready(function() {
            $(".search-form").submit(function(event) {
                event.preventDefault();
                var searchCedula = $("input[name='search_cedula']").val();
                $.ajax({
                    url: "buscarUsuarios.php",
                    type: "GET",
                    data: { search_cedula: searchCedula },
                    success: function(response) {
                        $(".table tbody").html(response);
                    }
                });
            });
        });
    </script>
</head>
<body>
      <?php
        if($tipo_usuario === "administrador"){
          include ("sidenav_admin_module.php");
        }else{
          include ("sidenav_super_module.php");
        }
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
    <center>
        <h2><b>Usuarios Registrados</b></h2>
    </center>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="search-form">
                    <form method="GET">
                        <div class="search-bar">
                        <span class="search-text">Usuario a buscar:</span>
                            <input type="text" name="search_cedula" placeholder="Ingrese cédula del Usuario"> 
                            <div class="loader">
                                <i class="fa fa-spinner fa-spin"></i>
                            </div>
                        </div><br>
                    </form>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Estado</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Cédula</th>
                            <th>Tipo Empleado</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
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
                            <tr <?php echo $row['activo'] == 1 ? 'style="background-color: #ffcccc;"' : ''; ?>>
                                <td><?php echo $row['id_usuario']; ?></td>
                                <td><?php echo $row['activo'] == 0 ? 'Activo' : 'Desactivado'; ?></td>
                                <td><?php echo $row['nombre']; ?></td>
                                <td><?php echo $row['apellido']; ?></td>
                                <td><?php echo $row['cedula']; ?></td>
                                <td><?php echo $row['tipo_usuario']; ?></td>
                                <td><?php echo $row['usuario']; ?></td>
                                <td>
                                    <?php if ($row['activo'] == 0) { ?>
                                        <a href="./verInfoUsuario.php?viewid=<?php echo htmlentities($row['id_usuario']); ?>" class="view"
                                            title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                        <a href="edit.php?editid=<?php echo htmlentities($row['id_usuario']); ?>" class="edit"
                                            title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                        <a href="verUsuarios.php?delid=<?php echo ($row['id_usuario']); ?>" class="delete" title="Delete"
                                            data-toggle="tooltip"
                                            onclick="return confirm('Realmente desea eliminar este Usuario?');"><i class="material-icons">&#xE872;</i></a>
                                        <a href="verUsuarios.php?desactivar=<?php echo ($row['id_usuario']); ?>" class="deactivate"
                                            title="Desactivar" data-toggle="tooltip"><i class="material-icons" style="color: black;">&#xE611;</i></a>
                                    <?php } elseif ($row['activo'] == 1) { ?>
                                        <a href="verUsuarios.php?activar=<?php echo ($row['id_usuario']); ?>" class="activate"
                                            title="Activar" data-toggle="tooltip"><i class="material-icons" style="color: green;">&#xE876;</i></a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php
                        }
                        if (mysqli_num_rows($ret) == 0) {
                            ?>
                            <tr>
                                <th style="text-align:center; color:red;" colspan="6">No se han encontrado registros.</th>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(".search-form").submit(function(event) {
                event.preventDefault();
                var searchCedula = $("input[name='search_cedula']").val();
                $(".loader").show(); // Mostrar el ícono de carga
                $.ajax({
                    url: "buscarUsuarios.php",
                    type: "GET",
                    data: { search_cedula: searchCedula },
                    success: function(response) {
                        $(".table tbody").html(response);
                    },
                    complete: function() {
                        $(".loader").hide(); // Ocultar el ícono de carga después de completar la solicitud
                    }
                });
            });
        });
    </script>
	<script src="../js/cerrarSesion.js"></script>
</body>
</html>
