<?php
session_start();
include_once ("../conectbd.php");
require_once '../funciones.php';
$link=Conectar();


$result = $link->query("select cod,pregunta,respuesta,complejidad, email from Preguntas where cod='".$_REQUEST['cod']."'");	
$result = mysqli_fetch_assoc($result);
//guardarAccion($_SESSION['useremail'],VERPREGUNTAS);

echo '<table style="margin:0 auto;     border-collapse: collapse;" border="2">';

echo "<tr><td><strong>ID:</strong></td><td><input type='text' id='cod' value='".$result['cod']."' disabled></td></tr>";

echo "<tr><td><strong>Email:</strong></td><td><input type='text' id='email' value='".$result['email']."' disabled/></td></tr>";

echo "<tr><td><strong>Pregunta:</strong></td><td><input type='text' id='question' value='".$result['pregunta']."'></td></tr>";

echo "<tr><td><strong>Respuesta:</strong></td><td><input type='text' id='respuesta' value='".$result['respuesta']."'></td></tr>";


if ($result['complejidad']==0)
	echo "<tr><td><strong>Complejidad:</strong></td><td><input type='text' id='respuesta' value='Sin clasificar'></td></tr>";
else
	echo "<tr><td><strong>Complejidad:</strong></td><td><input type='text' id='respuesta' value='".$result['complejidad']."'></td></tr>";

echo '</table>';
?>