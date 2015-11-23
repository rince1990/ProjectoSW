<?php

function validarDatos()
{
	if (!filter_var($_REQUEST['name'], FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/([A-Z][a-z]*\s){2,3}[A-Z][a-z]*/")))) //nombre
		return false;
	if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[A-Za-z]+[0-9]{3}@ikasle.ehu.(eus|es)$/")))) //email
		return false;
	if (!filter_var($_REQUEST['passw1'], FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[\w]{6,20}$/")))) //contraseña
		return false;
	if (!filter_var($_REQUEST['phone'], FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[0-9]{9}$/")))) //telefono
		return false;

	return true;
}


function subir_foto($link,$file,$email)
{

	
	if ($file['error']!=0)
		echo "Foto no subida.<br/>";
	else
	{
		//addslashes to prevent any mysql injection
		$image = addslashes(file_get_contents($file['tmp_name']));
		$image_name = addslashes($file['name']);
		$image_size = getimagesize($file['tmp_name']);
		$image_type = addslashes($file['type']);

		if ($image_size==FALSE) //if is not an image will return false
			echo "No has seleccionado una imagen, foto no subida<br/>";
		else
		{
			if (!$insert = mysqli_query($link,"INSERT INTO Foto(email,type,imagen) VALUES('$email','$image_type','$image')"))
				printf("No se ha podido insertar la imagen en la base de datos:</br> %s>", $link->error);

		}
	}

}


function registrar_usuario($link,$sql)
{


	if (mysqli_query($link, $sql))
	{
		printf("Usuario registrado correctamente</br>");
		printf("Seras redirigido a la pagina de usuarios en 10 segundos, o puedes hacer click <a href='VerUsuarios.php'>aqui</a><br/> ");
		header( "refresh:10;url=VerUsuarios.php" );
		//die();
	}else

		printf("No se ha podido insertar el usuario en la base de datos:</br> %s>", $link->error);

}


?>

<?php session_start();


include ("conectbd.php");

$link = Conectar();

// escape variables for security
$name = mysqli_real_escape_string($link, $_POST['name']);
$email = mysqli_real_escape_string($link, $_POST['email']);
$password = mysqli_real_escape_string($link, $_POST['passw1']);
$password_enc = sha1(md5($password));
$phone = mysqli_real_escape_string($link, $_POST['phone']);
$especialidad = mysqli_real_escape_string($link, $_POST['Especialidad']);
if ($especialidad == 'otros')
	$especialidad = mysqli_real_escape_string($link, $_POST['otra']);
$intereses = mysqli_real_escape_string($link, $_POST['interested']);
$image = $_FILES['upload'];


//prepare and insert SQL statement
$sql = "INSERT INTO Usuario (email, nomApellidos, password, telefono, especialidad, otrosIntereses)
	VALUES ('$email','$name' , '$password_enc', '$phone', '$especialidad', '$intereses')";

?>

<!DOCTYPE html>
<html>
	<head>
<?php include('includes/metaAndCSS.html'); ?>
	<title>Registrando...</title>
	</head>
  <body>
  <div id='page-wrap'>

  	<?php include('includes/header.php'); ?>
	<?php include('includes/navigationMenu.php'); ?>

    <section class="main" id="s1">

	<div>
	<?php

if
(validarDatos())
{
	registrar_usuario($link,$sql);
	subir_foto($link,$image,$email);
}else
{
	echo "Datos no validos, vuelve a la p&aacutegina de formulario -> <a href='registro_html5.html' >REGISTRO</a>";
}


?>	</div>
    </section>
	<?php include('includes/footer.html'); ?>
</div>
</body>
</html>

<?php mysqli_close($link); ?>
