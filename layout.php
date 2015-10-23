<?php

session_start();

function visualizarNombre()
{
	if (isset($_SESSION["username"]))
		echo $_SESSION["username"];
	else
		echo "invitado";
}


function visualizarLinkInsertarPregunta()
{

	if (isset($_SESSION["username"]))
		echo "<span><a href='insertarPregunta.php'>Insertar Pregunta</a></spam>";

}


?>

<!DOCTYPE html>
<html>
  <head>

    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet'
		   type='text/css'
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet'
		   type='text/css'
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class="right"><a href="registro_html5.html">Registrarse</a></span>
      		<span class="right"><a href="login.php">Login</a></span>
      		<span class="right"><a href="logout.php">Logout</a></span>
      		<span  style="float:right";>Bienvenido <?php echo visualizarNombre();?></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Inicio</a></spam>
		<span><a href='verPreguntas.php'>Preguntas</a></spam>
		<span><a href='creditos.html'>Creditos</a></spam>
		<?php visualizarLinkInsertarPregunta() ?>
	</nav>
    <section class="main" id="s1">

	<div>
	Aqui se visualizan las preguntas y los creditos ...
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
