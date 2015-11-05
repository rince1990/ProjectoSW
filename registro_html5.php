<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Registro</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">

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



    </script>
    <?php include('includes/metaAndCSS.html'); ?>
</head>

 <div id='page-wrap'>
	
  	<?php include('includes/header.php'); ?>
	<?php include('includes/navigationMenu.php'); ?>

    <section class="main" id="s1">

	<div>
	<form id='registro' action='registrar.php' method="post" enctype="multipart/form-data">
            Nombre y apellidos(*):<br>
            <input type="text" name="name" id="name" placeholder="Juan Perez Corta" pattern="([A-Z][a-z]*\s){2,3}[A-Z][a-z]*" required=""><br>
            Dirección de correo(*):<br>
            <input type="email" name="email" id="email" placeholder="jvadillo001@ikasle.ehu.es"  required="" pattern="^[A-Za-z]+[0-9]{3}@ikasle.ehu.(eus|es)$"><br>
            Password:<br>
            <input type="password" name="passw1" id="passw1" pattern="^[\w]{6,20}$" required=""><br>
            Repite password:<br>
            <input type="password" name="passw2" id="passw2" pattern="^[\w]{6,20}$" oninput="matchPassword(this)" required=""><br>
            Número de teléfono:<br>
            <input type="tel" name="phone" id="phone" pattern="^[0-9]{9}$" placeholder="943223344"><br>
            Especialidad(*):<br>
            <select id="especialidad" onchange="addOthers()" name="Especialidad" required="">
                <option value="software">Ingeniería del Software </option>
                <option value="hardware">Ingeniería de Computadores</option>
                <option value="computacion">Computación</option>
                <option value="otros">otros</option>
            </select>

            <div id="other"></div><br>
            Tecnologías y herramientas en las que está interesado:<br>
            <textarea name="interested" rows="4" cols="50"></textarea><br>
            <br>
            Sube tu foto: <input type='file' id="upload" name="upload"><br>
             <input name="Submit" type="submit" value="Submit">
        </form>
	</div>
    </section>
	<?php include('includes/footer.html'); ?>
</div>
</body>
</html>

