<?php session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
<?php include('includes/metaAndCSS.html'); ?>
	<title>Quiz Game</title>
	</head>
  <body>
  <div id='page-wrap'>
	
  	<?php include('includes/header.php'); 
		  include('includes/navigationMenu.php'); 
		  include('includes/seguridadProfesor.php'); ?>
	

    <section class="main" id="s1">

	<div>
	<div id="listaPreguntas"></div>
	<div id="mostrarPregunta"></div>
	<input type="button" class="botonesgestion" name="guardar" value="Guardar cambios" onclick="guardarModificacionesAJAX()"/>
	<div id="mensaje"></div>
	</div>
    </section>
	<?php include('includes/footer.html'); ?>
</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>

<script>
	
	//Al cargar la pagina
	$( window ).load(function() {
    mostrarPreguntasAJAX();
    });
	
	//HACE VISIBLE Y RELLENA EL DIV QUE CONTIENE LAS PREGUNTAS
	function mostrarPreguntasAJAX(){

		$.ajax({
			url: 'AJAX/selectPreguntasTodas.php',
			type: "POST",
			beforeSend:function(){$('#listaPreguntas').html('<div><img src="images/loading.gif"/></div>')},
			success:function(datos){
			$('#listaPreguntas').html(datos);},
			error:function(){
			$('#listaPreguntas').html('<p class="error"><strong>El servidor parece que no responde</p>');
			}
		});
	}
	
	//CAMBIA LA PREGUNTA VISUALIZADA EN EL HTML
	function cambiarPreguntaAJAX(){

	cod = $("#select").val();

		$.ajax({
			url: 'AJAX/datosPreguntaRevisar.php',
			type: "POST",
			data: "cod="+cod,
			beforeSend:function(){$('#mostrarPregunta').html('<div><img src="images/loading.gif"/></div>')},
			success:function(datos){
			$('#mostrarPregunta').html(datos);},
			error:function(){
			$('#mostrarPregunta').html('<p class="error"><strong>El servidor parece que no responde</p>');
			}
		});
	}
	
	//GUARDA LA PREGUNTA EN LA BBDD Y XML
	function guardarModificacionesAJAX(){
		
		var cod = $("#cod").val();
		var question = $("#question").val();
		var answer = $("#respuesta").val();
		var complejidad = $("#complejidad").val();
	
		if ((question == '') || (answer == '')){
			alert ("Ni la pregunta ni la respuesta pueden estar vacias");
	 	}
	 	else{
		 	var header = "cod="+cod+"&question="+question+"&answer="+answer+"&complejidad="+complejidad;
			$.ajax({
				url: 'AJAX/modificarPreguntaAJAX.php',
				type: "POST",
				data: header,
				beforeSend:function(){$('#mensaje').html('<div><img src="images/loading.gif"/></div>')},
				success:function(datos){
					console.log(datos);
					if(datos=="OK")
						$('#mensaje').html('<p class="error"><strong>Pregunta modificada correctamente</p>');
					else
						$('#mensaje').html('<p class="error"><strong>La pregunta no ha podido modificarse</p>');	
						},
				error:function(){
				$('#mensaje').fadeIn().html('<p class="error"><strong>La pregunta no ha podido modificarse</p>');
				}
			});
		}
	}	
</script>
