<?php
	//start the session
	session_start();
	include("config.php");
	//See if the post comes from the login page
	if(isset($_POST['login'])){
		//Check if the user is already login
		if(isset($_SESSION["username"])){
			echo "<script>location.href='dashbord.php'</script>";
		}
		else{
			//Query Database for user password
			$query = ('SELECT passwd FROM users WHERE username="'.$_POST['username'].'" AND passwd="'.md5($_POST['password']).'"');
			$result = $conexionMySQL->query($query);
			//see if there is an error
			if(!$result){
				echo '<script>location.href="index.php?status=errorQuery"</script>';
			}
			else{
				//If number of rows is equal to 1, then the user and password is correct
				if($result->num_rows == 1){
					//Redirecto to dasbord and asign the username to the session
					$_SESSION['username']=$_POST['username'];
					echo "<script>location.href='dashbord.php'</script>";
				}
				else{
					echo '<script>location.href="index.php?status=errorLogin"</script>';
				}
				$result->free();
			}
		}
	}
	else{
		echo "Error";
	}
	$conexionMySQL->close();
?>