<!-- Start the sesion -->
<?php
	include("config.php");
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>FCloud | Dashbord</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/dashbord.css">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
	<script type="text/javascript" src="js/sweetalert.min.js"></script>
	<script type="text/javascript" src="js/dashbord.js"></script>
</head>
<body>
	<?php
		if(!isset($_SESSION["username"])){
			echo "<script>location.href='index.php'</script>";
		}
		else{
			//Get the user name
			$query="SELECT firstName,lastName FROM users WHERE username='".$_SESSION["username"]."'";
			$result = $conexionMySQL->query($query);
			if($result){
				//get the first row of data
				$renglon = $result->fetch_assoc();
				//save the data
				$firstName = $renglon['firstName'];
				$lastName = $renglon['lastName'];
				$result->free();
			}
			else{
				echo '<script>swal("Error!", "Error interno del servidor!", "error");</script>';
			}
		}
	?>
	<!-- navbar code -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container my-1">
			<a class="navbar-brand title" href="dashbord.php">FCloud Storage</a>
			<ul class="navbar-nav mr-auto">
	        	<li class="nav-item active">
	        		<a class="nav-link" href="dashbord.php">Mis Archivos <span class="sr-only">(current)</span></a>
	      		</li>
	      		<li class="nav-item">
	        		<a class="nav-link" href="upload.php">Subir un Archivo</a>
	      		</li>
	    	</ul>
	    	<div style="max-width: 30%" class="my-2 my-lg-0 input-group">
	    	    <span class="navbar-text mr-3">
	    	    	Bienvenido 
	    	    	<?php
	    	    		echo $firstName . ' ' . $lastName;
	    	  		?>
	    	  	</span>
      			<button class="btn btn-danger my-2 my-sm-0" type="submit" onclick="location.href='logout.php'">Logout</button>
      		</div>
    	</div>
	</nav>
	<!-- Rest of the web page -->
	<div class="container box">
		<div class="card my-4">
			<div class="card-header">
				Lista de Archivos
		  	</div>
		  	<div class="card-body">
				<table class="table">
				  <thead>
				    <tr>
				      <th scope="col">Nombre del Archivo</th>
				   	   <th scope="col">Tipo</th>
				    	  <th scope="col">Acciones</th>
				   		</tr>
				  	</thead>
					<tbody>
						<?php
							//Get file information
							$fileOwner=$_SESSION['username'];
							$query="SELECT fileName,fileExt FROM files WHERE fileOwner='$fileOwner'";
							$result=$conexionMySQL->query($query);
							if($result){
								//Loop thru all the results
								while($row=$result->fetch_assoc()){
									echo "<tr>" .PHP_EOL;
									echo "<td>".$row['fileName']."</td>" .PHP_EOL;
									echo "<td>".$row['fileExt']."</td>" .PHP_EOL;
									echo "<td>
										<button type='button' class='btn btn-danger' onclick='delFile(\"" . $row['fileName'] . "\")'>Eliminar</button>
										<button type='button' class='btn btn-primary' onclick='location.href=\"download.php?fileName=". $row['fileName'] ."\"'>Descargar</button>
									</td>" .PHP_EOL;
									echo "</tr>" .PHP_EOL;
								}
								$result->free();
							}
							else{
								echo "<script>swal('Error','Error interno del servidor','error')</script>";
							}
						?>
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>