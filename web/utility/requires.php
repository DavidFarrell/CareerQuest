<?php


require_once("./utility/DatabaseUtility.php");
require_once("./utility/Player.php");
require_once("./utility/Avatar.php");
require_once("./utility/Activity.php");

// globals
$GLOBALS['debug'] = true;
$GLOBALS['databaseUtility'] = new DatabaseUtility();

$GLOBALS['activity_type'][0] = "Wellbeing";
$GLOBALS['activity_type'][1] = "Awareness";
$GLOBALS['activity_type'][2] = "Ability";
$GLOBALS['activity_type'][3] = "Professionalism";
$GLOBALS['activity_type'][4] = "Work Ethic";




function tidyUp() {
	$databaseUtility->db_disconnect();	
}
?>