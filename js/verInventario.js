$('#buscar_inventario_btn').click(function(e) {
  e.preventDefault();
  var nombreBuscar = $('#nombre_buscar_material').val();

  if (nombreBuscar.trim() === '') {
    Swal.fire({
        icon: 'error',
        title: 'Campo vacío',
        text: 'Ingresa un nombre antes de buscar.'
    });
    return;
  }

  const regex = /^[A-Za-z0-9\s/]+$/;
  if (!regex.test(nombreBuscar) || nombreBuscar.length > 45) {
    Swal.fire({
        icon: 'error',
        title: 'Campo inválido',
        text: 'Ingresa solo letras y asegúrate de que la longitud no exceda 45 caracteres.'
    });
    return;
  }

  $.ajax({
    type: 'POST',
    url: '../php/buscarInventario.php',
    data: { nombreBuscar: nombreBuscar },
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

//cargar inventario inicial
$('#primer_ingreso_btn').click(function(e) {
  e.preventDefault();
  cargarTodosRegistrosInventarioInicial();
  $("#restablecer_inventario_btn").prop("disabled", false);
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
function cargarTodosRegistrosInventario(){ 
  $.ajax({
    type: 'GET',
    url: '../php/cargarDatosInventario.php',
    success: function(response) {
     
      $('#tabla_body_inventario').html(response);
    }
  });
}
function cargarTodosRegistrosInventarioInicial(){ 
  $.ajax({
    type: 'GET',
    url: '../php/cargarDatosInventarioInicial.php',
    success: function(response) {
     
      $('#tabla_body_inventario').html(response);
    }
  });
}
