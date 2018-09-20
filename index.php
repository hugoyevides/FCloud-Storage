<!-- Start the sesion -->
<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>FCloud Storage</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="css/all.css">
	<script type="text/javascript" src="js/sweetalert.min.js"></script>
</head>
<body>
	<?php
		if(isset($_SESSION["username"])){
			echo "<script>location.href='dashbord.php'</script>";
		}
	?>
	<div id="bar">
		<p id="text">FCloud Storage</p>		
	</div>
	<div class="container" id="box">
		<div class="card">
			<div class="card-header">
				Login Form
		  	</div>
		  	<div class="card-body">
	  			<?php
					if(isset($_GET['status'])){
						//Check if there is an error
						if($_GET['status']=="errorLogin"){
							echo '<div class="alert alert-danger" role="alert">Usuario o Contrasena Incorrectos!</div>';
						}
						else{
							echo '<div class="alert alert-danger" role="alert">Error interno del servidor!</div>';
						}
					}
					else{
						echo '<div class="alert alert-primary" role="alert">Ingresa tus datos para entrar a tus archivos!</div>';
					}
	  			?>
				<form action="login.php" method="post">
  					<div class="input-group"> 	
    					<div class="input-group-prepend">
      						<div class="input-group-text"><i class="fas fa-user"></i></div>
    					</div>
   						<label class="sr-only" for="usernemForm">Usuario</label>
    					<input type="text" class="form-control" id="usernameForm" placeholder="Usuario" name="username">
  					</div>
   					<div class="input-group my-2">
    					<div class="input-group-prepend">
      						<div class="input-group-text"><i class="fas fa-key"></i></div>
    					</div>
   						<label class="sr-only" for="passwordForm">Clave de Acceso</label>
    					<input type="password" class="form-control" id="passwordForm" placeholder="Clave de Acceso" name="password">
  					</div>
  					<div class="text-center">
   						<button type="button" class="btn btn-secondary" onclick="location.href='register.php'">Registrarse</button>
  						<button type="submit" name="login"  class="btn btn-primary my-2">Acceder al Sistema</button>
  					</div>
				</form>
		  	</div>
		</div>
	</div>
</body>
</html>