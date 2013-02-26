<?php

	$hostname = "mysql.davidlearnsgames.com";
	$username= "dfarrell";
	$password = "bOUncey179";
	$database = "bodforum";

$link = mysql_connect($hostname,$username,$password);
mysql_select_db($database) or die("Unable to select database");
?>