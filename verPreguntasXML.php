<html>
	<head>
		 <meta charset="UTF-8">
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
		<table border=1;>
			<tr>
			<th>Enunciado</th><th>Complejidad</th><th>Temática</th>
			</tr>	
		<?php
include ("conectbd.php");
include ("funciones.php");
$link=Conectar();
session_start();
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
	</body>
</html>
				