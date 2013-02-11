<?php

require_once("./utility/requires.php");

$player = new Player(1);

$avatar = new Avatar( $player->playerId );


$activity = new Activity(33);

$activities = $GLOBALS['databaseUtility']->db_load_activities();

/*$GLOBALS['databaseUtility']->pick_weekly_activities($player->playerId, 0);
$GLOBALS['databaseUtility']->pick_weekly_activities($player->playerId, 1);
$GLOBALS['databaseUtility']->pick_weekly_activities($player->playerId, 2);
$GLOBALS['databaseUtility']->pick_weekly_activities($player->playerId, 3);
*/
print "\n\n";

//$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, 0);
//$dilemma = new Dilemma(2);
//$dilemmas = $GLOBALS['databaseUtility']->get_all_player_weekly_dilemmas(1);

$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, 1);
$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, 2);
$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, 3);

print "\n\n\n\n\n\n";

//print_r($dilemmas);

?>