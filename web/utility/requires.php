<?php
require_once("./utility/DatabaseUtility.php");
require_once("./utility/globals.php");
require_once("./utility/Player.php");
require_once("./utility/Avatar.php");
require_once("./utility/Activity.php");
require_once("./utility/DilemmaOption.php");
require_once("./utility/Dilemma.php");

require_once("./utility/login.php");


function tidyUp() {
	$databaseUtility->db_disconnect();	
}
?>