<!DOCTYPE html>
<html>
<head>
  <title>Formulario de Tarjeta de Crédito</title>
  <script>
    function validarTarjeta() {
      var numeroTarjeta = document.getElementById("numero_tarjeta").value;
      var fechaVencimiento = document.getElementById("fecha_vencimiento").value;
      var cvv = document.getElementById("cvv").value;
      var nombreTitular = document.getElementById("nombre_titular").value;

      // Validar número de tarjeta (se debe implementar el algoritmo de Luhn)
      var numeroTarjetaValido = validarNumeroTarjeta(numeroTarjeta);

      // Validar fecha de vencimiento
      var fechaValida = false;

      var formatoValido = /^(0[1-9]|1[0-2])([\/\s-]?)\d{2}$|^(0[1-9]|1[0-2])\d{2}$|^([1-9]|0[1-9]|1[0-2])(\s+)\d{2}$/; // Expresión regular para validar los formatos mmyy, mm/yy, mm-yy, mm yy y mmyy

      if (formatoValido.test(fechaVencimiento)) {
        var separador = fechaVencimiento.charAt(2); // Obtener el separador utilizado (puede ser /, espacio o -)

        var partes = fechaVencimiento.split(separador); // Dividir la fecha en mes y año

        var mes = parseInt(partes[0], 10);
        var anio = parseInt(partes[1], 10);

        var fechaActual = new Date();
        var mesActual = fechaActual.getMonth() + 1; // El mes actual es devuelto en base 0 (0-11)
        var anioActual = fechaActual.getFullYear() % 100; // Obtener el año actual en formato yy

        if (anio >= anioActual && anio <= anioActual + 10) {
          if (anio === anioActual) {
            fechaValida = mes >= mesActual; // El mes debe ser mayor o igual al mes actual
          } else {
            fechaValida = true; // La fecha es válida si el año es mayor o igual al actual
          }
        }
      }

      // Validar CVV (código de seguridad)
      var cvvValido = /^\d{3}$/.test(cvv); // Se permite un CVV de 3 dígitos

      // Validar nombre del titular
      var nombreValido = nombreTitular.trim() !== "";

      // Mostrar mensajes de validación
      if (!numeroTarjetaValido) {
        alert("Número de tarjeta inválido. Ingrese solo el numero, sin espacios ni guiones.");
      } else if (!fechaValida) {
        alert("Fecha de vencimiento inválida. Verifica la fecha ingresada.");
      } else if (!cvvValido) {
        alert("CVV inválido. Verifica el código de seguridad ingresado.");
      } else if (!nombreValido) {
        alert("Porfavor ingrese el nombre del titular.");
      } else {
        alert("¡Tarjeta válida! Puedes proceder con el pago.");
      }
    }

    function validarNumeroTarjeta(numero) {
      // Eliminar todos los espacios en blanco y guiones del número de tarjeta
      var numeroSinEspacios = numero.replace(/\s/g, '');
      // Verificar que todos los caracteres sean dígitos
      if (!/^\d+$/.test(numeroSinEspacios)) {
        return false;
      }
      var suma = 0;
      var doble = false;
      // Recorrer el número de tarjeta de derecha a izquierda
      for (var i = numeroSinEspacios.length - 1; i >= 0; i--) {
        var digito = parseInt(numeroSinEspacios.charAt(i), 10);
        if (doble) {
          // Si el dígito está en una posición par, se duplica
          digito *= 2;
          // Si el resultado de la duplicación es mayor o igual a 10, se suman los dígitos individuales
          if (digito >= 10) {
            digito = digito.toString();
            digito = parseInt(digito.charAt(0), 10) + parseInt(digito.charAt(1), 10);
          }
        }
        suma += digito;
        doble = !doble;
      }
      // El número de tarjeta es válido si la suma total es divisible por 10
      return suma % 10 === 0;
    }
  </script>
</head>
<body>
  <h1>Formulario de Tarjeta de Crédito</h1>

  <form>
    <label for="numero_tarjeta">Número de Tarjeta:</label>
    <input type="text" id="numero_tarjeta" name="numero_tarjeta" required pattern="\d{13,16}" title="Ingrese un número de tarjeta válido de 13 a 16 dígitos">
    <br><br>
    <label for="nombre_titular">Nombre del Titular:</label>
    <input type="text" id="nombre_titular" name="nombre_titular" required>
    <br><br>
    <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
    <input type="text" id="fecha_vencimiento" name="fecha_vencimiento" required placeholder="MM/YY o MMYY">
    <br><br>
    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" name="cvv" required pattern="\d{3}" title="Ingrese un CVV válido de 3 dígitos">
    <br><br>
    <button type="button" onclick="validarTarjeta()">Enviar</button>
  </form>
</body>
</html>
