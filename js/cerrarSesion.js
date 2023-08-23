$("#cerrar_sesion_btn").click(function() {
    // Mostrar la alerta de confirmación para cerrar sesión
    Swal.fire({
        icon: 'question',
        title: '¿Deseas cerrar sesión?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cerrar sesión',
        cancelButtonText: 'Cancelar',
        allowOutsideClick: false
    }).then((result) => {
        // Si el usuario confirma cerrar sesión, redirige a la página de login
        if (result.isConfirmed) {
            window.location.href = "../php/logout.php";
        }
    });
});

$("#cambiar_contraseña_btn").click(function() {
  // Mostrar la alerta de cambio de contraseña
  Swal.fire({
	  title: 'Cambiar contraseña',
	  html:
	    '<input id="password-input" class="swal2-input" type="password" placeholder="Ingresa la nueva contraseña">' +
	    '<input id="confirm-password-input" class="swal2-input" type="password" placeholder="Confirma la contraseña">',
	  focusConfirm: false,
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Confirmar',
	  cancelButtonText: 'Cancelar',
	  allowOutsideClick: false,
	  preConfirm: () => {
	    const password = document.getElementById('password-input').value;
	    const confirmPassword = document.getElementById('confirm-password-input').value;
	
	    if (!password) {
	      Swal.showValidationMessage('Por favor, ingresa una contraseña');
	    } else if (password !== confirmPassword) {
	      Swal.showValidationMessage('Las contraseñas no coinciden');
	    }
	
	    return { password: password.toString(), confirmPassword: confirmPassword.toString() };
	  }
	}).then((result) => {
	  if (result.isConfirmed) {
	    const nuevaContraseña = result.value.password;
	    $.ajax({
	      type: 'POST',
	      url: '../php/cambioContraseña.php',
	      data: { password: nuevaContraseña },
	      success: function(response) {
	        if (response === "success") {
	          Swal.fire({
	            icon: 'success',
	            title: 'Cambio de contraseña exitoso'
	          });
	        } else {
	          console.log("Error en el cambio de contraseña");
	        }
	      },
	      error: function(xhr, status, error) {
	        console.log("Error en la solicitud AJAX: " + error);
	      }
	    });
	  }
	});
});

