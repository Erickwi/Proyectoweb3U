$("#formAgregarUsuario").submit(function(e) {
  e.preventDefault(); // Prevenir el envío del formulario por defecto
	// Validar el formulario antes de proceder
  if (!validarFormulario($(this))) {
    return; // No se ejecuta el código AJAX si no es válido
  }
	var formData = $(this).serialize(); // Serializar los datos del formulario
	$.ajax({
    type: 'POST',
    url: '../php/consultaAgregarUsuario.php',
	data: formData,
    success: function(response) {
		if (response === "Exito") {
            console.log("La inserción fue exitosa.");
            Swal.fire({
                icon: 'success',
                title: 'Usuario agregado con éxito'
        	});
		}else{
			Swal.fire({
                icon: 'error',
                title: 'Ocurrió un error al agregar un usuario'
        	});
		}
    },
        error: function(xhr, status, error) {
          console.log("Error en la petición AJAX: " + error);
        }
  });
});

 function validarFormulario(formulario) {
  var nombre = formulario.find("input[name='nombre']").val();
  var apellido = formulario.find("input[name='apellido']").val();
  var cedula = formulario.find("input[name='cedula']").val();
  var tipoEmpleado = formulario.find("select[name='tipo_empleado']").val();
  var nombreUsuario = formulario.find("input[name='user']").val();
  var password = formulario.find("input[name='contraseña']").val();

  // Verificar que ningún campo obligatorio esté en blanco
  if (!nombre || !apellido || !cedula || !tipoEmpleado || !nombreUsuario || !password) {
    Swal.fire({
      icon: 'error',
      title: 'Campos incompletos',
      text: 'Todos los campos son obligatorios. Por favor, complete todos los campos.'
    });
    return false;
  }
	 if (!validarCedulaEcuador(cedula)) {
    Swal.fire({
      icon: 'error',
      title: 'Cédula incorrecta',
      text: 'La cédula ingresada no es válida según las normas de Ecuador.'
    });
    return false;
  }

	 return true;
}

function validarCedulaEcuador(cedula) {
  // Verificar que la cédula tenga 10 dígitos
  if (cedula.length !== 10) {
    return false;
  }

  // Obtener los dígitos en posiciones impares y pares
  const impares = [parseInt(cedula[0]), parseInt(cedula[2]), parseInt(cedula[4]), parseInt(cedula[6]), parseInt(cedula[8])];
  const pares = [parseInt(cedula[1]), parseInt(cedula[3]), parseInt(cedula[5]), parseInt(cedula[7])];

  // Multiplicar por 2 los dígitos en posiciones impares
  const imparesMultiplicados = impares.map(digito => {
    const resultado = digito * 2;
    return resultado > 9 ? resultado - 9 : resultado;
  });

  // Sumar los dígitos de los arreglos pares e impares
  const sumaImpares = imparesMultiplicados.reduce((sum, digito) => sum + digito, 0);
  const sumaPares = pares.reduce((sum, digito) => sum + digito, 0);

  // Calcular el módulo 10 de la suma total
  const sumaTotal = sumaImpares + sumaPares;
  const modulo10 = sumaTotal % 10;

  // Calcular el dígito verificador esperado
  const digitoVerificadorEsperado = modulo10 === 0 ? 0 : 10 - modulo10;

  // Obtener el último dígito de la cédula (dígito verificador real)
  const digitoVerificadorReal = parseInt(cedula[9]);

  // Comparar el dígito verificador esperado con el real
  return digitoVerificadorEsperado === digitoVerificadorReal;
}