
			
			<?php session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
<?php include('includes/metaAndCSS.html'); ?>
	<title>Quiz Game XML</title>
	</head>
  <body>
  <div id='page-wrap'>
	
  	<?php include('includes/header.php'); ?>
	<?php include('includes/navigationMenu.php'); ?>

    <section class="main" id="s1">

	<div>
	<table border=1;>
			<tr>
			<th>Enunciado</th><th>Complejidad</th><th>Temática</th>
			</tr>	
		<?php
include_once ("conectbd.php");
include_once ("funciones.php");
$link=Conectar();
$xml = simplexml_load_file("XML/preguntas.xml");

guardarAccion($_SESSION['useremail'],VERPREGUNTAS);


foreach ($xml->children() as $assessmentItem)
{
?>
			<tr>
				<?php
	echo "<td>".$assessmentItem->itemBody->p."</td>";
	$atri = $assessmentItem->attributes();
	//echo $atri;
	echo "<td>".$atri["complexity"]."</td>";
	echo "<td>".$atri["subject"]."</td>";
?>
			</tr>
		<?php
}
?>
			</tr>
		</table>
		<br/>
		<a id="index" href="layout.php">Inicio</a>

	</div>
    </section>
	<?php include('includes/footer.html'); ?>
</div>
</body>
</html>	