<?

require_once("./utility/requires.php");


$GLOBALS['databaseUtility']->db_log("Player_Submitted_Daily_option", "a = " . $avatar->avatarName, $player->playerId, $game->gameId);

mail("davidfarrell81@gmail.com", "CareerQuest - daily task submission by [".$player->playerId."][".$player->forename . " " . $player->surname."] - " . $_GET['id'], $avatar->avatarName);
	

header('Location: home.php?message=Daily%20task%20complete!');
?>