<?php
session_start();
include_once 'funciones.php';

if (comprobarlogueado())
{
	if ($_SESSION["rol"] != "alumno")
	{
		//si no es profesor, envio a la página principal
		header("Location: layout.php");
	}
}else
{
	header("Location: login.php");
	exit();
}
