function cargarAbecedario() {
    var letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var selectList = document.querySelectorAll('.contenedor select[id^="letra"]');
  
    for (var i = 0; i < selectList.length && i < 3; i++) {
      var select = selectList[i];
  
      for (var j = 0; j < letras.length; j++) {
        var option = document.createElement('option');
        option.value = letras[j];
        option.text = letras[j];
        select.appendChild(option);
      }
    }
  }
  
  // Llamada a la función para cargar el abecedario en los primeros 3 select
  cargarAbecedario();
  
  function cargarNumeros() {
    var numeros = '0123456789';
    var selectList = document.querySelectorAll('.contenedor select[id^="numero"]');
  
    for (var i = 0; i < selectList.length && i < 3; i++) {
      var select = selectList[i];
  
      for (var j = 0; j < numeros.length; j++) {
        var option = document.createElement('option');
        option.value = numeros[j];
        option.text = numeros[j];
        select.appendChild(option);
      }
    }
  }
  
  // Llamada a la función para cargar los números del cero al nueve en los últimos 3 select
  cargarNumeros();

  
  
  