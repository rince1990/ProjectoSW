<?php
function visualizarLinkInsertarPregunta()
{

	if (isset($_SESSION["username"]))
		echo "<span><a href='insertarPregunta.php'>Insertar Pregunta</a></spam>";

}
?>

	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Inicio</a></spam>
		<span><a href='verPreguntas.php'>Preguntas</a></spam>
		<span><a href='verPreguntasXML.php'>PreguntasXML</a></spam>
		<span><a href='creditos.php'>Creditos</a></spam>
		<?php visualizarLinkInsertarPregunta() ?>
	</nav>
	
