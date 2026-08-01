function ingresoCedula() {
  var codigo = document.getElementById('cedula').value;
  $.ajax({
    type: 'POST',
    url: 'cedula_ingreso.php', // Reemplaza con la ruta correcta a tu archivo PHP
    data: { codigo: codigo },
    success: function(response) {
      if (response === 'repetido') {
         document.getElementById('cedula').value='Ya existe';
        ingresoCedula();
      }
    }
  });
}
