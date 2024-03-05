function validarRut(input) {
            // Elimina espacios en blanco y puntos del RUT
            var rutSinFormato = input.value.replace(/[.-]/g, '');

            // Extrae el dígito verificador
            var dv = rutSinFormato.slice(-1);
            // Extrae el cuerpo del RUT
            var cuerpoRut = rutSinFormato.slice(0, -1);

            // Calcula el dígito verificador esperado
            var suma = 0;
            var multiplicador = 2;

            for (var i = cuerpoRut.length - 1; i >= 0; i--) {
                suma += multiplicador * parseInt(cuerpoRut.charAt(i), 10);
                multiplicador = multiplicador < 7 ? multiplicador + 1 : 2;
            }

            var dvEsperado = 11 - (suma % 11);

            // Convierte el dígito verificador a cadena para comparar
            dvEsperado = (dvEsperado === 11) ? '0' : (dvEsperado === 10) ? 'K' : dvEsperado.toString();

            // Compara el dígito verificador ingresado con el esperado
            if (dv.toUpperCase() === dvEsperado) {
                // El RUT es válido
                input.setCustomValidity('');
                //mostrarMensaje('RUT válido', true);
                //habilitarBoton(true);
            } else {
                // El RUT no es válido
                input.setCustomValidity('El RUT ingresado no es válido');
                //mostrarMensaje('RUT no válido', false);
                //habilitarBoton(false);
            }
        }

        function formatearRut(input) {
            var rut = input.value.replace(/[^\dkK]+/g, ''); // Remover caracteres no numéricos ni 'K'
            var rutFormateado = '';

            if (rut.length > 1) {
              var cuerpo = rut.slice(0, -1);
              var dv = rut.slice(-1).toUpperCase();

              while (cuerpo.length > 3) {
                rutFormateado = '.' + cuerpo.slice(-3) + rutFormateado;
                cuerpo = cuerpo.slice(0, -3);
              }
              rutFormateado = cuerpo + rutFormateado + '-' + dv;
            } else {
              rutFormateado = rut;
            }
            input.value = rutFormateado;
          }

        function mostrarMensaje(mensaje, esValido) {
            var mensajeElemento = document.getElementById('mensajeRut');
            mensajeElemento.innerHTML = mensaje;

            if (esValido) {
                mensajeElemento.style.color = 'green';
            } else {
                mensajeElemento.style.color = 'red';
            }
        }

        function habilitarBoton(habilitar) {
            var botonRegistrar = document.getElementById('btnRegistrar');
            botonRegistrar.disabled = !habilitar;
        }
	
	function checkRut(rut) {
// Despejar Punto1 (Sólo quito el primer punto que encuentre, que sería el punto del millón)
var valor = rut.value.replace('.','');
// Despejar Guión
valor = valor.replace('-','');
//Despejar Punto2 (Quito el punto de los miles que me queda)
valor = valor.replace('.','');

    // Aislar Cuerpo y Dígito Verificador
    cuerpo = valor.slice(0, -1);
    dv = valor.slice(-1).toUpperCase();

    // Formatear RUN
    rut.value = cuerpo + '-' + dv

    // Si no cumple con el mínimo ej. (n.nnn.nnn)
    if (cuerpo.length < 7) {
        rut.setCustomValidity("RUT Incompleto");
        return false;
    }

    // Calcular Dígito Verificador
    suma = 0;
    multiplo = 2;

    // Para cada dígito del Cuerpo
    for (i = 1; i <= cuerpo.length; i++) {

        // Obtener su Producto con el Múltiplo Correspondiente
        index = multiplo * valor.charAt(cuerpo.length - i);

        // Sumar al Contador General
        suma = suma + index;

        // Consolidar Múltiplo dentro del rango [2,7]
        if (multiplo < 7) {
            multiplo = multiplo + 1;
        } else {
            multiplo = 2;
        }

    }

    // Calcular Dígito Verificador en base al Módulo 11
    dvEsperado = 11 - (suma % 11);

    // Casos Especiales (0 y K)
    dv = (dv == 'K') ? 10 : dv;
    v = (dv == 0) ? 11 : dv;

    // Validar que el Cuerpo coincide con su Dígito Verificador
    if (dvEsperado != dv) {
        rut.setCustomValidity("RUT Invalido");
        return false;
    }

    // Si todo sale bien, eliminar errores (decretar que es válido)
    rut.setCustomValidity('');
}