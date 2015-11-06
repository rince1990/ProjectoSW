<?php
session_start();
include ("conectbd.php");
?>

<!DOCTYPE html>
<html>
	<head>
<?php include('includes/metaAndCSS.html'); ?>
	<title>Insertar Pregunta</title>
	</head>
  <body>
  <div id='page-wrap'>

  	<?php include('includes/header.php'); ?>
	<?php include('includes/navigationMenu.php'); ?>

    <section class="main" id="s1">

	<div>
	<?php if (!comprobarLogueado())
{
	echo "Debes estar logueado para acceder a este contenido.";
}else//MOSTRAMOS LA PAGINA
	{?>
	<input type="button" class="botonesgestion" name="insertar" value="Insertar" onclick="guardarPreguntaAJAX()"/>
	<input type="button" class="botonesgestion" name="mostrarMisPreguntas" value="Ver mis preguntas" onclick="mostrarPreguntasAJAX()"/>

		<form id='pregunta' method="post" >

			Pregunta:(*):<br/>
			<textarea id="question" name="question" rows="4" cols="50" placeholder="Inserta la pregunta..." required></textarea><br/><br/>
			Respuesta:(*):<br/>
			<textarea id="answer" name="answer" rows="4" cols="50" placeholder="Inserta la respuesta..." required></textarea><br/><br/>
			<table align="center" style="text-align: center; margin: 0 auto;">
				<tr>
					<td>Subject:(*):</td>
					<td>Complejidad:</td>
				</tr>
				<tr>
					<td><input id="subject" name="subject" placeholder="Inserta el subject..."  type="text" required></td>
					<td><select id="complejidad" name="complejidad">
					<option value="0" selected="selected"></option>
					<option value="1">1 </option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
					</td>
				</tr>
			</table>
		</form>

			<br/>
			<div id="mensaje"></div>
			<div id="divseleccion" style="visibility: hidden;">
				<div id="listaPreguntas"></div>
				<div id="mostrarPregunta"></div>
			</div>
			
		<?php
}

?>
		<br/>
		<a href="layout.php">Atras</a>
	</div>
    </section>
	<?php include('includes/footer.html'); ?>
</div>
</body>
</html>
<script>

	//HACE VISIBLE Y RELLENA EL DIV QUE CONTIENE LAS PREGUNTAS
	function mostrarPreguntasAJAX(){
		document.getElementById("mensaje").style.visibility='hidden';
		document.getElementById("divseleccion").style.visibility='visible';
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("POST","AJAX/selectPreguntas.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send();

	xmlhttp.onreadystatechange=function(){
	if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById("listaPreguntas").innerHTML=xmlhttp.responseText ;
		 }
	}

	}

	//CAMBIA LA PREGUNTA VISUALIZADA EN EL HTML
	function cambiarPreguntaAJAX(){
	cod = document.getElementById("select").value;
	xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST","AJAX/datosPregunta.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("cod="+cod);

	xmlhttp.onreadystatechange=function(){
	if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById("mostrarPregunta").innerHTML=xmlhttp.responseText ;
		 }
	}
}


//GUARDA LA PREGUNTA EN LA BBDD Y XML
function guardarPreguntaAJAX(){


	document.getElementById("mensaje").style.visibility='visible';
	document.getElementById("divseleccion").style.visibility='hidden';

	xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST","AJAX/insertarPreguntaAJAX.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var question = document.getElementById("question").value;
	var answer = document.getElementById("answer").value;
	var subject = document.getElementById("subject").value;
	if ((question == '') || (answer == '') || (subject == '')){
		alert ("Ni la pregunta ni la respuesta ni el subject pueden estar vacios");
 	}
 	else{
	 		var complejidad = document.getElementById("complejidad").value;
	 		var header = "question="+question+"&answer="+answer+"&subject="+subject+"&complejidad="+complejidad;
	 		xmlhttp.send(header);

 	}
 		
	xmlhttp.onreadystatechange = function(){

		if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
			document.getElementById("mensaje").innerHTML= "Pregunta insertada correctamente";
			console.log(xmlhttp.responsetxt);
		}else{
			document.getElementById("mensaje").innerHTML= "La pregunta no ha podido insertarse";
			console.log(xmlhttp.responseText);
		}
	}

}

</script>
