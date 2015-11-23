<?php
include_once ("conectbd.php");
const VERPREGUNTAS= "ver pregunta";
const INSERTAR = "insertar pregunta";

function guardarAccion($email,$accion)
{

	if
	(isset($_SESSION["codSesion"])){
		$cod = $_SESSION["codSesion"];
		usuarioEstaOnline();
		}
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

function usuarioEstaOnline(){
	$email = $_SESSION['useremail'];
	$ahora = time();
	$link = Conectar();
	//actualizamos la tabla
    //borrando los registros de las ip inactivas (24 minutos)
    $limite = $ahora-24*60;
    $sql = "delete from conexiones_online where fecha < ".$limite;
	$link->query($sql);
	
	//miramos si el ip del visitante existe en nuestra tabla
	$sql = "select email, fecha from conexiones_online where email = '$email'";
	$result = $link->query($sql);
	
   //si existe actualizamos el campo fecha
   if (mysqli_num_rows($result) != 0) $sql = "update conexiones_online set fecha = ".$ahora." where email = '$email'";
   //si no existe insertamos el registro correspondiente a la nueva sesion
   else $sql = "insert into conexiones_online (email, fecha) values ('$email', $ahora)";

   //ejecutamos la sentencia sql
   $link->query($sql);	
	
	$link->close();
	
}

function usuarioEstaOffline(){
	$email = $_SESSION['useremail'];
	$link = Conectar();
	$sql = "delete from conexiones_online where email ='$email'";
	$link->query($sql);

	
}

 
function enviarEmail( $email, $mensaje ){

 
   $cabeceras = 'MIME-Version: 1.0' . "\r\n";
   $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $cabeceras .= 'From: Quiz Game <QuizGame@swadriang.esy.es>' . "\r\n";
   // Se envia el correo al usuario
   mail($email, "Recuperar contraseña", $mensaje, $cabeceras);
}


?>