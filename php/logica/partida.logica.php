<?php

class Partida{
	private $partida;
	private $jugador;



	/**
	*Genera una nueva partida
	*
	*Al generarse una partida, se genera un código que se devuelve en
	*esta función
	*
	*@return int $idJuego codigo del juego
	*/
	public function crearPartida(){
		$partDB = new partidaDB();
 		$idJuego = $partDB->nuevaPartida();
 		$this->partida = $idJuego;
 		$this->jugador = 1;
 		$partDB->cerrar();
 		return $idJuego;
 	}


 	/**
 	*Ingresa a una partida con un código
 	*
 	*Recibe el codigo para unirse a la pártida, asigna el 
 	*numero de jugador 2
	*
	*@param int $id Código del juego
 	*/
 	public function ingresarAPartida($id){
 		$this->partida = $id;
 		$this->jugador = 2;
 	}


 	/**
 	*Realiza un movimiento
 	*
 	*Se le pasa un numero que equicale a piedra(1), papel(2)
 	*o tijera(3). El movimiento quedá refelejado en la base de datos
 	*
 	*@param int $jugada Codigo de piedra, papel o tijera
 	*/
 	public function realizarMovimiento($jugada){
 		$partDB = new partidaDB();
 		$campoJug = "jug".$this->jugador;
 		$partDB->ingresarJugada($campoJug, $this->partida, $jugada); 
 		$partDB->cerrar();

 	}


 	/**
 	*Trae el movimiento del rival
 	*
 	*Desde la base trae a partir del id de juego los movimiento, y 
 	*se fija que jugador soy, para devolver el del rival
	*
	*@return int $datos[$jugadorRival] Movimiento del jugador rival
 	*/
	public function obtenerMovimientos(){
		$partDB = new partidaDB();
		$datos = $partDB->obtenerJugada($this->partida);

		if($this->jugador == 1){
			$jugadorRival = "jug2";
		}else if($this->jugador == 2){
			$jugadorRival = "jug1";
		}

		$partDB->cerrar();
		return $datos[$jugadorRival];

	}

}//Fin de la clase



?>