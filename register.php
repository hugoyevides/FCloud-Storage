<!DOCTYPE html>
<html>
<head>
	<title>FCloud | Register</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/all.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet"> 
	<script type="text/javascript" src="js/sweetalert.min.js"></script>
</head>
<body>
	<div id="bar">
		<p id="text" onclick="location.href='index.php'">FCloud Storage</a></p>		
	</div>
	<div class="container" id="box">
		<div class="card">
			<div class="card-header">
				Register Form
		  	</div>
		  	<div class="card-body">
		  		<?php
		  			if(isset($_GET['status'])){
		  				//check what type of error is
		  				if($_GET['status']=="noMatch"){
		  					echo '<div class="alert alert-danger" role="alert">Las contrasenas son diferentes!</div>';
		  				}
		  				elseif($_GET['status']=="exists"){
		  					echo '<div class="alert alert-danger" role="alert">El usuario ya existe!</div>';
		  				}
		  				elseif($_GET['status']=="empty"){
		  					echo '<div class="alert alert-danger" role="alert">Tienes que ingresar datos!</div>';
		  				}
		  				elseif($_GET['status']=="success"){
		  					echo '<div class="alert alert-success" role="alert">Usuario registrado con exito!</div>';
		  				}
		  				else{
		  					echo '<div class="alert alert-danger" role="alert">Error interno del servidor!</div>';
		  				}
		  			}
		  			else{
		  				echo '<div class="alert alert-primary" role="alert">Ingresa tus datos para registrar tu cuenta!</div>';
		  			}
		  		?>
				<form action="registerUser.php" method="post">
  					<div class="input-group"> 	
    					<div class="input-group-prepend">
      						<div class="input-group-text"><i class="fas fa-user"></i></div>
    					</div>
   						<label class="sr-only" for="usernemForm">Usuario</label>
    					<input type="text" class="form-control" id="usernameForm" placeholder="Usuario" name="username">
  					</div>
   					<div class="input-group my-2"> 	
    					<div class="input-group-prepend">
      						<div class="input-group-text"><i class="fas fa-user"></i></div>
    					</div>
   						<label class="sr-only" for="firstNameForm">Nombre</label>
    					<input type="text" class="form-control" id="firstNameForm" placeholder="Nombre" name="firstName">
  					</div>
   					<div class="input-group my-2"> 	
    					<div class="input-group-prepend">
      						<div class="input-group-text"><i class="fas fa-user"></i></div>
    					</div>
   						<label class="sr-only" for="lastNameForm">Apellido</label>
    					<input type="text" class="form-control" id="lastNameForm" placeholder="Apellido" name="lastName">
  					</div>
   					<div class="input-group my-2">
    					<div class="input-group-prepend">
      						<div class="input-group-text"><i class="fas fa-key"></i></div>
    					</div>
   						<label class="sr-only" for="passwordForm">Clave de Acceso</label>
    					<input type="password" class="form-control" id="passwordForm" placeholder="Clave de Acceso" name="password">
  					</div>
    					<div class="input-group my-2">
    					<div class="input-group-prepend">
      						<div class="input-group-text"><i class="fas fa-key"></i></div>
    					</div>
   						<label class="sr-only" for="secpasswordForm">Repetir Clave</label>
    					<input type="password" class="form-control" id="secpasswordForm" placeholder="Repetir Clave" name="secpassword">
  					</div>

  					<div class="text-center">
    					<button type="button" class="btn btn-secondary my-2" onclick="location.href='index.php'">Ir al Login</button>
  						<button type="submit" name="register" class="btn btn-primary my-2">Registrar Cuenta</button>
  					</div>
				</form>
		  	</div>
		</div>
	</div>
</body>
</html>