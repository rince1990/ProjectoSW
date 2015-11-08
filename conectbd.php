<?php
	include_once 'funciones.php';
	
function Conectar()
{

	/* Conectando, seleccionando la base de datos
	$con = mysql_connect('localhost', 'root', 'mysql') or die('No se pudo conectar: ' . mysql_error());
	echo 'Connected successfully<br>';
	mysql_select_db('Quiz') or die('No se pudo seleccionar la base de datos');
*/

	$link = mysqli_connect("127.0.0.1", "root", "mysql", "Quiz");

	if (!$link)
	{
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}

	//echo "Success: A proper connection to MySQL was made! The Quiz database is great.</br>" . PHP_EOL;
	



	return $link;



}


?>