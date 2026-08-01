function ingresoOrden() {
  var codigo = document.getElementById('codigo_orden1').value;

  $.ajax({
    type: 'POST',
    url: 'codigo_orden_p.php', // Reemplaza con la ruta correcta a tu archivo PHP
    data: { codigo: codigo },
    success: function(response) {
      if (response === 'repetido') {
         document.getElementById('codigo_orden1').value='Ya existe';
      } 
    }
  });
}
