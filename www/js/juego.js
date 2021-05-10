var jugadaPropia = 0;
var jugadaRival = 0;
var idJuego = 0;
var resultado = "";
var manos = {1: "piedra", 2: "papel",  3: "tijera"};


/**
*Inicializa el juego y trae su id
*
*@param codigo
*/
function iniciarJuego(codigo){
	if(codigo == 0){
		endPoint = URLBASE+'nuevo';
	}else{
		endPoint = URLBASE+'partida/'+codigo;
	}
	$('#inicioJuego').hide();
	$.ajax({
		url: endPoint,
		method : 'GET',
		success: function(respuesta) {
			idJuego = respuesta;
			//if(idJuego != 0){
				$('#ingresaMuestraCodigo').show();
				$('#linkJuego').html(idJuego);
			//}
		},
		error: function() {
	        console.log("No se ha podido obtener la información");
	    }
	});	
}


/**
*Realiza el movimiento
*
*VA contra la base de datos a guardar el movimiento,
*
*@param integer jugadaData
*/
function ingresarJugada(jugadaDato){
	jugadaPropia = jugadaDato;
	$('#jugadaTotalVista').show();
	$('#decisionJugada').hide();
	$('#tituloEnJuego').html("Jugada");
	$('#miJugada').attr("src", "img/"+manos[jugadaPropia]+".png");
	$('#miJugada').addClass('img-fluid');

	$.ajax({
		url: URLBASE+'movimiento/'+jugadaDato,
		method : 'GET',

		success: function(respuesta) {
			console.log(respuesta);
		},
		error: function() {
	        console.log("No se ha podido realizar movimiento");
	    }
	});	
}



/**
*Obtiene la jugada del rival
*
*Va contra la base de datos para ver la jugada
*del judador opuesto
*/	
function traerJugada(){	
		$.ajax({
		url: URLBASE+'movimientos/obtener',
		method : 'GET',
		success: function(respuesta) {
			console.log(respuesta);
			jugadaRival = respuesta;
		},
		error: function() {
	        console.log("No se ha podido obtener la información");
	    }
	});	
}
	

/**
*Verifica qwue esten ambas jugadas para decretar ganador
*
*Chequea contra la base de datos si la jugada se realizó a traves de 
*la función "traeJugada" cada 2 segundos. Si la jugada se realizó, corta
*la llamada al servidor y utiliza la función "analizarResultado" para 
*poder decretar ganador
*
*/
function realizarAnalisisJuego(){		
	var analisis = setInterval(function(){
		traerJugada();
		console.log("analizando...");
		$('#cargando').show();
		if(jugadaRival != 0){
			$('#cargando').hide();
			clearInterval(analisis);
			analizarResultado();
			$('#jugadaRival').attr("src", "img/"+manos[jugadaRival]+".png");
			$('#jugadaRival').addClass('img-fluid');
		}		
	}, 2000);

}

/**
*Realiza un algoritomo comparador de la jugada
*
*En este caso, cada jugada tiene un valor numerico, entonces
*piedra es 1, papel es 2 y tijera es 3
*
*/
function analizarResultado(){
	if(jugadaPropia > jugadaRival){
		if((jugadaPropia - jugadaRival) > 1){
			resultado = "Perdiste";
		}else{
			resultado = "Ganaste";
		}
	}else{
		if((jugadaRival - jugadaPropia) > 1){
			resultado = "Ganaste";
		}else{
			resultado = "Perdiste";
		}	
	}

	if(jugadaPropia == jugadaRival){
		resultado = "Empate";
	}
	$('#tituloEnJuego').css('color', 'red');
	$('#tituloEnJuego').html(resultado);
}