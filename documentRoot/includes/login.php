<?php
session_start();

$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "PiInTheSky";
$dbName = "piServer";
$_SESSION['success'] = "";

$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$message = "The message is no message";

if (isset($_POST['login'])) {

	$uid = mysqli_real_escape_string($conn, $_POST['username']);
	$pwd = mysqli_real_escape_string($conn, $_POST['password']);

	// Error handlers
	// Check if inputs are empty
	if(empty($uid) || empty($pwd)) {
		$message = "Unsuccessful";
		header("Location: index.php?login=empty");
		exit();
	}
	else {
		//$pwd = md5($pwd);
		$sql = "SELECT * FROM users WHERE user_uid='$uid' AND psswd='$pwd'";
		$result = mysql_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);

		// If username doesn't exist
		if ($resultCheck < 1) {
			$message = "Unsuccessful";
			header("Location: index.php?login=error");
			exit();
		}
		else {
			$message = "Successfully authenticated";
			$_SESSION['username'] = $uid;
			$_SESSION['success'] = "You are now logged in";
			header('Location: home.php');
		}
	}
}
// else {
// 	header("Location: ../index.php?login=error");
// 	exit();
// }

?>
