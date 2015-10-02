<?php

include ("conectbd.php");

$link = Conectar();

// escape variables for security
$name = mysqli_real_escape_string($link, $_POST['name']);
$email = mysqli_real_escape_string($link, $_POST['email']);
$password = mysqli_real_escape_string($link, $_POST['passw1']);
$password_enc = md5($password);
$phone = mysqli_real_escape_string($link, $_POST['phone']);
$especialidad = mysqli_real_escape_string($link, $_POST['Especialidad']);
if ($especialidad == 'otros')
	$especialidad = mysqli_real_escape_string($link, $_POST['otra']);
$intereses = mysqli_real_escape_string($link, $_POST['interested']);


//prepare and insert SQL statement
$sql = "INSERT INTO Usuario (email, nomApellidos, password, telefono, especialidad, otrosIntereses)
		VALUES ('$email','$name' , '$password_enc', '$phone', '$especialidad', '$intereses')";




if (mysqli_query($link, $sql))
{
	printf("Usuario registrado correctamente</br>");
	printf("Seras redirigido a la pagina de usuarios en 5 segundos, o puedes hacer click <a href='VerUsuarios.php'>aqui</a> ");
	header( "refresh:5;url=VerUsuarios.php" );
	die();

	header( "refresh:5;url=wherever.php" );
}else

	printf("No se ha podido insertar en la base de datos:</br> %s>", $link->error);


printf("cerrando bbdd");
mysqli_close($link);


?>