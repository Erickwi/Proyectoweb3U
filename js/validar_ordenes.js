$(document).ready(function() {
  $('#submitOrdenBtn').click(function() {
	  var codigoBuscar = $('#codigo_orden1').val();
	  var cantidad = $('#cantidad_producto1').val().trim();
	  // Validar que la entrada sea un número entero
    if (!/^\d{5}$/.test(codigoBuscar)) {
      // Mostrar una alerta SweetAlert
      Swal.fire({
	        icon: 'error',
	        title: 'Oops...',
	        text: 'Ingresa un número entero de 5 dígitos en el campo de código.',
		});
		$("#codigo_orden1").val("");
	      return; // Detener el proceso si la entrada es inválida
    }
	  // Validación de campos de costo y cantidad
    if (cantidad === "") {
      Swal.fire({
        icon: 'error',
        title: 'Campo vacío',
        text: 'El campo cantidad no puede estar en blanco'
      });
      return;
    }
	  
    $.ajax({
      type: 'POST',
      url: 'muestraproducto.php', // Replace with the actual PHP script URL for Orden de producción
      data: $('#ordenProduccionForm').serialize(),
      success: function(response) {
       $('#informacionORDEN').html(response);
        // Handle response or update UI here
      },
      error: function() {
        alert('An error occurred while submitting Orden de producción data.');
      }
    });
  });

  $('#submitInfoBtn').click(function() {
    $.ajax({
      type: 'POST',
      url: 'produccion_orden (copy).php', // Replace with the actual PHP script URL for informacion-producto
      data: $('#ordenProduccionForm').serialize(),
      success: function(response) {
        $('#informacionProductoForm').html(response);
        // Handle response or update UI here
      },
      error: function() {
        alert('An error occurred while submitting Informacion producto data.');
      }
    });
  });
  $('#submitImprimir').click(function() {
   
    var codigoOrden = $('#codigo_orden1').val();
    var idUsuario = $('#id_usuario').val();
    var codigoBuscar = $('#codigo_orden1').val();
	  var cantidad = $('#cantidad_producto1').val().trim();
	  // Validar que la entrada sea un número entero
    if (!/^\d{5}$/.test(codigoBuscar)) {
      // Mostrar una alerta SweetAlert
      Swal.fire({
	        icon: 'error',
	        title: 'Oops...',
	        text: 'Ingresa un número entero de 5 dígitos en el campo de código.',
		});
		$("#codigo_orden1").val("");
	      return; // Detener el proceso si la entrada es inválida
    }
	  // Validación de campos de costo y cantidad
    if (cantidad === "") {
      Swal.fire({
        icon: 'error',
        title: 'Campo vacío',
        text: 'El campo cantidad no puede estar en blanco'
      });
      return;
    }
    $.ajax({
      type: 'POST',
      url: 'imprimir_orden.php', 
      data: { codigoOrden: codigoOrden }, 
      success: function(response) {
      var url = 'imprimir_orden.php?codigoOrden=' + encodeURIComponent(codigoOrden) + '&idUsuario=' + encodeURIComponent(idUsuario);
      window.open(url, '_blank');
    },
      error: function() {
        alert('Ocurrió un error al enviar los datos.');
      }
    });
  });



});