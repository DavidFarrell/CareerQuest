<?php
/*

$hostname = "mysql.davidlearnsgames.com";
$username = "dfarrell";
$password = "bOUncey179";
$database = "cqgame";

$db = mysql_connect($hostname,$username,$password);
		//mysql_connect($this->MYSQL_HOST, $this->MYSQL_USER, $this->MYSQL_PASSWORD);
		
		if (!$db) {
			die ('Could not connect to database host: ' . mysql_error());
		} else {
			$db_selected = mysql_select_db($database, $db);
			if (!$db_selected) {
				die ("Can't connect to database: " . mysql_error());
			} else {
				//$this->db_log("OpenConnection", "".$this->db);	
			}
		}
		
		print $db;
		
		$query = "UPDATE  `cqgame`.`avatars` SET  `avatar_name` =  'Unthank' WHERE  `avatars`.`avatar_id` =1;";
		mysql_query($query);*/
		
		
	print_r ($_SERVER);	
		
?>

