<?php
session_start();
include_once ("conectbd.php");
include_once 'funciones.php';


	
function generarLinkTemporal($email,$link){
   // Se genera una cadena para validar el cambio de contraseña
   $cadena = $email.rand(1,9999999).date('Y-m-d');
   // Se cifra la cadena para que nadie mas tenga acceso a ella ni pueda averiguar como se ha formado
   $token = sha1($cadena);
 

   $result = $link->query("INSERT INTO tblreseteopass (email, token) VALUES('$email','$token')");
   if($result){
      // Se devuelve el link que se enviara al usuario
      $enlace = $_SERVER["SERVER_NAME"].'/ProjectoSW/resetearPassForm.php?email='.sha1($email).'&token='.$token;
      return $enlace;
   }
   else
      return 'ERROR';
}


function generarMensaje($linktemporal){
	
	
	 $mensaje = '<html>
     <head>
        <title>Restablece tu contraseña</title>
     </head>
     <body>
       <p>Hemos detectado un numero elevado de intentos para entrar a tu cuenta, por ello hemos decido bloquearla temporalmente.</p>
       <p>Para desbloquearla cambiar tu password actual por uno más nuevo.</p>
       <p>
         <strong>Enlace para cambiar tu contraseña</strong><br>
         <a href="'.$linktemporal.'"> Cambiar contraseña </a>
       </p>
     </body>
    </html>';

	return $mensaje;
	
	
}


?>
<!DOCTYPE html>
<html>
	<head>
<?php include('includes/metaAndCSS.html'); ?>
	<title>Login</title>
	</head>
  <body>
  <div id='page-wrap'>

  	<?php include('includes/header.php'); ?>
	<?php include('includes/navigationMenu.php'); ?>

    <section class="main" id="s1">

	<div>
		<p>
		<?php
if
(isset($_POST['user']) && isset($_POST['pass']))
{
	verificarLogin($_POST['user'], $_POST['pass']);
}


function verificarLogin($user,$pass)
{

	//El password obtenido se le aplica el crypt(md5)
	//Posteriormente se compara en el query
	$pass_c = sha1(md5($pass));
	$q = "select * from Usuario where email='$user' and password='$pass_c'";

	//obtenemos el link de la BD y ejecutamos la consulta
	$link = Conectar();
	$result = $link->query($q);

	//Si el resultado obtenido no tiene nada
	if ($result->num_rows == 0)
	{
		$q = "select intentos, estado from Usuario where email='$user'";
		$result = $link->query($q);
		
		if ( $result->num_rows != 0) {
		
			$res = mysqli_fetch_assoc($result);
			
			//si estado es bloqueado
			//Muestra un error y redirige al index
			if ($res['estado']=='bloqueado') 
			echo 'El usuario esta bloqueado, se le ha enviado un email para restaurarlo';
				
			//Sino, se incrementa en uno el numero de intentos
			else {
				$intentos = $res['intentos'];
				$intentos = $intentos +1;

				//Si es el tercer intento fallido, se bloquea el usuario
				//Muestra un error y redirige al index				
				if($intentos==3) {
					$q = "UPDATE Usuario SET intentos='$intentos', estado='bloqueado' where email='$user'";
					$result = $link->query($q);
					$linktemporal = generarLinkTemporal($user,$link);
					enviarEmail($user, generarMensaje($linktemporal));
					echo 'El usuario ha sido bloqueado, se le ha enviado un email para restaurarlo';

				}
				else {
					$q = "UPDATE Usuario SET intentos='$intentos' where email='$user'";	
					$result = $link->query($q);	
					
					echo'Usuario o Contrasenia Incorrecta';
				}
			}
		}
		else{
			echo'Usuario o Contrasenia Incorrecta';

		}
	}

	//En otro caso
	//En $reg se guarda el resultado de la consulta
	//Al segundo posición de SESION se le asigna el id del usuario
	else
	{
		$reg = mysqli_fetch_assoc($result);
		if($reg['estado']!='bloqueado') {
		session_start();
		$_SESSION["codSesion"] = guardarConexion($reg['email']);
		$_SESSION["useremail"] = $reg['email'];
		$_SESSION["username"] = $reg['nomApellidos'];
		$_SESSION["rol"]= $reg['rol'];
		
		//Poner a cero el numero de intentos
		$q = "UPDATE Usuario SET intentos='0' where email='$user'";	
		$result = $link->query($q);
		
		usuarioEstaOnline();
		header("location:layout.php");
		$link->close();
		die();
		}
		else
		{
			echo'<script type="text/javascript">
                alert("El usuario esta bloqueado.");
                window.location="layout.php"
                </script>';
		}
	}
}


//guarda la conexión en la tabla conexiones y devuelve el codigo de dicha conexion
function guardarConexion($email)
{
	date_default_timezone_set("Europe/Madrid");
	$date = date('Y-m-d H:i:s');
	$sql = "INSERT INTO Conexiones (email,time) VALUES ('$email','$date')";

	$link = Conectar();
	$link->query($sql);

	$sql = "select cod from Conexiones where email='$email' and time='$date'";
	$result= $link->query($sql);
	$reg = mysqli_fetch_assoc($result);
	$cod = $reg['cod'];
	$link->close();
	return $cod;

}				
		echo '</p><br/>';
		if
(!comprobarLogueado())
	{ ?>
<form action="login.php" method="post" class="login">
    <div>Username<input name="user" type="text" value="web000@ehu.es"></div>
    <div>Password<input name="pass" type="password" value="web000"></div>
    <div><input name="login" type="submit" value="login"></div>
</form>

¿Has olvidado tu contraseña? Recuperala <a href="recuperarPassword.php">AQUI</a>

<?php
}
else
{
	echo 'Ya estas logueado '.$_SESSION["username"].' <a href="layout.php">Atras</a>';
}?>

	</div>
    </section>
	<?php include('includes/footer.html'); ?>
</div>
</body>
</html>

<?php
	
	
		
		
	
	
	
	?>
	
	
	
	
