<?php

class partidaDB{
	private $conexion;

	public function __construct(){
		$obtenerConexion = new conexionBD();
		$this->conexion = $obtenerConexion->conectar();
	}

	//Para poder cerra la conexion
	public function cerrar(){
		$this->conexion = null;
	}


	/**
	*Crea una nueva partida
	*Devuleve el ide de la partida generada
	*
	*@return int $juego id de partida
	*/
	public function nuevaPartida(){
		$consulta = "INSERT INTO juego (jug1, jug2) VALUES (0, 0)";
		$sentencia= $this->conexion->prepare($consulta);

	    if (!$sentencia) {
	      echo "\nPDO::errorInfo():\n";
	      print_r($this->conexion->errorInfo());
	    }
	   /*Ejecuta la sentencia SQL*/
	    $sentencia->execute();

	    $juego = $this->conexion->lastInsertId();
	    return $juego;
	}


	/**
	*Ingresa una jugada
	*Actualiza el registro del id dado
	*
	*
	*@param integer $id_jugada
	*/
	public function ingresarJugada($campoJug, $id_juego, $jugada){
		$consulta = "UPDATE juego SET $campoJug = $jugada WHERE id = $id_juego";
		$sentencia= $this->conexion->prepare($consulta);

		if (!$sentencia) {
		  echo "\nPDO::errorInfo():\n";
		  print_r($this->conexion->errorInfo());
		}

		$sentencia->execute();
	}


	/**
	*Obtiene las jugadas de un juego
	*
	*@param integer $id_juego codigo de la partida 
	*
	*@return $fila codigo y movimientos de una jugada
	*/
	public function obtenerJugada($id_juego){
		$chequear = "SELECT * FROM juego WHERE id = $id_juego";
		$sentencia= $this->conexion->prepare($chequear);

		if (!$sentencia) {
		  echo "\nPDO::errorInfo():\n";
		  print_r($this->conexion->errorInfo());
		}

		$sentencia->execute();
		$fila = $sentencia->fetch(PDO::FETCH_ASSOC);
		return $fila;
	}


}//Final de la clase


?>