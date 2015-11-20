<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Registro</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">

	 //varialbes para dejar registrarse comprobando con ajax email y pass
	 var emailComprobado;
	 var passComprobado;
	 var ticket;
	 var codigo;
	 $( window ).load(function() {
	 	 emailComprobado = false;
	 	 passComprobado = false;
		 passComprobado = false;
		 codigo='1234';
	});

    //Funcion para añadir/quitar textbox que permita escoger otra especialidad
    function addOthers(){
    var selectChoice=document.getElementById('especialidad');
    var selectedValue = selectChoice.options[selectChoice.selectedIndex].value;

    if(selectedValue =='otros'){
    var label = document.createElement("otraEspecialidad");
    var element = document.createElement("input");
    label.innerHTML = "¿Que especialidad?    ";
    label.setAttribute("name","etiqueta")
    label.setAttribute("id","lblOtraEspecialidad")
    element.setAttribute("name","otra");
    element.setAttribute("id","txbOtraEspecialidad");

    var foo = document.getElementById("other");
    foo.appendChild(label);
    foo.appendChild(element);
    }
    if(selectedValue!='otros'){
    try{
    document.getElementById("lblOtraEspecialidad").remove();
    document.getElementById("txbOtraEspecialidad").remove();
    }catch(err){}

    }

    }


    function createImage(){

        //delete the old one
        try{
            document.getElementById("uploadedImage").remove();
        }catch(error){

        }
        var img = document.createElement("img");
        img.src = "#";
        img.width = 150;
        img.height = 200;
        img.alt = "your photo";
        img.id = "uploadedImage";
        $("#upload").after("<br id='uploadBR'/>");
        $("#uploadBR").after(img);
    }

    $("document").ready(function(){
    $("#upload").change(function() {
                createImage();
                readURL(this);
            });


    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
            $('#uploadedImage').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function matchPassword(input) {
        if (input.value != document.getElementById('passw1').value) {
            input.setCustomValidity('Las contraseñas no coinciden');
        } else {
            // input is valid -- reset the error message
            input.setCustomValidity('');
        }
    }



    function vervalores(){
    var sAux="";
    var frm = document.getElementById("registro");
    for (i=1;i<frm.elements.length;i++)
    {
    sAux += "NOMBRE: " + frm.elements[i].name + " ";
    sAux += "VALOR: " + frm.elements[i].value + "\n" ;
    }
    alert(sAux);
    }

	function comprobarLDAP(){

$.ajax({
url: 'AJAX/comprobarLDAP.php',
type: "POST",
cache : false,
data: "email="+$('#email').val(),
beforeSend:function(){
	$(".imgcheck").remove();
	$('#email').after('<img class="imgcheck" src="images/loading.gif"/>')},
success:function(datos){
	$(".imgcheck").remove();
	if(datos=='SI'){
		 $('#email').after("<img class='imgcheck' src='images/Green_check.png'/>");
		 emailComprobado = true;
		 }
	else {
		$('#email').after("<img class='imgcheck' src='images/Red_check.png'/>");
		emailComprobado = false;
		}
},
error:function(){
		$(".imgcheck").remove();
$('#email').aAfter('<p class="imgcheck" class="error"><strong>El servidor parece que no responde</p>');
		 emailComprobado = false;

}
});

	}
	

	function comprobarPassSOAP(){
	var pass=$('#passw1').val();
	var sendingData={"pass" : pass, "codigo": codigo};
	$.ajax({
		url: 'AJAX/comprobarTopPasswords.php',
		type: "POST",
		cache : false,
		data : sendingData,
		beforeSend:function(){
		$(".imgcheck2").remove();
		$('#passw1').after('<img class="imgcheck2" src="images/loading.gif"/>')},
		success:function(datos){
			$(".imgcheck2").remove();
				if(datos=='NO_AUTORIZADO') {
				ticket = false;
				}
				else{
					if(datos=='VALIDA'){
						$('#passw1').after("<img class='imgcheck2' src='images/Green_check.png'/>");
						passComprobado = true;
						ticket = true;
						}
					else{
						$('#passw1').after("<img class='imgcheck2' src='images/Red_check.png'/>");
						passComprobado = false;
						ticket = true;
					}
				}
			},
		error:function(){
			$(".imgcheck2").remove();
			$('#passw1').after('<p  class="imgcheck2" class="error"><strong>El servidor parece que no responde</p>');
			passComprobado = false;
			ticket = false;
		}
		});
	}

	function validacionSoap(){
	
		if (ticket) {
			if (emailComprobado && passComprobado) return true;
			else {
				alert("los campos email y/o password no han sido validados");
				return false;
				}
		}
		else{
			alert("USUARIO NO AUTORIZADO");
			return false;
		}	
	}


    </script>
    <?php include('includes/metaAndCSS.html'); ?>
</head>

 <div id='page-wrap'>

  	<?php include('includes/header.php'); ?>
	<?php include('includes/navigationMenu.php'); ?>
	
	
    <section class="main" id="s1">
	
	<?php if (!comprobarLogueado()){ 
	?>
		
	
	<div>
	<form id='registro' action='registrar.php' method="post" enctype="multipart/form-data" onsubmit='return validacionSoap()'>
	<table>
		<tr>
			<td>
				Nombre y apellidos(*):
			</td>
			<td>
				<input type="text" name="name" id="name" placeholder="Juan Perez Corta" pattern="([A-Z][a-z]*\s){2,3}[A-Z][a-z]*" required="">
			</td>
		</tr>
		<tr>
			<td>
				Dirección de correo(*):
			</td>
			<td>
				<input type="email" name="email" id="email" placeholder="jvadillo001@ikasle.ehu.es"  required="" pattern="^[A-Za-z]+[0-9]{3}@ikasle.ehu.(eus|es)$" onblur="comprobarLDAP()">
			</td>
		</tr>
		<tr>
			<td>
				Password(*):
			</td>
			<td>
				<input type="password" name="passw1" id="passw1" pattern="^[\w]{6,20}$" required="" onblur="comprobarPassSOAP()">
			</td>

		</tr>
		<tr>
			<td>
				Repite password:(*):
			</td>
			<td>
				<input type="password" name="passw2" id="passw2" pattern="^[\w]{6,20}$" oninput="matchPassword(this)" required="" >
			</td>
		</tr>
		<tr>
			<td>
				Número de teléfono:
			</td>
			<td>
				<input type="tel" name="phone" id="phone" pattern="^[0-9]{9}$" placeholder="943223344">
			</td>
		</tr>
		<tr>
			<td>
				Especialidad(*):
			</td>
			<td>
				<select id="especialidad" onchange="addOthers()" name="Especialidad" required="">
                <option value="software">Ingeniería del Software </option>
                <option value="hardware">Ingeniería de Computadores</option>
                <option value="computacion">Computación</option>
                <option value="otros">otros</option>
            </select>

            <div id="other"></div>
			</td>
		</tr>
		<tr>
			<td>
				Tecnologías y herramientas en las que está interesado:
			</td>
			<td>
				<textarea name="interested" rows="4" cols="50"></textarea><br>
				<div id="other"></div>
			</td>
		</tr>
		<tr>
			<td>
				Sube tu foto:
			</td>
			<td>
				 <input type='file' id="upload" name="upload"><br>
			</td>
		</tr>
	</table>
    <input name="Submit" type="submit" value="Submit">
    </form>
	</div>
<?php } else{
			echo 'Ya estas logueado '.$_SESSION['username'].', no hace falta que te registres de nuevo';
		
}
	 ?>
	
    </section>
	<?php include('includes/footer.html'); ?>
</div>
</body>
</html>
