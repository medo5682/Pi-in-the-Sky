<?php
session_start();
include('requireLogin.php');
include('dbconnect.php');


$siteName = $_POST['siteID'];

unlink('/etc/apache2/sites-enabled/'.$siteName.'.conf');
$sqlquery = 'UPDATE websites SET is_enabled = 0 WHERE website_name="'.$siteName.'"';
mysqli_query($conn, $sqlquery);
exec('sudo apache2ctl -k graceful');
header("location: ../userSites.php");
?>
