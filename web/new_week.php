<?php

require_once("./utility/requires.php");


$players = $GLOBALS['databaseUtility']->db_load_all_players();

foreach ($players as $index=>$player) {
	if ( true ) {   /*     $player->playerId == 1) {*/
		$avatar = new Avatar($player->playerId);
		
		// Pick new tasks and dilemmas
		
		$GLOBALS['databaseUtility']->pick_weekly_activities($player->playerId, $game->gameTurn);
		$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, $game->gameTurn);
		
		// Update Scores   
	/*		*/					
		$scores = $GLOBALS['databaseUtility']->db_get_cumulative_scores($player->playerId, $game->gameId, ($game->gameTurn-1));
		
		$changeInScores=null;
		foreach ($scores as $mechanicType=>$setOfScores) {
			foreach($setOfScores as $scoreType=>$scoreValue) {
				$changeInScores[$scoreType] += $scoreValue;	
			}
		}
		
		$GLOBALS['databaseUtility']->db_update_avatar_scores($player->playerId, $changeInScores);
	}
}




?>