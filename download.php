<?php
	session_start();
	include("config.php");
	//se if the user is login
	if(isset($_SESSION['username'])){
		//get the file location
		$requestedFile=$_GET['fileName'];
		$fileOwner=$_SESSION['username'];
		$query="SELECT fileLocation,fileExt FROM files WHERE fileName='$requestedFile' AND fileOwner='$fileOwner'";
		$result=$conexionMySQL->query($query);
		//see if we got something
		if($result){
		    //see if we got a file
		    if($result->num_rows==1){
		    	$row=$result->fetch_assoc();
		    	//get the location
		    	$fileLocation=$row['fileLocation'];
		    	$fileExt=$row['fileExt'];
			    // Process download
			    if(file_exists($fileLocation)) {
			        header('Content-Description: File Transfer');
			        header('Content-Type: application/octet-stream');
			        header('Content-Disposition: attachment; filename="'.$fileOwner."_".$requestedFile.".".$fileExt.'"');
			        header('Expires: 0');
			        header('Cache-Control: must-revalidate');
			        header('Pragma: public');
			        header('Content-Length: ' . filesize($fileLocation));
			        flush(); // Flush system output buffer
			        readfile($fileLocation);
			        exit;
			    }
			    else{
			    	echo "<script>location.href='dashbord.php?status=fileNo'</script>";
			    }
		    }
		    else{
		    	echo "<script>location.href='dashbord.php?status=fileNoDB'</script>";
		    }
		    $result->free();
		}
		else{
			echo "<script>location.href='dashbord.php?status=error'</script>";
		}
	}
	else{
		echo "<script>location.href='index.php'</script>";
	}
	//close MySQL
	$conexionMySQL->close();
?>