function ingresoProductos() {
  var codigo = document.getElementById('productos').value;

  $.ajax({
    type: 'POST',
    url: 'codigo_producto.php', // Reemplaza con la ruta correcta a tu archivo PHP
    data: { codigo: codigo },
    success: function(response) {
      if (response === 'repetido') {
         document.getElementById('productos').value='Ya existe';
      } 
    }
  });
}
