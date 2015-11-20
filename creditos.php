<?php session_start();
include_once 'funciones.php';
include_once 'includes/BrowserDetection.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Creditos</title>
<?php include('includes/metaAndCSS.html'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdkrDHjtOdUP89wfAjmwLNxiE80YyZrmA" async defer></script>

<script>

	function mostrarMapa(ip,cliente_servidor){

		URL ='http://freegeoip.net/json/'+ip;

$.ajax({
	url: URL,
	beforeSend:function(){
	$('#map').html('<div><img src="images/loading.gif"/>Espere un momento, puede tardar unos segundos...</div>')},
	success:function(datos){
		initMap(datos.latitude, datos.longitude);
		initData(datos);
	},
	error:function(){
		$('#map').html('<p class="error"><strong>El servidor parece que no responde</p>');
	}
});


function initMap(lat,lon) {
  $("#map").css("width", "800px");
  $("#map").css("height", "300px");
  $("#map").css("margin", "auto");
  $('#map').html("Loading Map...");
  
  var map;

  //creamos el mapa
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: lat, lng: lon},
    zoom: 13
  });
  //añadimos un marcador
  var myLatLng = {lat: lat, lng: lon};
  new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: 'Here!'
  });

}

function initData(datos){
	//mostramos los datos recibidos del JSON
	$('#datos').html("<br/><strong>IP</strong>: "+datos.ip);
	if(datos.country_name.length != 0)$('#datos').append("<br/><br/> <strong>Pais</strong> : "+datos.country_name);
	if(datos.region_name.length != 0)$('#datos').append("<br/> <strong>Region</strong> : "+datos.region_name);
	if(datos.city.length != 0)$('#datos').append("<br/> <strong>Ciudad</strong> : "+datos.city);
	if(datos.zip_code.length != 0)$('#datos').append("<br/><strong>Cod Postal</strong> : "+datos.zip_code);
	
	if(cliente_servidor == 'cliente'){//mostramos más datos del cliente
		<?php $browser = new BrowserDetection(); ?>
		$('#datos').append("<br/><br/> <strong>Navegador</strong> : "+"<?php echo $browser->getBrowser() ?>");
		$('#datos').append("<br/> <strong>Version</strong> : "+"<?php echo $browser->getVersion() ?>");
		$('#datos').append("<br/> <strong>SO</strong> : "+"<?php echo $browser->getPlatform() ?>");
		
	}
	
	
	$('#datos').append("<br/><br/> <strong>Geolocalización</strong> : ");
	//Aqui debajo ira el mapa
}

}



	


</script>
	</head>
  <body>
  <div id='page-wrap'>

  	<?php include('includes/header.php'); ?>
	<?php include('includes/navigationMenu.php'); ?>

    <section class="main" id="s1">

	<div>
	<h1>Adrián González y Marta Garcia </h1><br/>
	<p class="titles">• Especialidad:</p> Ingeniería de Software <br/>
	<p class="titles">• Aficiones:</p> Me gusta dejar el diseño de las páginas para el final.<br/>
	<p class="titles">• Foto :</p> <img id="foto" src="https://pbs.twimg.com/profile_images/1153561157/senorx_400x400.jpg" alt="foto de Señor X" > <br/>
	<button id="mapCliente" onclick="mostrarMapa('<?php echo getIP()?>','cliente')">Tu ubicación</button>
	<button id="mapServidor" onclick="mostrarMapa('<?php echo $_SERVER['SERVER_ADDR']; ?>','servidor')">Ubicación del servidor</button>

	<div id="datos"></div>
	<div id="map" ></div>
	<br/>
	<a id="atras" href="layout.php">Atras </a>

	</div>
    </section>
	<?php include('includes/footer.html'); ?>
</div>
</body>
</html>
