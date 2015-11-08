<?php
session_start();
include_once ("../conectbd.php");


if
($_POST['question']!= '' && $_POST['answer']!='')
{
	$link=Conectar();
	$question = mysqli_real_escape_string($link, $_POST['question']);
	$answer = mysqli_real_escape_string($link, $_POST['answer']);
	$complejidad = mysqli_real_escape_string($link, $_POST['complejidad']);
	$subject = mysqli_real_escape_string($link, $_POST['subject']);
	insertarEnBD($link,$question,$answer,$complejidad);
	insertarEnXML($question,$answer,$complejidad,$subject);
	usuarioEstaOnline();

}





function insertarEnXML($question,$answer,$complejidad,$subject)
{




	$xml = simplexml_load_file('XML/preguntas.xml');
	$assessmentItem=$xml->addChild('assessmentItem');
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

	$xml = formatXML($xml);

	$return=$xml->asXML('XML/preguntas.xml');

	if ($return==1)
	{
		echo 'Pregunta insertada correctamente en preguntas.xml<br/>';
		echo '<br/><a href="verPreguntasXML.php"> Ver Preguntas </a>';
	}else
	{
		echo 'La pregunta no se ha insertado en preguntas.xml';
	}
}


//gives output format to XML file
function formatXML($xml)
{
	$dom = new DOMDocument('1.0');
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->loadXML($xml->asXML());
	$xml = new SimpleXMLElement($dom->saveXML());
	return $xml;

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