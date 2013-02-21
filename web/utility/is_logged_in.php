<?php
session_start();
if(!isset($_SESSION['sessionStarted'])) {
	header('Location: login.php');
} else {
	/*print "Logged in? " . 	$_SESSION['sessionStarted'];
	print_r ($_SESSION);*/
}


?>