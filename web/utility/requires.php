<?php


require_once("./utility/DatabaseUtility.php");
require_once("./utility/Player.php");

$databaseUtility = new DatabaseUtility();



function tidyUp() {
	$databaseUtility->db_disconnect();	
}
?>