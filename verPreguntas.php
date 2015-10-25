<html>
	<head>
		<title></title>
		<style>
			body {
			    background-color: #B8B8B8;
				text-align: center;
				padding-top: 5%;
				padding-right: 25%;
				padding-left: 25%;
				font-family: "Times New Roman", Times, serif;
				font-size: 16px;
			}

			#pregunta {
				font-size: 20px;
			}
		</style>


	</head>
	<body>
		<?php
include ("conectbd.php");
include ("funciones.php");
$link=Conectar();



?>

		<div class="center">
				<?php
					session_start();
if
(!isset($_GET['cod']))
{

	$result = $link->query("select min(cod) as cod,pregunta,respuesta,complejidad from Preguntas");
}
else
{
	$result = $link->query("select cod,pregunta,respuesta,complejidad from Preguntas where cod='".$_GET['cod']."'");
	//si no existe el codigo en la BBDD se coge el primero de la BBDD
	if (($result->num_rows) === 0)
		{ $result = $link->query("select min(cod) as cod,pregunta,respuesta,complejidad from Preguntas");}


}

$reg = mysqli_fetch_assoc($result);
$cod =$reg['cod'];
guardarAccion($_SESSION['useremail'],VERPREGUNTAS);


?>
<div id="pregunta">
	<?php
echo $reg['pregunta'];
?>
</div>
<?php

if ($reg['complejidad'] != '0')
{
	echo "<br/><br/>Complejidad: ".$reg['complejidad']."";
}
else
	echo "<br/><br/>Complejidad: No clasificado";

//obtenemos el codigo anterior y el siguiente
$resultanterior = $link->query("select max(cod) from Preguntas where cod<".$cod."");
$codanterior = mysqli_fetch_assoc($resultanterior);
$codanterior = $codanterior['max(cod)'];
$resultsiguiente = $link->query("select min(cod) from Preguntas where cod>".$cod."");
$codsiguiente = mysqli_fetch_assoc($resultsiguiente);
$codsiguiente = $codsiguiente['min(cod)'];


function buttonAnteriorEnabled($codanterior)
{
	if (!isset($codanterior))
	{
		echo "disabled";}
}


function buttonSiguienteEnabled($codsiguiente)
{
	if (!isset($codsiguiente))
	{
		echo "disabled";}
}


?>

		</div>
		<br/><br/>
			<a href="?cod=<?php echo $codanterior?>" ><button type="button" style="float: left;" <?php buttonAnteriorEnabled($codanterior);?>> << </button></a>
			<a href="?cod=<?php echo $codsiguiente?>" ><button type="button" style="float: right;"<?php buttonSiguienteEnabled($codsiguiente);?>> >> </button></a>
		<br/>
		<a id="index" href="layout.php">Inicio</a>
	</body>
</html>
				