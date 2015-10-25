<html>
	<head>
		<title></title>
		<style>
			body {
				background-color: #B8B8B8;
			}			
			table, th, td {
				border: 3px solid black;
				border-collapse: collapse;
				width: 50%;
				height: 30px;
				text-align: center;
				vertical-align: center;
				padding: 7px;
				background-color:#D9D9D9;
				margin: auto;
			}
		</style>
	</head>
	<body>
		<?php
		include ("conectbd.php");
		$link=Conectar();
		$result=mysqli_query($link, "select * from Usuario");
		?>
		
		<table border=1 cellspacing=1 cellpadding=1>
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
		<br/>		
		<a id="index" href="layout.php">Inicio</a>
	</body>
</html>
				