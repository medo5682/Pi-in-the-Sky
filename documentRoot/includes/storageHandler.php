<?php
include('requireLogin.php');
include('dbconnect.php');
if(isset($_POST['storage-submit'])){
	session_start();
	$numErrors = 0;
	$username = $_SESSION['username'];
	$privacy = $_POST['privacy'];

	$storageDir = '/var/data/';

	if(!isset($privacy)){
		die("You must make your file public or private");
	}
	if($privacy == 'public'){
		$is_private=0;
		$storageDir = $storageDir.'public/';
	}else{
		//NEED TO MAKE USER DIR ON USER REGISTRATION
		$is_private=1;
		$storageDir = $storageDir.$username.'/';
	}
	//If uploading a file:
	if(!($_FILES['uploadFile']['name'] == "")){
		$tmpName = $_FILES['uploadFile']['tmp_name'];//get file tmp name
		$name = $_FILES['uploadFile']['name'];//get file name
		$type = $_FILES['uploadFile']['type'];//get file type
		$size = $_FILES['uploadFile']['size'];//get file size


		//check file specifics
		//move to private or public storage
		if(move_uploaded_file($tmpName, $storageDir.$name)){
			$date = date("Y-m-d h:i:s");
			$sql="INSERT INTO storage (name, user_name, prefix, is_private, stored_on) VALUES ('$name','$username','$storageDir','$is_private','$date')";
			mysqli_query($conn, $sql);
		}else{
			die($name." file upload unsuccessful. Please go back and try again");
		}
	}
	// Return to storage page
	header('location: /storage.php');
}
?>
