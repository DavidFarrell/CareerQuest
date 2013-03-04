<?php
require_once("./utility/DatabaseUtility.php");
require_once("./utility/globals.php");
require_once("./utility/Player.php");
require_once("./utility/Avatar.php");
require_once("./utility/Activity.php");
require_once("./utility/DilemmaOption.php");
require_once("./utility/Dilemma.php");

require_once("./utility/is_logged_in.php");


$player = new Player($_SESSION['player_id']);
$avatar = new Avatar($player->playerId);
$game = new ArrayObject();
$game->gameId = 0;
$game->gameTurn = 1;

function tidyUp() {
	
	$databaseUtility->db_disconnect();	
	/*print_r ($_SESSION);
	print "done";
	unset($_SESSION['player']);	
	unset($_SESSION['avatar']);	
	unset($_SESSION['game']);
	unset($_SESSION['sessionStarted']);
	session_destroy();
	
	print_r ($_SESSION);
	*/
}
?>