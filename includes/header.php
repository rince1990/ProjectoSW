<?php
include_once 'funciones.php';	
	
function visualizarNombre()
{
	if (comprobarLogueado())
		echo $_SESSION["username"];
	else
		echo "invitado";
}
?>

<header class='main' id='h1'>
	<?php if(!comprobarLogueado()){ ?>
		<span class="right"><a href="registro_html5.php">Registrarse</a></span>
      		<span class="right"><a href="login.php">Login</a></span> 
      		<?php }else{  ?>
      		<span class="right"><a href="logout.php">Logout</a></span> <?php } ?>
      		<span  style="float:right";>Bienvenido <?php echo visualizarNombre();?></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
    
    