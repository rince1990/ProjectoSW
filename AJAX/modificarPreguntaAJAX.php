<?php
session_start();
include_once ("../conectbd.php");
include_once ("../funciones.php");


if
($_POST['question']!= '' && $_POST['answer']!='')
{
	$link=Conectar();
	$cod = mysqli_real_escape_string($link, $_POST['cod']);
	$question = mysqli_real_escape_string($link, $_POST['question']);
	$answer = mysqli_real_escape_string($link, $_POST['answer']);
	$complejidad = mysqli_real_escape_string($link, $_POST['complejidad']);
	insertarEnBD($link,$cod,$question,$answer,$complejidad);
	usuarioEstaOnline();

}


function insertarEnBD($link,$cod,$question,$answer,$complejidad)
{

	if ($complejidad == 0)
	{
		$complejidad = null;
	}

	$sql = "UPDATE Preguntas SET pregunta='$question',respuesta='$answer',complejidad='$complejidad' WHERE cod='$cod'";
	if (mysqli_query($link, $sql))
	{
		echo 'OK';
	}else
	{
		echo 'ERROR '.$link->error;
	}
	mysqli_close($link);
}
?>