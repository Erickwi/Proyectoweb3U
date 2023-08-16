//en swalfire cambiar solo id del formulario y las consultas

$(".aumentar_cantidad").click(function(e) {
    e.preventDefault();
    var cantidadInput = $(this).closest(".w3-row").find(".cantidad_compra");
    var cantidadActual = parseInt(cantidadInput.val()) || 0;
    cantidadInput.val(cantidadActual + 1);
});

$(".disminuir_cantidad").click(function(e) {
    e.preventDefault();
    var cantidadInput = $(this).closest(".w3-row").find(".cantidad_compra");
    var cantidadActual = parseInt(cantidadInput.val()) || 0;
    if (cantidadActual > 1) {
      cantidadInput.val(cantidadActual - 1);
    }
});

$('input[value="Guardar"]').click(function(e) {
    e.preventDefault();
    Swal.fire({
        icon: 'question',
        title: '¿Deseas realizar esta compra?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: 'Compra realizada con éxito'
            });
        }
    });
});  
//verificar que no se repitan los codigos 


$("#codigo_compra_opcion").change(function() {
  if ($(this).val() === "nuevo_codigo") {
    document.title= "Añadir producto";
    $('.titulo_compras').text("Añadir producto a inventario");
    $(".guardar_btn").attr("value","Añadir producto");
    $(".guardar_btn").addClass("w3-blue");
    $(".disminuir_cantidad, .aumentar_cantidad, .cantidad_compra, .costo_compra, .detalle_compra, #total_compra").removeAttr("disabled");
  } else if($(this).val() !== ""){
    document.title= "Hacer compras";
    $('.titulo_compras').text("Compras");
    $(".guardar_btn").attr("value","Guardar");
    $(".guardar_btn").removeClass("w3-blue");
    $(".disminuir_cantidad, .aumentar_cantidad, .cantidad_compra, .costo_compra, .detalle_compra, #total_compra").removeAttr("disabled");
    $.ajax({
        type: "POST",
        url: "../php/obtenerMaterial.php", // Archivo PHP que obtiene los detalles del codigo seleccionado en el select
        data: { codigo: inputCodigo },
        success: function(response) {
            if (response === "existe") {
                Swal.fire(
                    '¡Código verificado!',
                    'El material existe en el inventario, puede continuar con la compra',
                    'success'
                );
                $(".disminuir_cantidad, .aumentar_cantidad, .cantidad_compra, .costo_compra, .detalle_compra, #total_compra").removeAttr("disabled");
            } else {
                $(".disminuir_cantidad, .aumentar_cantidad, .cantidad_compra, .costo_compra, .detalle_compra, #total_compra").attr("disabled", "disabled");
            }
        }
    });
  }else {
    console.log("No se ha seleccionado ninguna opción");
  }
});
