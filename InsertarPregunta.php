<?php

include ("conectbd.php");
session_start();


$link = Conectar();

if
(isset($_POST['submit']))
{
	$question = mysqli_real_escape_string($link, $_POST['question']);
	$answer = mysqli_real_escape_string($link, $_POST['answer']);
	$complejidad = mysqli_real_escape_string($link, $_POST['complejidad']);
	if ($complejidad == 'cero')
	{
		$complejidad = null;
	}
	$email=$_SESSION['useremail'];

	$sql = "INSERT INTO Preguntas (email,pregunta,respuesta,complejidad)
	VALUES ('$email','$question','$answer','$complejidad')";
	if (mysqli_query($link, $sql))
	{
		echo 'Pregunta insertada correctamente';
	}else
	{
		printf("No se ha podido insertar la pregunta en la base de datos:</br> %s>", $link->error);
	}
	mysqli_close($link);
}

function comprobarLogueado()
{
	if (isset($_SESSION['useremail'])) return true;
	else return false;

}


?>
<html>
	<head>
		<title>Insertar Pregunta</title>
	</head>

	<body>
	<?php if (comprobarLogueado())
	{?>
		<form id='pregunta' method="post" action='InsertarPregunta.php'>
			Pregunta:(*):<br/>
			<textarea name="question" rows="4" cols="50" placeholder="Inserta la pregunta..." required></textarea><br/><br/>
			Respuesta:(*):<br/>
			<textarea name="answer" rows="4" cols="50" placeholder="Inserta la respuesta..." required></textarea><br/><br/>
			Complejidad:<br/>
				<select id="complejidad" name="complejidad">
				<option value="cero" selected="selected"></option>
					<option value="1">1 </option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
			<br/><br/>
			<input type="submit" name="submit" value="Enviar"><br>
		</form>
		<?php }
else echo "Debes estar logueado para acceder a este contenido.";
?>
		<br/>
		<a href="layout.php">Atras</a>
	</body>

</html>