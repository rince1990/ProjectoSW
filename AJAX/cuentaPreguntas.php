<?php
session_start();
include_once ("../conectbd.php");
require_once '../funciones.php';
$link=Conectar();


$result = $link->query("select count(*) as misPreguntas from Preguntas where email='".$_SESSION['useremail']."'");	
$result2 = $link->query("select count(*) as totalPreguntas from Preguntas");	
$result = mysqli_fetch_assoc($result);
$result2 = mysqli_fetch_assoc($result2);



 //calculamos el numero de sesiones
   $sql = "select email from conexiones_online";
   $result3 = $link->query($sql);
   $usuarios = mysqli_num_rows($result3);
   //liberamos memoria
   mysqli_free_result($result3);
   
   
echo "<strong>Numero de usuarios online :</strong>".$usuarios."</br>";
echo "<strong>Mis preguntas/Todas las preguntas: </strong>".$result['misPreguntas']."/".$result2['totalPreguntas']."<br/>";




?>