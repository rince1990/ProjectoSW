<?php session_start();
	include_once ("conectbd.php");
	$link = conectar();

	 ?>

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

	<div>
<?php
	
	$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$email = $_POST['email'];
$token = $_POST['token'];
	
	if( $password1 != "" && $password2 != "" && $email != "" && $token != "" ){
		 $resultado = $link->query("SELECT * FROM tblreseteopass WHERE token = '$token'");
		 if( $resultado->num_rows > 0 ){
		 		$usuario = $resultado->fetch_assoc();
		 		if( sha1( $usuario['email'] === $email ) ){
		 			if( $password1 === $password2 ){
			 			//$resultado = $link->query("UPDATE Usuario SET password = '".sha1(md5($password1))."' WHERE email = '".$usuario['email']."'");
			 			$sql = "UPDATE Usuario SET password='".sha1(md5($password1))."', estado='', intentos='0' WHERE email='".$usuario['email']."'";
			 			$resultado = $link->query($sql);	
			 			echo $link->error;
			 			if($resultado){
			 				$resultado = $link->query("DELETE FROM tblreseteopass WHERE token = '$token';" );
							$resultado = true;
							?>
							<p class="alert alert-info"> La contraseña se actualizó con exito. </p>
						<?php
						}else{
						?>
	             			<p class="alert alert-danger"> Ocurrió un error al actualizar la contraseña, intentalo más tarde </p>
				 		<?php
				 		}
				 	}else{
					?>
						<p class="alert alert-danger"> Las contraseñas no coinciden </p>
					<?php
					}
				}else{
				?>
					<p class="alert alert-danger"> El token no es válido </p>
				<?php
				}
		}else{
		?>
			<p class="alert alert-danger"> El token no es válido </p>
		<?php
		}
	}else{
		?>
		<p class="alert alert-danger">Faltan campos por rellenar</p>
		<?php
		}
		?>
	</div>
    </section>
	<?php include('includes/footer.html'); ?>
</div>
</body>
</html>
