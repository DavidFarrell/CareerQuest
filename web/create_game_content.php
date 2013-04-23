<?php

require_once("./utility/requires.php");

/*
	step 1: Import CSV into player table
*/

/* step 2 - hardcode ids below and create avatars

for ( $id = 44; $id <75; $id++) {
	print "before - id is " . $id;
	$player = new Player($id);
	
	print "after 1 - id is " . $id;
	
	print "after 2 - id is " . $player->playerId;
	$GLOBALS['databaseUtility']->create_avatar($player->playerId);
} */


/* step 3 - make activities for people for this week 

for ( $id = 44; $id <75; $id++) {
	$player = new Player($id);
	$GLOBALS['databaseUtility']->pick_weekly_activities($player->playerId, 0);
}
*/

$player = new Player(84);
$avatar = new Avatar(84);
$GLOBALS['databaseUtility']->pick_weekly_activities($player->playerId, $game->gameTurn);


/* step 4 - make dilemmas for people for this week 

for ( $id = 44; $id <75; $id++) {
	$player = new Player($id);
	$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, 0);
}
*/

$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, $game->gameTurn);

  
//$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, 0);
//$dilemma = new Dilemma(2);
//$dilemmas = $GLOBALS['databaseUtility']->get_all_player_weekly_dilemmas(1);

/*
// populate database for one player's dilemmas for all weeks
$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, 1);
$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, 2);
$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, 3);
*/

//$activity = new Activity(2);
//print  "\n\n". $activity;

?>