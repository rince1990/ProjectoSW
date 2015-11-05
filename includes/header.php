<?php
function visualizarNombre()
{
	if (isset($_SESSION["username"]))
		echo $_SESSION["username"];
	else
		echo "invitado";
}
?>

<header class='main' id='h1'>
		<span class="right"><a href="registro_html5.php">Registrarse</a></span>
      		<span class="right"><a href="login.php">Login</a></span>
      		<span class="right"><a href="logout.php">Logout</a></span>
      		<span  style="float:right";>Bienvenido <?php echo visualizarNombre();?></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
    
    