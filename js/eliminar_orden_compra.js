//ELIMINAR EN ORDEN

$(".disminuir_orden").click(function(e) {
    e.preventDefault();

    // Mostrar la alerta de confirmación para eliminar item
    Swal.fire({
        icon: 'warning',
        title: '¿Deseas eliminar este item de la orden?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Mostrar un segundo Swal.fire en caso de confirmación
            Swal.fire({
                icon: 'success',
                title: 'Eliminado con éxito'
            });
        } else {
            // No hacer nada en caso de que se haga clic en "Cancelar"
        }
    });
});


//ELIMINAR EN COMPRA
$("#disminuir_compra").click(function(e) {
    e.preventDefault();

    // Mostrar la alerta de confirmación para cerrar sesión
    Swal.fire({
        icon: 'warning',
        title: '¿Deseas eliminar este item de la orden?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            // Mostrar un segundo Swal.fire en caso de confirmación
          // Si el usuario confirma eliminar el item, se elimina columna
         /*
          PONER LA LOGICA AQUI
              window.location.href = "../php/logout.php";
          }*/
            Swal.fire({
                icon: 'success',
                title: 'Eliminado con éxito'
            });
        } else {
            // No hacer nada en caso de que se haga clic en "Cancelar"
        }
    });
});