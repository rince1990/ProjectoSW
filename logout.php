<?php 
	include_once 'funciones.php';
 //Crear sesión
 session_start();
 usuarioEstaOffline();
 //Vaciar sesión
 $_SESSION = array();
 //Destruir Sesión
 session_destroy();
 //Redireccionar a layout.php
 header("location: layout.php");
?>

