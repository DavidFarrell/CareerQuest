<?php

require_once("./utility/requires.php");


$players = $GLOBALS['databaseUtility']->db_load_all_players();

foreach ($players as $index=>$player) {
	$avatar = new Avatar($player->playerId);
	
}


print_r($player);
print "\n\n";
print_r($avatar);



/* populate database for one player's activities for all weeks

$GLOBALS['databaseUtility']->pick_weekly_activities($player->playerId, 0);
$GLOBALS['databaseUtility']->pick_weekly_activities($player->playerId, 1);
$GLOBALS['databaseUtility']->pick_weekly_activities($player->playerId, 2);
$GLOBALS['databaseUtility']->pick_weekly_activities($player->playerId, 3);
//$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, 0);
//$dilemma = new Dilemma(2);
//$dilemmas = $GLOBALS['databaseUtility']->get_all_player_weekly_dilemmas(1);

// populate database for one player's dilemmas for all weeks

$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, 1);
$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, 2);
$GLOBALS['databaseUtility']->pick_weekly_dilemmas($player->playerId, 0);
//$activity = new Activity(2);

//print  "\n\n". $activity;
*/


/*

	// Query to show all High R High C people
	SELECT players.player_id, forename, surname, goal, score_wellbeing, score_awareness, score_ability, score_professionalism, score_work_ethic, weekly_time_units_base FROM `players`, avatars where players.player_id = avatars.player_id and relatedness_support = 2 and competence_support = 2 ORDER BY `players`.`relatedness_support`  DESC
	
	
	// Query to bring back all moves players made this week - High R High C
	SELECT players.player_id, forename, surname, goal, avatars.score_wellbeing as psw, avatars.score_awareness as psaw, avatars.score_ability as psab, avatars.score_professionalism as pspr, avatars.score_work_ethic as pswe, weekly_time_units_base,
player_weekly_activities.activity_id, activities.activity_name,
activities.score_wellness as act_well,activities.score_awareness as act_aw, activities.score_ability as act_abil, activities.score_professionalism as act_prof, activities.score_work_ethic as act_we, activities.activity_cost
FROM `players`, avatars, player_weekly_activities, activities

WHERE players.player_id = avatars.player_id and players.player_id = player_weekly_activities.player_id and player_weekly_activities.activity_id = activities.activity_id and player_weekly_activities.chosen = 1 and relatedness_support = 2 and competence_support = 2 ORDER BY `players`.`relatedness_support`  DESC

	// as above for low R
	SELECT players.player_id, forename, surname, goal, avatars.score_wellbeing as psw, avatars.score_awareness as psaw, avatars.score_ability as psab, avatars.score_professionalism as pspr, avatars.score_work_ethic as pswe, weekly_time_units_base,
player_weekly_activities.activity_id, activities.activity_name,
activities.score_wellness as act_well,activities.score_awareness as act_aw, activities.score_ability as act_abil, activities.score_professionalism as act_prof, activities.score_work_ethic as act_we, activities.activity_cost
FROM `players`, avatars, player_weekly_activities, activities

WHERE players.player_id = avatars.player_id and players.player_id = player_weekly_activities.player_id and player_weekly_activities.activity_id = activities.activity_id and player_weekly_activities.chosen = 1 and relatedness_support <2 and competence_support = 2 ORDER BY `players`.`surname`  asc

	As above for high R but any C
	

*/



?>