<?php
	//Stat MySQL
	$conexionMySQL =  new mysqli('127.0.0.1','root','dgMzwh5ABnxdI64k','fileuploader');
	//Condition if there is an MySQL error
	if($conexionMySQL->connect_error){
		echo "<center><h3>Error de conexion con servidor MySQL!</h3>" . PHP_EOL;
		echo "<h3>Error de depuracion: " . $conexionMySQL->connect_errno . PHP_EOL . "</h3></center>";
		die();
	}
?>