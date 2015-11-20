<?php
session_start();
include_once ("../conectbd.php");
$link=Conectar();


$result = $link->query("select cod,pregunta from Preguntas");

//GENERA UN SELECT CON TODAS LAS PREGUNTAS DEL USUARIO
echo 'Preguntas:<br/>';
echo '<select id="select" onChange="cambiarPreguntaAJAX()">';
while ($row = mysqli_fetch_assoc($result))
{
	echo "<option value=". $row["cod"].">". $row["pregunta"] ."</option>";
}
echo '</select>';



?>
