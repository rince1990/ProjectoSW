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
	<?php include('includes/seguridadAlumno.php');?>

    <section class="main" id="s1">

	<div>

	<div id="cuantaspreguntas"></div>
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
		<br/>
		<a href="layout.php">Atras</a>
	</div>
    </section>
	<?php include('includes/footer.html'); ?>
</div>
</body>
</html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>

<script>

	//MOSTRAR CANTIDAD DE PREGUNTAS CADA 5 SEG
	$( window ).load(function() {
    cuantasPreguntasAJAX();
	setInterval(cuantasPreguntasAJAX,5000);
	});

	function cuantasPreguntasAJAX() {

$.ajax({
url: 'AJAX/cuentaPreguntas.php',
type: "POST",
beforeSend:function(){$('#cuantaspreguntas').html('<div><img src="images/loading.gif"/></div>')},
success:function(datos){$('#cuantaspreguntas').html(datos)},
error:function(){$('#cuantaspreguntas').html('<p class="error"><strong>El servidor parece que no responde</p>')}
});

	}


	//HACE VISIBLE Y RELLENA EL DIV QUE CONTIENE LAS PREGUNTAS
	function mostrarPreguntasAJAX(){

		$("#mensaje").css("visibility", "hidden");
		$("#divseleccion").css("visibility", "visible");

		$.ajax({
url: 'AJAX/selectPreguntas.php',
type: "POST",
beforeSend:function(){$('#listaPreguntas').html('<div><img src="images/loading.gif"/></div>')},
success:function(datos){
$('#listaPreguntas').fadeIn(1000).html(datos);},
error:function(){
$('#listaPreguntas').fadeIn().html('<p class="error"><strong>El servidor parece que no responde</p>');
}
});


	}

	//CAMBIA LA PREGUNTA VISUALIZADA EN EL HTML
	function cambiarPreguntaAJAX(){

	cod = $("#select").val();

	$.ajax({
url: 'AJAX/datosPregunta.php',
type: "POST",
data: "cod="+cod,
beforeSend:function(){$('#mostrarPregunta').html('<div><img src="images/loading.gif"/></div>')},
success:function(datos){
$('#mostrarPregunta').fadeIn(1000).html(datos);},
error:function(){
$('#mostrarPregunta').fadeIn().html('<p class="error"><strong>El servidor parece que no responde</p>');
}
});

}


//GUARDA LA PREGUNTA EN LA BBDD Y XML
function guardarPreguntaAJAX(){

	$("#mensaje").css("visibility", "visible");
	$("#divseleccion").css("visibility", "hidden");

	var question = $("#question").val();
	var answer = $("#answer").val();
	var subject = $("#subject").val();
	var complejidad = $("#complejidad").val();



	//xmlhttp = new XMLHttpRequest();
	//xmlhttp.open("POST","AJAX/insertarPreguntaAJAX.php", true);
	//xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	if ((question == '') || (answer == '') || (subject == '')){
		alert ("Ni la pregunta ni la respuesta ni el subject pueden estar vacios");
 	}
 	else{
	 	var header = "question="+question+"&answer="+answer+"&subject="+subject+"&complejidad="+complejidad;

$.ajax({
url: 'AJAX/insertarPreguntaAJAX.php',
type: "POST",
data: header,
beforeSend:function(){$('#mensaje').html('<div><img src="images/loading.gif"/></div>')},
success:function(datos){
$('#mensaje').html('<p class="error"><strong>Pregunta insertada correctamente</p>');},
error:function(){
$('#mensaje').fadeIn().html('<p class="error"><strong>La pregunta no ha podido insertarse</p>');
}
});


 	}

}

</script>
