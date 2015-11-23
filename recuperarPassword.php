<?php session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
<?php include('includes/metaAndCSS.html'); ?>
	<title>Quiz Game</title>
	</head>
  <body>
  <div id='page-wrap'>
	
  	<?php include('includes/header.php'); ?>
	<?php include('includes/navigationMenu.php'); ?>

    <section class="main" id="s1">
	<strong>Recuperar Contraseña</strong>
	<div>
        <label for="email"> Escribe tu email:</label><br/>
        <input type="email" id="email" name="email"><br/>
        <input type="button" value="Recuperar contraseña"  onclick="recuperarPass()">
      </div>
      <div id="respuestaAJAX"></div>
    </section>
	<?php include('includes/footer.html'); ?>
</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
<script>
function recuperarPass(){ 
$.ajax({
url: 'AJAX/enviarEmailPass.php',
type: "POST",
data: "email="+$("#email").val(),
beforeSend:function(){$('#respuestaAJAX').html('<div><img src="images/loading.gif"/></div>');},
success:function(datos){$('#respuestaAJAX').html(datos);},
error:function(){$('#respuestaAJAX').html('<p class="error"><strong>El servidor parece que no responde. Intentelo de nuevo en unos minutos</p>');}
});
}





 </script>
