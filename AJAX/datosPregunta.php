<?php
session_start();
include_once ("../conectbd.php");
require_once '../funciones.php';
$link=Conectar();


$result = $link->query("select cod,pregunta,respuesta,complejidad from Preguntas where cod='".$_REQUEST['cod']."' and email='".$_SESSION['useremail']."'");	
$result = mysqli_fetch_assoc($result);
guardarAccion($_SESSION['useremail'],VERPREGUNTAS);

echo '<fieldset>';

echo "<strong>Pregunta:</strong>".$result['pregunta']."<br/>";

if ($result['complejidad']==0)
	echo "<strong>Complejidad:</strong> Sin clasificar";
else
	echo "<strong>Complejidad: </strong>".$result['complejidad'];
	
echo '</fieldset>';



?>