  
var btnAbrirPopup = document.getElementById('btn-abrir-popup'),
		overlay = document.getElementById('overlay'),
		popup = document.getElementById('popup'),
		btnCerrarPopup = document.getElementById('btn-cerrar-popup');

	btnAbrirPopup.addEventListener('click', function(){
		overlay.classList.add('active');
		popup.classList.add('active');
	});


	btnCerrarPopup.addEventListener('click', function(e){
		e.preventDefault();
		overlay.classList.remove('active');
		popup.classList.remove('active');
        var miDiv = document.getElementById("mapa");
		var boton = document.getElementById("registro");
        miDiv.style.display = "block";
		boton.style.display = "block";

	});

	// popup Mi cuenta 
	var btnAbrirPopup = document.getElementById('miCuenta'),
		overlay = document.getElementById('overlay'),
		popup = document.getElementById('popup'),
		btnCerrarPopup = document.getElementById('btn-cerrar-popup');

	btnAbrirPopup.addEventListener('click', function(){
		overlay.classList.add('active');
		popup.classList.add('active');
	});


	btnCerrarPopup.addEventListener('click', function(e){
		e.preventDefault();
		overlay.classList.remove('active');
		popup.classList.remove('active');

	});

	//popup Puntos
	var btnAbrirPopup = document.getElementById('misPuntos'),
	overlay = document.getElementById('overlay'),
	popup = document.getElementById('popup'),
	btnCerrarPopup = document.getElementById('btn-cerrar-popup');

btnAbrirPopup.addEventListener('click', function(){
	overlay.classList.add('active');
	popup.classList.add('active');
});


btnCerrarPopup.addEventListener('click', function(e){
	e.preventDefault();
	overlay.classList.remove('active');
	popup.classList.remove('active');
});

	// pop up mis reservas 

	var btnAbrirPopup = document.getElementById('misReservas'),
		overlay = document.getElementById('overlay'),
		popup = document.getElementById('popup'),
		btnCerrarPopup = document.getElementById('btn-cerrar-popup');

	btnAbrirPopup.addEventListener('click', function(){
		overlay.classList.add('active');
		popup.classList.add('active');
	});


	btnCerrarPopup.addEventListener('click', function(e){
		e.preventDefault();
		overlay.classList.remove('active');
		popup.classList.remove('active');
	});