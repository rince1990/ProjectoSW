<?php
include_once('../nusoap-0.9.5/lib/nusoap.php');
include_once('../nusoap-0.9.5/lib/class.wsdlcache.php');

//creamos el objeto de tipo soapclient.
//http://www.mydomain.com/server.php se refiere a la url
//donde se encuentra el servicio SOAP que vamos a utilizar.
$soapclient = new nusoap_client( 'http://localhost/Sistemas%20Web/ProjectoSW/servicioSOAP/ComprobarContraseniaSOAP.php?wsdl',false);

//Llamamos la función que habíamos implementado en el Web Service
//e imprimimos lo que nos devuelve
if (isset($_POST['pass'])){
echo $soapclient->call('comprobarContrasenia',array('pass'=>$_POST['pass']));
//echo '<h2>Request</h2><pre>' . htmlspecialchars($soapclient->request, ENT_QUOTES) . '</pre>';
//echo '<h2>Response</h2><pre>' . htmlspecialchars($soapclient->response, ENT_QUOTES) . '</pre>';
//echo '<h2>Debug</h2>';
//echo '<pre>' . htmlspecialchars($soapclient->debug_str, ENT_QUOTES) . '</pre>';
}


?>