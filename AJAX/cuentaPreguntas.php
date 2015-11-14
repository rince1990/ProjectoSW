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
   $sql = "select count(*) as totalOnline from conexiones_online";
   $result3 = $link->query($sql);
   $result3 = mysqli_fetch_assoc($result3);

   
   
echo "<strong>Numero de usuarios online :</strong>".$result3['totalOnline']."</br>";
echo "<strong>Mis preguntas/Todas las preguntas: </strong>".$result['misPreguntas']."/".$result2['totalPreguntas']."<br/>";

   

?>