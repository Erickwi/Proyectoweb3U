$("#cerrar_sesion").click(function(e) {
    e.preventDefault();

    // Mostrar la alerta de confirmación para cerrar sesión
    Swal.fire({
        icon: 'question',
        title: '¿Deseas cerrar sesión?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cerrar sesión',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        // Si el usuario confirma cerrar sesión, redirige a la página de login
        if (result.isConfirmed) {
            window.location.href = "../php/logout.php";
        }
    });
});