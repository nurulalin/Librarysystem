<?php
		/* Database config */
$db_host		= "localhost";
$db_user		= "root";
$db_pass		= "";
$db_database	= "library"; 

/* End config */

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_database);


$dbh = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

date_default_timezone_set("Asia/Manila");
	
?>