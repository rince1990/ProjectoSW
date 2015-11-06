<?php

const VERPREGUNTAS= "ver pregunta";
const INSERTAR = "insertar pregunta";

function guardarAccion($email,$accion)
{

	if
	(isset($_SESSION["codSesion"]))
		$cod = $_SESSION["codSesion"];
	else
	{
		$cod=NULL;
		$email=NULL;
	}
	date_default_timezone_set("Europe/Madrid");
	$date = date('Y-m-d H:i:s');
	$ip = getIP();
	$sql = "INSERT INTO Acciones (cod_conexion,email,accion,time,ip) VALUES ('$cod','$email','$accion','$date','$ip')";

	$link = Conectar();
	$link->query($sql);
	$link->close();

}


function getIP()
{
	//Test if it is a shared client
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
	{
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	//Is it a proxy address
	}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}else
	{
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	//The value of $ip at this point would look something like: "192.0.34.166"
	return $ip;
	//$ip = ip2long($ip);
	//The $ip would now look something like: 1073732954
}



function comprobarLogueado()
{
	if (isset($_SESSION['useremail'])) return true;
	else return false;

}



?>