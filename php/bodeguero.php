<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ../index.php');
    exit();
}

$usuario = $_SESSION['usuario'];
if ($usuario === 'admin') {
    // Si es administrador, redirigir a la página de administrador
    header('Location: administrador.php');
    exit();
}elseif ($usuario === 'user') {
    header('Location: usuario.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Usuario</title>
</head>
<body>
    <h2>Bienvenido bodeguero, <?php echo $_SESSION['usuario']; ?></h2>
    <p>Esta es una página protegida que solo puedes ver si has iniciado sesión correctamente.</p>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>