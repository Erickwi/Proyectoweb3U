//en swalfire cambiar solo id del formulario y las consultas

$(".aumentar_cantidad").click(function(e) {
    e.preventDefault();
    var cantidadInput = $(this).closest(".w3-row").find(".cantidad_orden");
    var cantidadActual = parseInt(cantidadInput.val()) || 0;
    cantidadInput.val(cantidadActual + 1);
});

$(".disminuir_cantidad").click(function(e) {
    e.preventDefault();
    var cantidadInput = $(this).closest(".w3-row").find(".cantidad_orden");
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

//Variable para verificar después que el usuario haya dejado de escribir en el campo del codigo
var debounceTimer;

$("#codigo_compra").on('input', function(){
    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(function() {
        var inputCodigo = $("#codigo_compra").val();

        // Mostrar animación de carga mientras se verifica el código
        $(".loading-spinner").show();

        $.ajax({
            type: "POST",
            url: "../php/verificarCodigo.php", // Archivo PHP que realizará la verificación
            data: { codigo: inputCodigo },
            success: function(response) {
                // Ocultar animación de carga
                $(".loading-spinner").hide();

                if (response === "existe") {
                    Swal.fire(
                        '¡Código verificado!',
                        'El material existe en el inventario, puede continuar con la compra',
                        'success'
                    );
                    $(".disminuir_cantidad, .aumentar_cantidad, .cantidad_compra, .costo_compra, .detalle_compra, #total_compra").removeAttr("disabled");
                    $('.titulo_compras').text("Compras");
                    $(".guardar_btn").attr("value","Guardar");
                    $(".guardar_btn").removeClass("w3-blue");
                    document.title = "Hacer compras";
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No existe el material con el código ingresado',
                        text: '¿Deseas realizar una nueva compra?',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí',
                        cancelButtonText: 'Cancelar',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('.titulo_compras').text("Añadir producto a inventario");
                            $(".guardar_btn").attr("value","Añadir producto");
                            $(".guardar_btn").addClass("w3-blue");
                            $(".disminuir_cantidad, .aumentar_cantidad, .cantidad_compra, .costo_compra, .detalle_compra, #total_compra").removeAttr("disabled");
                            document.title = "Añadir producto";
                        } else {
                            // Restaurar el estado original en caso de cancelación
                            $("#codigo_compra").val("");
                            $(".disminuir_cantidad, .aumentar_cantidad, .cantidad_compra, .costo_compra, .detalle_compra, #total_compra").attr("disabled", "disabled");
                        }
                    });
                }
            }
        });
    }, 1000);
});
