<?php

include ("conectbd.php");
include ("funciones.php");
session_start();




if
(isset($_POST['submit']))
{
	$link = Conectar();
	$question = mysqli_real_escape_string($link, $_POST['question']);
	$answer = mysqli_real_escape_string($link, $_POST['answer']);
	$complejidad = mysqli_real_escape_string($link, $_POST['complejidad']);
	$subject = mysqli_real_escape_string($link, $_POST['subject']);

	insertarEnBD($link,$question,$answer,$complejidad);
	insertarEnXML($question,$answer,$complejidad,$subject);
}

function comprobarLogueado()
{
	if (isset($_SESSION['useremail'])) return true;
	else return false;

}


function insertarEnXML($question,$answer,$complejidad,$subject)
{

	$xml = simplexml_load_file('XML/preguntas.xml');
	$assessmentItem=$xml->addChild('assessmentItem');

	//no va este if
	if ($_REQUEST['complejidad'] == 0)
	{
		$assessmentItem->addAttribute('complexity', 'sin complejidad');
	}else
	{
		$assessmentItem->addAttribute('complexity', $complejidad);
	}

	$assessmentItem->addAttribute('subject', $subject);
	$itemBody=$assessmentItem->addChild('itemBody');
	$itemBody->addChild('p',$question);
	$correctResponse=$assessmentItem->addChild('correctResponse');
	$correctResponse->addChild('value', $answer);
	$return=$xml->asXML('preguntas.xml');

	if ($return==1)
	{
		echo 'Pregunta insertada correctamente en preguntas.xml<br/>';
		echo '<br/><a href="VerPreguntasXML.php"> Ver Preguntas </a>';
	}else
	{
		echo 'La pregunta no se ha insertado en preguntas.xml';
	}
}


function insertarEnBD($link,$question,$answer,$complejidad)
{

	if ($complejidad == 0)
	{
		$complejidad = null;
	}
	$email=$_SESSION['useremail'];

	$sql = "INSERT INTO Preguntas (email,pregunta,respuesta,complejidad)
	VALUES ('$email','$question','$answer','$complejidad')";
	if (mysqli_query($link, $sql))
	{
		echo 'Pregunta insertada correctamente en la BBDD<br/>';
		guardarAccion($_SESSION['useremail'],INSERTAR);
	}else
	{
		printf("No se ha podido insertar la pregunta en la base de datos:</br> %s>", $link->error);
	}
	mysqli_close($link);
}


?>
<html>
	<head>
		<title>Insertar Pregunta</title>
	</head>

	<body>
	<?php if (comprobarLogueado())
	{?>
		<form id='pregunta' method="post" action='insertarPregunta.php'>
			Pregunta:(*):<br/>
			<textarea name="question" rows="4" cols="50" placeholder="Inserta la pregunta..." required></textarea><br/><br/>
			Respuesta:(*):<br/>
			<textarea name="answer" rows="4" cols="50" placeholder="Inserta la respuesta..." required></textarea><br/><br/>
			Subject:(*):<br/>
			<input name="subject" placeholder="Inserta el subject..."  type="text" required></textarea><br/><br/>
			Complejidad:<br/>
				<select id="complejidad" name="complejidad">
					<option value="0" selected="selected"></option>
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