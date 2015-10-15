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
$image = $_FILES['upload'];


//prepare and insert SQL statement
$sql = "INSERT INTO Usuario (email, nomApellidos, password, telefono, especialidad, otrosIntereses)
	VALUES ('$email','$name' , '$password_enc', '$phone', '$especialidad', '$intereses')";


if
(validarDatos($email))
{
	registrar_usuario($link,$sql);
	subir_foto($link,$image,$email);
}else{
	echo "Email no validado, vuelve a la p&aacutegina de formulario -> <a href='registro_html5.html' >REGISTRO</a>";
}


mysqli_close($link);



function validarDatos($email)
{
	
	return filter_var($email, FILTER_VALIDATE_REGEXP,
			array("options"=>array("regexp"=>"/^[A-Za-z]+[0-9]{3}@ikasle.ehu.(eus|es)$/"))); // <-- look here

}





function subir_foto($link,$file,$email)
{


	if (!isset($file))
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
