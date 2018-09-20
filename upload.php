<?php
	include("config.php");
	session_start();
	$allowedFiles = array('zip','rar','html','php','pdf','jpg','gif','png','jpeg');
?>
<!DOCTYPE html>
<html>
<head>
	<title>FCloud | Upload</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
	<script type="text/javascript" src="js/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/upload.css">
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
			}
			else{
				echo '<script>swal("Error!", "Error interno del servidor!", "error");</script>';
			}
			//see if the user whats to upload a file
			if(isset($_POST['upload'])){
				//Upload the file
				$fileOwner = $_SESSION["username"];
				$targetDir='files/'.$_SESSION['username'].'/';
				$fileName=basename($_FILES['fileUpload']['name']);
				$fileNameNoExt = pathinfo($fileName, PATHINFO_FILENAME);
				$fileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
				$fileID = uniqid();
				$saveAs=$targetDir.$fileID.'.'.$fileType;
				//While to change the file name in case it is equal to anotherone
				while(file_exists($saveAs)){
					$fileID = uniqid();
					$saveAs=$targetDir.$fileID.'.'.$fileType;
				}
				if(in_array($fileType,$allowedFiles)){
					//Check if the file already exists
					$query="SELECT fileID FROM files WHERE fileName='$fileNameNoExt' AND fileExt='$fileType' AND fileOwner='$fileOwner'";
					$result = $conexionMySQL->query($query);
					if($result){
						if($result->num_rows == 0){
							//Check if the directory for the user exists, if it does not create it
							if (!file_exists('files/'.$_SESSION['username'])) {
							    mkdir('files/'.$_SESSION['username'], 0777, true);
							}
							//try to move the file
							if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $saveAs)){
								//INsert the information of the file into the database
								$query="INSERT INTO files VALUES ('$fileID','$fileOwner','$fileNameNoExt','$fileType','$saveAs')";
								if($conexionMySQL->query($query)){
									echo "<script>swal('Ya esta en la nube!','Tu archivo fue subido con exito!','success')</script>";
								}
								else{
									echo "<script>swal('Error','Error interno del servidor','error')</script>";
								}
							}
							else{
								echo "<script>swal('Error','Error interno del servidor','error')</script>";
							}
						}
						else{
							echo "<script>swal('Error','El archivo ya existe','error')</script>";
						}
						$result->free();
					}
					else{
						echo "<script>swal('Error','Error interno del servidor','error')</script>";
					}
				}
				else{
					echo "<script>swal('Error','Solo puedes subir este tipo de archivos (";
					$arraySize = count($allowedFiles);
					for($i=0;$i<$arraySize;$i++){
						echo $allowedFiles[$i];
						if($i < $arraySize -1){
							echo ' , ';
						}
					}
					echo ")','error')</script>";
				}
			}
		}
		$conexionMySQL->close();
	?>
	<!-- navbar code -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container my-1">
			<a class="navbar-brand title" href="dashbord.php">FCloud Storage</a>
			<ul class="navbar-nav mr-auto">
	        	<li class="nav-item">
	        		<a class="nav-link" href="dashbord.php">Mis Archivos</a>
	      		</li>
	      		<li class="nav-item active">
	        		<a class="nav-link" href="upload.php">Subir un Archivo <span class="sr-only">(current)</span></a>
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
	<!-- Rest of the page -->
	<div class="container box">
		<div class="card my-4">
			<div class="card-header">
				Subir un archivo
		  	</div>
		  	<div class="card-body">
			  	<form action="upload.php" method="post" enctype="multipart/form-data">
					<div class="input-group">
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="fileUpload" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
							<label class="custom-file-label" for="inputGroupFile01">Escoge un archivo</label>
						</div>
					</div>
					<div class="text">
						<small>
							Tipos de archivos aceptados (
							<?php
								$arraySize = count($allowedFiles);
								for($i=0;$i<$arraySize;$i++){
									echo $allowedFiles[$i];
									if($i < $arraySize -1){
										echo ' , ';
									}
								}	
							?>
							)
						</small>
					</div>
	  				<div class="input-group">
	  					<button type="submit" name="upload"  class="btn btn-primary my-2 boton">Subir Archivo!</button>
	  				</div>
				</form>
		  	</div>
		</div>
	</div>

</body>
</html>