
<?php
session_start();
include_once ("conectbd.php");
include_once ("funciones.php");
$link=Conectar();




?>

<!DOCTYPE html>
<html>
	<head>
<?php include('includes/metaAndCSS.html'); ?>
	<title>Quiz Game</title>
	</head>
  <body>
  <div id='page-wrap'>

  	<?php include('includes/header.php'); ?>
	<?php include('includes/navigationMenu.php'); ?>

    <section class="main" id="s1">

	<div>
		
	<?php


$result = $link->query("select cod,pregunta from Preguntas where email='".$_SESSION['useremail']."'");


//WHILE DE SELECT###########################################
echo '<select id="seleccion" onChange="cambiarPreguntaAJAX()">';
while ($row = mysqli_fetch_assoc($result)){
	echo "<option value=". $row["cod"].">". $row["pregunta"] ."</option>";
}
echo '</select>';
?>

<div id="pregunta">
	<?php
echo $reg['pregunta'];
?>
</div>
<?php
/*
if ($reg['complejidad'] != '0')
{
	echo "<br/><br/>Complejidad: ".$reg['complejidad']."";
}
else
	echo "<br/><br/><div id='complejidad'>Complejidad: No clasificado</div>";

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
}*/


?>
<script>



</script>
		</div>
		<br/><br/>
			<!--<a href="?cod=<?php echo $codanterior?>" ><button type="button" style="float: left;" <?php buttonAnteriorEnabled($codanterior);?>> << </button></a>
			<a href="?cod=<?php echo $codsiguiente?>" ><button type="button" style="float: right;"<?php buttonSiguienteEnabled($codsiguiente);?>> >> </button></a>
			<button type="button" style="float: left;" <?php buttonAnteriorEnabled($codanterior);?>   onClick="cambiarPreguntaAJAX(<?php echo $codanterior?>)"> << </button>
			<button type="button" style="float: right;"<?php buttonSiguienteEnabled($codsiguiente);?> onClick="cambiarPreguntaAJAX(<?php echo $codsiguiente?>)"> >> </button>-->
		<br/>
		<a id="index" href="layout.php">Inicio</a>

	</div>
    </section>
	<?php include('includes/footer.html'); ?>
</div>
</body>
</html>
				