<?php
	session_start();

	// Check whether the user is logged in
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: index.php');
	}
?>
<!-- Home page for a logged in user -->
<!DOCTYPE html>
<html>
<head>
	<title>Home | Pi In The Sky</title>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
	<div class="header">
		<h2>Home Page</h2>
	</div>
	<div class="content">

		<!-- Notification Message: Appears only the first time during any session -->
		<?php if (isset($_SESSION['msg'])) : ?>
			<div class="error success" >
				<h3>
					<?php
						echo $_SESSION['msg'];
						unset($_SESSION['msg']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- Logged in user information -->
		<?php  if (isset($_SESSION['username'])) : ?>
			<div class="content">
				<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			</div>
			<!-- Create new user if user is a superuser -->
			<?php  if ($_SESSION['superuser'] == 1) : ?>
				<div class="content">
					<a href="/register.php">Create new user</a>
				</div>
			<?php endif ?>
			<div class="content">
				<a href="/reset.php">Reset Password</a>
			</div>
			<div class="content">
				<a href="/userSites.php">Manage Your Websites</a>
			</div>
		<?php endif ?>

		<a href="/includes/restart_server.php">restart the server</a><br>
		<a href="storage.php">Upload and Download Files</a>
	</div>

	<div class="footer">
		<form action="includes/logout.php" method="post">
			<button type="submit" name="logout" class="btn btn-danger">Logout</button>
		</form>
	</div>

</body>
</html>
