<?php
include_once('../nusoap-0.9.5/lib/nusoap.php');
include_once('../nusoap-0.9.5/lib/class.wsdlcache.php');

//creamos el objeto de tipo soapclient.
//http://www.mydomain.com/server.php se refiere a la url
//donde se encuentra el servicio SOAP que vamos a utilizar.
$soapclient = new nusoap_client( 'http://swadriang.esy.es/ProjectoSW/servicioSOAP/ComprobarContraseniaSOAP.php?wsdl',false);
//Llamamos la función que habíamos implementado en el Web Service
//e imprimimos lo que nos devuelve

//echo '<script>console.log("pass: "'.$_POST['pass'].'" and codigo: "'.$_POST['codigo'].')</script>';
if (($_POST['pass'] != '' && $_POST['codigo'] != '')){
$data = array('pass'=>$_POST['pass'],'codigo'=>$_POST['codigo']);
echo $soapclient->call('comprobarContrasenia',$data);
//echo '<h2>Request</h2><pre>' . htmlspecialchars($soapclient->request, ENT_QUOTES) . '</pre>';
//echo '<h2>Response</h2><pre>' . htmlspecialchars($soapclient->response, ENT_QUOTES) . '</pre>';
//echo '<h2>Debug</h2>';
//echo '<pre>' . htmlspecialchars($soapclient->debug_str, ENT_QUOTES) . '</pre>';
}


?>