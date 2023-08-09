<?php
include('php/dbconnection.php');
session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['usuario'])) {
    // Redirigir según el rol del usuario
    redirigirSegunRol($_SESSION['usuario']);
    exit();
}

// Verificar las credenciales y si son válidas, guardar los datos del usuario en la sesión
if (isset($_POST['usuario']) && isset($_POST['contraseña'])) {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    if (credenciales_son_validas($usuario, $contraseña)) {
        $tipo_usuario = obtener_tipo_usuario($usuario);
        $_SESSION['usuario'] = $tipo_usuario;
        redirigirSegunRol($tipo_usuario);
        exit();
    } else {
        $mensajeError = "Credenciales inválidas. Inténtalo nuevamente.";
    }
}

function obtener_tipo_usuario($usuario) {
    global $con;
    $query = "SELECT tipo_usuario FROM usuario WHERE usuario='$usuario'";
    $result = mysqli_query($con, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['tipo_usuario'];
    }
    return false;
}

function credenciales_son_validas($usuario, $contraseña) {
    global $con;
    $query = "SELECT contraseña FROM usuario WHERE usuario='$usuario'";
    $result = mysqli_query($con, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $contraseña_db = $row['contraseña'];
        // Verificar contraseña sin funciones de hash
        if ($contraseña === $contraseña_db) {
            return true;
        }
    }
    return false;
}

function redirigirSegunRol($tipo_usuario) {
    if ($tipo_usuario === 'producción') {
        header('Location: php/produccion.php');
    } elseif ($tipo_usuario === 'administrador') {
        header('Location: php/administrador.php');
    } elseif ($tipo_usuario === 'bodeguero') {
        header('Location: php/bodeguero.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="css/estilo_inicio.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="principal">
        <div class="Login">
            <div class="portada-login">
                <img src="img/portada1.jpg"/>
            </div>
            <div class="Inicio">
                <div class="Inicio-login">
                    <form action="index.php" method="post">
                        <label for="usuario">Usuario</label><br>
                        <input type="text" name="usuario" id="usuario"><br>
                        <label for="contraseña">Contraseña</label><br>
                        <input type="password" name="contraseña" id="contraseña"><?php if (isset($mensajeError)) { ?>
                        <p align="center"><?php echo $mensajeError; ?></p>
                    <?php } ?>
                        <input type="submit" name="button" id="button" value="Iniciar sesión">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
