  $(document).ready(function() {    
  $("#parSelec").change(function() {
    var parqueaderoSeleccionado = $(this).val();
    obtenerDatosParqueadero(parqueaderoSeleccionado);
  });
});

function cargarSelectHoras(inicio, maximo) {
  var select = document.getElementById('mm1S');
  var selectHora = document.getElementById('hh');

  // Eliminar todas las opciones existentes
  while (select.options.length > 0) {
    select.remove(0);
    selectHora.remove(0);
  }

  // Cargar las nuevas opciones
  for (var i = inicio; i <= maximo; i++) {
    var optionElement = document.createElement('option');
    optionElement.value = i;
    optionElement.text = i;
    select.appendChild(optionElement.cloneNode(true));
    selectHora.appendChild(optionElement);

  }
}

function cargarMinutos() {
  var selectMinutos1 = document.getElementById('mm1');
  var selectMinutos2 = document.getElementById('ll1');

  // Cargar las nuevas opciones de minutos en ambos select
  for (var i = 0; i < 60; i++) {
    var optionElement = document.createElement('option');
    var valor = i;
    optionElement.value = valor;
    optionElement.text = valor;

    selectMinutos1.appendChild(optionElement.cloneNode(true));
    selectMinutos2.appendChild(optionElement);
  }
}

function mostrarContenido(seleccion){
  const option1Content = document.getElementById("infoPar");
  const option2Content = document.getElementById("btn-abrir-popup");

   
    // Mostrar el contenido basado en la opción seleccionada
    if (seleccion == "Seleccione un parqueadero") {
     console.log("seleccione par")
    } else {
      console.log("entro a parqueaderos")
      option1Content.style.display = "block";
      option2Content.style.display = "block";
    }
  }

var calcularButton = document.getElementById("btn-abrir-popup");

    // Asigna la función al evento onclick del botón
    calcularButton.onclick = function() {
      calcularConfirmacion();
    };

    // Función que se ejecutará al hacer clic en el botón
    function calcularConfirmacion() {
      console.log("entro");
      var miDiv = document.getElementById("mapa");
      miDiv.style.display = "none";
      const horaEntrada = document.getElementById("hh").value;
      const minutoEntrada = document.getElementById("mm1").value;
      const horaSalida = document.getElementById("mm1S").value;
      const minutoSalida = document.getElementById("ll1").value;
      const fidelizacion = document.getElementById("fidelizacion").value;
      const tarifa = document.getElementById("tarifa").value;

      var tiempoT = document.getElementById('tiempoTotal');
      var total = document.getElementById('totalPago');
      var cantidadPuntos = document.getElementById('puntos');

      

      const resultadoH = parseInt(horaSalida) - parseInt(horaEntrada);
      const resultadoM = parseInt(minutoSalida) - parseInt(minutoEntrada);
      const totalPago = ((resultadoH * 60) + resultadoM) * parseInt(tarifa);

      console.log("horas = " + resultadoH + " Minutos " + resultadoM)

      tiempoT.textContent = "Se reservaron " +  parseInt(resultadoH) + " horas con " + parseInt(resultadoM) + " minutos";
      total.textContent = "El total a pagar es $" + totalPago + " COP";
      if (fidelizacion == "No") {
        cantidadPuntos.textContent = "Lo sentimos, este parqueadero no cuenta con fidelización";
      } else {
        const puntos = resultadoH * parseInt(tarifa);
        cantidadPuntos.textContent = "Se le sumarán " + puntos + " puntos";
      }
    }



function obtenerDatosParqueadero(parqueaderoSeleccionado) {
  $.ajax({
    url: "../controllers/parqueaderos.php",
    method: "POST",
    data: { parqueadero: parqueaderoSeleccionado },
    success: function(response) {
      //console.log(response);
     // var parqueaderos = JSON.parse(response);
      var datosParqueadero = null;
      // Buscar el parqueadero por nombre
      for (var i = 0; i < response.length; i++) {
        if (response[i].nombre === parqueaderoSeleccionado) {
          datosParqueadero = response[i];
          
          mostrarContenido(parqueaderoSeleccionado);

          console.log(parqueaderoSeleccionado)
          //console.log(datosParqueadero = response[i])
          break; // Salir del bucle una vez encontrado
        }
      }
      if (datosParqueadero) {
        mostrarDatosParqueadero(datosParqueadero);
        console.log("entro al if")
        if(datosParqueadero.horario == "L - S: 8:00 am - 8:00 pm, D - F: 8:00 am - 4:00 pm"){
         // console.log("Horario normal")
          cargarSelectHoras(8,20);
          cargarMinutos();

        }else if(datosParqueadero.horario == "L - S: 5:00 am - 10:00 pm, D - F: 6:00 am - 4:00 pm"){
          //console.log("Horario universitario")
          cargarSelectHoras(5,22);
          cargarMinutos();
        }else{
         // console.log("Hospital/ No se reconoce el horario")
          cargarSelectHoras(0,24);
          cargarMinutos();
        }
      } else {
        console.log("No se encontraron datos para el parqueadero seleccionado.");
      }
    },
    error: function(xhr, status, error) {
      console.log("Error al obtener los datos del parqueadero: " + error);
    }
  });
}
function ejecucionAsync(){

}

function mostrarDatosParqueadero(datosParqueadero) {
  var nombreElement = $("#nombre");
  var tipoElement = $("#tipo");
  var ubicacionElement = $("#ubicacion");
  var horarioElement = $("#horario");
  var tarifaElement = $("#tarifa");
  var fidelizacionElement = $("#fidelizacion");
  var cuposElement = $("#cupos");
  var estadoElement = $("#estado");


  nombreElement.text("Nombre: " + datosParqueadero.nombre);
  tipoElement.text("Tipo: " + datosParqueadero.tipo);
  ubicacionElement.text("Ubicación: " + datosParqueadero.ubicacion);
  horarioElement.text("Horario: " + datosParqueadero.horario);
  tarifaElement.text(datosParqueadero.tarifa);
  fidelizacionElement.text(datosParqueadero.fidelizacion );
  cuposElement.text("Cupos disponibles: " + datosParqueadero.cupos );
  estadoElement.text("Estado: " + datosParqueadero.estado) ;

}
