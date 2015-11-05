
<?php session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
<?php include('includes/metaAndCSS.html'); ?>
	<title>Obtener datos</title>
	<script type="text/javascript">
function completar(){
    var enc=false;
    
    var  xmlDoc = document.getElementById('datos').contentDocument;
    var correo = document.getElementById("correo").value;
    var listacorreos=xmlDoc.getElementsByTagName("email");
    var listatelefonos=xmlDoc.getElementsByTagName("telefono");

    

    for (var i = 0; i < listacorreos.length; i++) {
      if (correo==listacorreos[i].childNodes[0].nodeValue){
       document.getElementById('telefono').value = xmlDoc.getElementsByTagName("telefono")[i].childNodes[0].nodeValue;
       document.getElementById('nombre').value = xmlDoc.getElementsByTagName("nombre")[i].childNodes[0].nodeValue;
       document.getElementById('apellido1').value = xmlDoc.getElementsByTagName("apellido1")[i].childNodes[0].nodeValue;
       document.getElementById('apellido2').value = xmlDoc.getElementsByTagName("apellido2")[i].childNodes[0].nodeValue;
	   enc=true;
	   break;
	   } 
	}
    if (!enc){alert ('Este correo no está registrado en la UPV/EHU. Introduzca otro');}
    
    }
    
    
      </script>
	</head>
  <body>
  <div id='page-wrap'>
	
  	<?php include('includes/header.php'); ?>
	<?php include('includes/navigationMenu.php'); ?>

    <section class="main" id="s1">

	<div>
	<h1>Buscar datos de usuario ...</h1>
        <object id="datos" data="XML/usuarios.xml" type="text/xml" style="display:none">
            </object>

        <form method="post" action="insertar.php">
            Introduce el Correo<br>
            <input type="text" name="correo" id="correo" /><br>
            Nombre y apellidos<br>
            <input type="text" name="nombre" id="nombre" disabled="true" /><br>
            Teléfono<br>
            <input type="text" name="telefono" id="telefono" disabled="true" /><br>
			Primer apellido<br>
            <input type="text" name="apellido1" id="apellido1" disabled="true" /><br>
			Segundo apellido<br>
            <input type="text" name="apellido2" id="apellido2" disabled="true" /><br>

            <br>
            <input type="button" value="Autocompletar" onclick="javascript:completar()">
        </form>
	</div>
    </section>
	<?php include('includes/footer.html'); ?>
</div>
</body>
</html>

