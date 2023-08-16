
function updatePlaceholder() {
  var now = new Date();
  var horas = now.getHours();
  var minutos = now.getMinutes();
  var segundos = now.getSeconds();
  var tiempo = horas + ':' + minutos + ':' + segundos + ' ' + now.getDate() + '/' + (now.getMonth() + 1) + '/' + now.getFullYear();

  document.getElementById('fecha_compra').placeholder = tiempo;
}

setInterval(updatePlaceholder, 1000); // Actualiza cada segundo
