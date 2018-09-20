<?php
	include("config.php");
	//Check if the user cicked on the register button
	if(isset($_POST['register'])){
		//see if there is data inside
		if(($_POST['username']=='')||($_POST['firstName']=='')||($_POST['lastName']=='')||($_POST['password']=='')){
			echo '<script>location.href="register.php?status=empty"</script>';
		}
		//see if the first password matches the second password
		elseif($_POST['password'] == $_POST['secpassword']){
			$username=$_POST['username'];
			$firstName=$_POST['firstName'];
			$lastName=$_POST['lastName'];
			$password=md5($_POST['password']);
			//Check if the username already exists
			$query='SELECT firstName FROM users WHERE username="'.$_POST['username'].'"';
			$result = $conexionMySQL->query($query);
			//Check if we got a result
			if(!$result){
				echo '<script>location.href="register.php?status=unknown"</script>';
			}
			else{
				//Check if the array is empty, if it is empty, the user does not exist
				if($result->num_rows == 0){
					//Register the user details on the database
					$query="INSERT INTO users(username,role,firstName,lastName,passwd) VALUES ('$username','user','$firstName','$lastName','$password')";
					if($conexionMySQL->query($query)){
						echo '<script>location.href="register.php?status=success"</script>';
					}
					else{
						echo '<script>location.href="register.php?status=unknown"</script>';
					}
				}
				else{
					echo '<script>location.href="register.php?status=exists"</script>';
				}
				$result->free();
			}
		}
		else{
			echo '<script>location.href="register.php?status=noMatch"</script>';
		}
	}
	else{
		echo "Error";
	}
	$conexionMySQL->close();
?>