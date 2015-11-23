<?php session_start();
	include_once ("conectbd.php");
	$link = conectar();
	
	
	 ?>

<!DOCTYPE html>
<html>
	<head>
<?php include('includes/metaAndCSS.html'); ?>
	<title>Quiz Game</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
	<script>
		var passComprobado = false;
		function comprobarSimilitud(){
			if ($('#password1').val()==$('#password2').val())
				if(passComprobado)
				return true;
				else{
					alert("El password no ha sido validado");
					return false;
				}
			else{
				alert("Las contraseñas no coinciden");
				return false;
				}
		}
		
			function comprobarPassSOAP(){
	var pass=$('#password1').val();
	var sendingData={"pass" : pass, "codigo": 0000};
	$.ajax({
		url: 'AJAX/comprobarTopPasswords.php',
		type: "POST",
		cache : false,
		data : sendingData,
		beforeSend:function(){
		$(".imgcheck3").remove();
		$('#password1').after('<img class="imgcheck3" src="images/loading.gif"/>')},
		success:function(datos){
			$(".imgcheck3").remove();
				if(datos=='NO_AUTORIZADO') {	
				alert("El servicio de validación de passwords no admite el ticket utilizado");
				}
				else{
					if(datos=='VALIDA'){
						$('#password1').after("<img class='imgcheck3' src='images/Green_check.png'/>");
						passComprobado = true;
						}
					else{
						$('#password1').after("<img class='imgcheck3' src='images/Red_check.png'/>");
						passComprobado = false;
					}
				}
			},
		error:function(){
			$(".imgcheck3").remove();
			$('#password1').after('<p  class="imgcheck3" class="error"><strong>El servidor parece que no responde</p>');
			passComprobado = false;
		}
		});
	}
		
		
	</script>	
	</head>
  <body>
  <div id='page-wrap'>
	
  	<?php include('includes/header.php'); ?>
	<?php include('includes/navigationMenu.php'); ?>

    <section class="main" id="s1">

	<div>
	<?php
		
		$token = $_GET['token'];
		$email = $_GET['email'];

		
	//comprobamos que el token existe en la tabla	
   $resultado = $link->query("SELECT * FROM tblreseteopass WHERE token = '$token'");
   if( $resultado->num_rows > 0 ){
   		$usuario = $resultado->fetch_assoc();
   		//comprobamos que el email recibido coincide con el de la tabla cuando lo ciframos

   		if( sha1($usuario['email']) == $email ){


?>

<form action="resetearPass.php" method="post" onSubmit="return comprobarSimilitud()">
      <div><strong> Restaurar contraseña </strong></div><br/>
        <label for="password"> Nueva contraseña </label>
        <input type="password"  name="password1"  id="password1" pattern="^[\w]{6,20}$" onblur="comprobarPassSOAP()" required><br/>
        <label for="password2"> Confirmar contraseña </label>
        <input type="password"  name="password2"  id="password2" required><br/>
       <input type="hidden" name="token" value="<?php echo $token ?>">
       <input type="hidden" name="email" value="<?php echo $email ?>">
        <input type="submit" value="Cambiar contraseña" >
       </div>
      </div>
     </div>
    </form>

<?php
	//Si el token o el email no se encuentran en la tabla, se le redirige al layout.php
	 }
   else{
     header('Location:layout.php');
   }
 }
 else{
     header('Location:layout.php');
 }
	
?>	
	</div>
    </section>
	<?php include('includes/footer.html'); ?>
</div>
</body>
</html>
