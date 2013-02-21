<?php
session_start();
if(!isset($_SESSION['sessionStarted'])) {
	header('Location: login.php');
}


?>