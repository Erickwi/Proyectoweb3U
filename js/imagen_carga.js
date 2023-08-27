function subirImagen(numero) {
    var input = document.getElementById('subirMaterial');
    var archivo = input.files[0];
    
    if (archivo) {
      var lector = new FileReader();
      lector.onload = function(event) {
        var imagenDataUrl = event.target.result;
        mostrarImagen(imagenDataUrl, numero);
      };
      lector.readAsDataURL(archivo);
    }
  }
  
  function mostrarImagen(dataUrl, numero) {
    var contenedor = document.getElementById('imagenContenedor');
    contenedor.innerHTML = ''; // Limpiar el contenido previo del contenedor
  
    var imagen = document.createElement('img');
    imagen.src = dataUrl;
    contenedor.appendChild(imagen);
  }