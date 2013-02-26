<?php

require_once("./utility/requires.php");

$player = new Player(77);
$avatar = new Avatar(77);

print_r($player);
print "\n\n";
print_r($avatar);


print "\n\n";
print "\n\n";



/*  
// populate database for one player's activities for all weeks

$GLOBALS['databaseUtility']->pick_weekly_activities($player->playerId, 0);
$GLOBALS['databaseUtility']->pick_weekly_activities($player->playerId, 1);
$GLOBALS['databaseUtility']->pick_weekly_activities($player->playerId, 2);
$GLOBALS['databaseUtility']->pick_weekly_activities($player->playerId, 3);
*/
//$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, 0);
//$dilemma = new Dilemma(2);
//$dilemmas = $GLOBALS['databaseUtility']->get_all_player_weekly_dilemmas(1);

/*
// populate database for one player's dilemmas for all weeks

$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, 1);
$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, 2);
$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, 0);
*/
//$activity = new Activity(2);

//print  "\n\n". $activity;

?>