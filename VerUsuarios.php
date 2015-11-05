
<?php session_start(); 
	include ("conectbd.php");
		$link=Conectar();
		$result=mysqli_query($link, "select * from Usuario");
	
?>

<!DOCTYPE html>
<html>
	<head>
<?php include('includes/metaAndCSS.html'); ?>
	<title>Usuarios de Quiz</title>
	</head>
  <body>
  <div id='page-wrap'>
	
  	<?php include('includes/header.php'); ?>
	<?php include('includes/navigationMenu.php'); ?>

    <section class="main" id="s1">

	<div>
	<table id="tablaUsuarios">
			<tr>
				<td>Nombre y Apellidos</td>
				<td>Email</td>
				<td>Password</td>
				<td>Telefono</td>
				<td>Especialidad</td>
				<td>Intereses</td>
				<td>Foto</td>
			</tr>
			
			<?php
				
				while ($row = mysqli_fetch_array($result)) {
				$email =$row['email'];	
				$result2=mysqli_query($link, "SELECT * FROM Foto WHERE email LIKE '$email'");
				$imagerow = mysqli_fetch_assoc($result2);

				
			?>
				<tr>
					<td><?php echo $row["nomApellidos"]; ?></td>
					<td><?php echo $row["email"]; ?></td>
					<td><?php echo $row["password"]; ?></td>
					<td><?php echo $row["telefono"]; ?></td>
					<td><?php echo $row["especialidad"]; ?></td>
					<td><?php echo $row["otrosIntereses"]; ?></td>
					<td><?php echo '<img src="data:image/png;base64,'.base64_encode( $imagerow['imagen'] ).'" width=200 height =200/>'; ?></td>
					
				</tr>
			
			<?php
				}
			mysqli_free_result($result2);
			mysqli_free_result($result);
			mysqli_close($link);
			?>
		</table>
	</div>
    </section>
	<?php include('includes/footer.html'); ?>
</div>
</body>
</html>
	