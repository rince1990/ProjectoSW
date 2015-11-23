<?php
session_start();
include_once ("../conectbd.php");
require_once '../funciones.php';
$link=Conectar();
$email = $_POST['email'];


 
if( $email != "" ){
   $resultado = $link->query(" SELECT * FROM Usuario WHERE email = '$email' ");
   if($resultado->num_rows > 0){
      $usuario = $resultado->fetch_assoc();
      $linkTemporal = generarLinkTemporal($usuario['email'],$link);
      if($linkTemporal){
        enviarEmail( $usuario['email'], generarMensaje($linkTemporal) );
        echo '<div class="alert alert-info"> Un correo ha sido enviado a su cuenta de email con las instrucciones para restablecer la contraseña </div>';
      }else{
	      echo 'No puedo generarse la accion';
      }
      
   }
   else
      echo '<div class="alert alert-warning"> No existe una cuenta asociada a ese correo. </div>';
}
else
  echo "Debes introducir el email de la cuenta";


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
      return FALSE;
}


function generarMensaje($link){
	
	  return $mensaje = '<html>
     <head>
        <title>Restablece tu contraseña</title>
     </head>
     <body>
       <p>Hemos recibido una petición para restablecer la contraseña de tu cuenta.</p>
       <p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
       <p>
         <strong>Enlace para restablecer tu contraseña</strong><br>
         <a href="'.$link.'"> Restablecer contraseña </a>
       </p>
     </body>
    </html>';

	
	
}
?>