<?

require_once("./utility/requires.php");
//update_weekly_activities($avatar_id, $game_id, $game_turn, $activities_chosen) {
	
	
$GLOBALS['databaseUtility']->update_weekly_activities($player->playerId, $game->gameId, $game->gameTurn, $_POST);

header('Location: home.php?message=Activities%20updated.');
?>