$('#buscar_inventario_btn').click(function(e) {
  e.preventDefault();
  var codigoBuscar = $('#codigo_buscar_material').val();
  // Validate that the input contains only letters
  if (!/^[a-zA-Z]+$/.test(codigoBuscar)) {
    Swal.fire({
        icon: 'error',
        title: 'Campo invalido',
        text: 'Ingresa solo letras'
    });
    return;
  }
  $.ajax({
    type: 'POST',
    url: '../php/buscarInventario.php',
    data: { codigo_buscar: codigoBuscar },
    success: function(response) {
      $('#tabla_body_inventario').html(response);
    }
  });
  $("#restablecer_inventario_btn").removeAttr("disabled");
});

$('#restablecer_inventario_btn').click(function(e) {
  e.preventDefault();
  cargarTodosRegistrosOrden();
  $("#restablecer_inventario_btn").prop("disabled", true);
  $("input[type='text']").val("");
});

cargarTodosRegistrosOrden();

function cargarTodosRegistrosOrden() {
  $.ajax({
    type: 'GET',
    url: '../php/cargarDatosInventario.php',
    success: function(response) {
      $('#tabla_body_inventario').html(response);
    }
  });
}