<?php
session_start();
require_once 'class.user.php';
//Connect to the DB
$mysqli = NEW MySQLi('localhost', 'dyno', 'Dinocloud.1995', 'dinocloud');

//Deactivate user account using userStatus
$deactivate = $mysqli->query("UPDATE users SET userStatus = N WHERE userID = 40");

	if($deactivate != TRUE) {
		echo "Your accoount could not be deactivated, please contact support team!";
	} else {
		echo "Account was deactivated successfully!";
		header("Refresh:3; url=index.php");
	}

//Close connection
$mysqli->close();

?>