<?php
//incluimos la clase nusoap.php
include_once('../nusoap-0.9.5/lib/nusoap.php');
include_once('../nusoap-0.9.5/lib/class.wsdlcache.php');

//creamos el objeto de tipo soap_server
$ns="../nusoap-0.9.5/samples";
//creamos el objeto de tipo soap_server
$server = new soap_server;
$server->configureWSDL('comprobarContrasenia',$ns);
$server->wsdl->schemaTargetNamespace=$ns;
//registramos la función que vamos a implementar
//se podría registrar mas de una función …
$server->register('comprobarContrasenia',array('pass'=>'xsd:string'),array('response'=>'xsd:string'),$ns);


function comprobarContrasenia($pass)
{

	$lineas = file('toppasswords.txt', FILE_IGNORE_NEW_LINES);
	$respuesta = "VALIDA";
	//Output a line of the file until the end is reached
	foreach ($lineas as $num_linea => $linea) {
		//$respuesta = $respuesta.$linea;
		if($linea == $pass){
			$respuesta = "INVALIDA";
		}
	}
	
	return $respuesta;
	
}



//llamamos al método service de la clase nusoap
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ?
	$HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);






?>