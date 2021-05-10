<?php

//LAs rutas internas
require_once "rutas.php";
//La clase para el routeo
require_once CONFIG.'router/autoload.php';
//Todos los includes, no es necesario, pero ayuda a odenar
require_once CONFIG.'includes.php';

//Inicio el enrutador
$router = new AltoRouter();

//Mi directorio base
$router->setBasePath('/logosofico/Integrada/piedraPapelTijera/php');

//Objeto partida, manejado de session
session_start();
if(!isset($_SESSION['partida'])){
  $_SESSION['partida'] = new Partida();
}


/**
*Listar personas
*
*Inicia la partida devolviendo ID de la misma
*y los valores de la jugada en 0
*/
$router->map('GET', '/nuevo', function() {
  try {
  	$part = $_SESSION['partida']->crearPartida();
    echo $part;
    http_response_code(200);

  } catch (\Exception $e) {
    http_response_code(500);
    echo '{"Mensaje" : "Error, no se pudo inicar juego"}';
  }
});


/**
*Ingresar a partida iniciada
*
*Permite ingresar a una partida existente 
*a partir del codigo de la misma
*
*/
$router->map('GET', '/partida/[i:id]', function($id) {
  try {
    $_SESSION['partida']->ingresarAPartida($id); 
    http_response_code(200);

  } catch (\Exception $e) {
    http_response_code(500);
    echo '{"Mensaje" : "Error, no se pudo ingresar a partida"}';
  }
});


/**
*Realizar la jugada
*
*Ingresamos un movimiento; piedra, papel o tijera
*
*/
$router->map('GET', '/movimiento/[i:mov]', function($mov) {
  try {
    $_SESSION['partida']->realizarMovimiento($mov);
    echo $_SESSION['partida']->jugador;
    echo '{"Mensaje" : "Movimiento realizado"}';
    http_response_code(200);

  } catch (\Exception $e) {
    http_response_code(500);
    echo '{"Mensaje" : "Error, no se pudo realizar movimiento"}';
  }
});



/**
*Obtener jugadas
*
*Verifica las jugadas realizadas
*
*/
$router->map('GET', '/movimientos/obtener', function() {
  try {
    $movRival = $_SESSION['partida']->obtenerMovimientos();
    echo $movRival; 
    http_response_code(200);

  } catch (\Exception $e) {
    http_response_code(500);
    echo '{"Mensaje" : "Error, no se pudo obtener movimiento"}';
  }
});




/**
*Necesario para el routeo
*
*
*/
$match = $router->match();
if( is_array($match) && is_callable( $match['target'] ) ) {
  call_user_func_array( $match['target'], $match['params'] );
} else {
  // no route was matched
  header( $_SERVER["SERVER_PROTOCOL"] . ' 403 Not Found');
}


?>