
<?php 
		session_start();

	if
(!comprobarLogueado())
	{ ?>
<form action="login.php" method="post" class="login">
    <div>Username<input name="user" type="text" value="jhacker001@ikasle.ehu.es"></div>
    <div>Password<input name="pass" type="password" value="123456"></div>
    <div><input name="login" type="submit" value="login"></div>
</form>

<a href="layout.html">Atras</a>

<?php
}
else
{
	echo 'Ya estas logueado '.$_SESSION["username"].' <a href="layout.php">Atras</a>';
}


include ("conectbd.php");



if
(isset($_POST['user']) && isset($_POST['pass']))
{
	verificarLogin($_POST['user'], $_POST['pass']);
}


function verificarLogin($user,$pass)
{

	//El password obtenido se le aplica el crypt(md5)
	//Posteriormente se compara en el query
	$pass_c = md5($pass);
	$q = "select * from Usuario where email='$user' and password='$pass_c'";

	//obtenemos el link de la BD y ejecutamos la consulta
	$link = Conectar();
	$result = $link->query($q);

	//Si el resultado obtenido no tiene nada
	//Muestra el error y redirige al index
	if
	( $result->num_rows == 0)
	{
		echo $user;
		echo $pass_c;
		echo'<script type="text/javascript">
                alert("Usuario o Contrasenia Incorrecta.");
                window.location="login.php"
                </script>';

		//      printf("Usuario registrado correctamente</br>");
		//printf("Seras redirigido a la pagina de usuarios en 10 segundos, o puedes hacer click <a href='VerUsuarios.php'>aqui</a><br/> ");
		//header( "refresh:10;url=VerUsuarios.php" );
		//die();
	}

	//En otro caso
	//En $reg se guarda el resultado de la consulta
	//Al segundo posición de SESION se le asigna el id del usuario
	else
	{
		$reg = mysqli_fetch_assoc($result);
		session_start();
		$_SESSION["codSesion"] = guardarConexion($reg['email']);
		$_SESSION["useremail"] = $reg['email'];
		$_SESSION["username"] = $reg['nomApellidos'];

		header("location:layout.php");
		$link->close();
		die();
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


function guardarAccion($email,$accion)
{

	if
	(isset($_SESSION["codSesion"]))
		$cod = $_SESSION["codSesion"];
	else
		$cod=NULL;

	date_default_timezone_set("Europe/Madrid");
	$date = date('Y-m-d H:i:s');
	$sql = "INSERT INTO Acciones (cod_conexion,email,accion,time) VALUES ('$cod','$email','$accion','$date')";

	$link = Conectar();
	$link->query($sql);
	$link->close();

}


function comprobarLogueado()
{
	if (isset($_SESSION['useremail'])) return true;
	else return false;

}