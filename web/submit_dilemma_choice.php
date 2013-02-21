<?

require_once("./utility/requires.php");

	
$GLOBALS['databaseUtility']->update_weekly_dilemma($player->playerId, $game->gameId, $game->gameTurn, $_POST);

header('Location: answer_dilemma.php');
?>