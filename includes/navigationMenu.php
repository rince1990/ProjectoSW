<?php
	include_once ('funciones.php');
	
if ($_SESSION['rol']=="alumno"){ //MENU DE ALUMNO  ?>
	
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Inicio</a></spam>
		<span><a href='GestionPreguntasJQuery.php'>Gestion Preguntas</a></spam>
	</nav>
	
	
<?php	
}else if($_SESSION['rol']=="profesor"){ //MENU DE PROFESOR ?>

	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Inicio</a></spam>
		<span><a href='revisar.php'>Revisar preguntas</a></spam>
		<span><a href='ObtenerDatos.php'>Obtener Datos</a></spam>
	</nav>
	
	
<?php
}else{//MENU DE USUARIO ANONIMO ?>
	
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Inicio</a></spam>
		<span><a href='verPreguntas.php'>Preguntas</a></spam>
		<span><a href='verPreguntasXML.php'>PreguntasXML</a></spam>
		<span><a href='creditos.php'>Creditos</a></spam>
	</nav>

<?php	
}
?>

		


