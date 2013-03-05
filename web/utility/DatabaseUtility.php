<?php

require_once ("./utility/database_config.php");
class DatabaseUtility {
	public $db;

	function __construct() {
		$this->db_connect();
		
	}
	
	function __toString() {
		return "Connection status: " . $this->db;	
	}

	function db_connect() {
	
	$hostname = $GLOBALS['MYSQL_HOST'];
	$port = $GLOBALS['MYSQL_PORT'];
	$username= $GLOBALS['MYSQL_USER'];
	$password = $GLOBALS['MYSQL_PASSWORD'];
	$database = $GLOBALS['MYSQL_DATABASE'];


//$link = mysql_connect($hostname,$username,$password);
//mysql_select_db($database) or die("Unable to select database");
		$this->db = mysql_connect($hostname,$username,$password);
		//mysql_connect($this->MYSQL_HOST, $this->MYSQL_USER, $this->MYSQL_PASSWORD);
		
		if (!$this->db) {
			die ('Could not connect to database host: ' . mysql_error());
		} else {
			$db_selected = mysql_select_db($database, $this->db);
			if (!$db_selected) {
				die ("Can't connect to database: " . mysql_error());
			} else {
				//$this->db_log("OpenConnection", "".$this->db);	
			}
		}
	}
	
	function db_disconnect(){
		$this->db_log("CloseConnection", "".$this->db);
		mysql_close($this->db);	
	}
	
	function db_log($type, $params, $player_id=null, $game_id=null) {
		if (!$this->db) {
			db_connect();
		}
		
		$sql="INSERT INTO game_log (event_type, event_params, player_id, game_id, ip, agent)
		VALUES
		('".$type."','".$params."', '".$player_id."', '".$game_id."', '".$_SERVER['REMOTE_ADDR']."', '".$this->db_escape($_SERVER['HTTP_USER_AGENT'])."')";
		
		if (!mysql_query($sql,$this->db)) {
			die('Error: ' . mysql_error() . '<br>' . $sql . "<br>" . $this->db);
		}
	}
	
	// returns array filled with player objects
	function db_load_all_players() {
		if(!$this->db) {
			db_connect();
		}
		
		$sql = "SELECT * FROM players ORDER BY player_id asc";
		
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)) {
		  $players[] = new Player($row['player_id']);
		} 
		
		return $players;
	}
	
	function db_load_player($id) {
		if(!$this->db) {
			db_connect();
		}
//		print "\n id is: ".$id;
		//$this->db_log("LoadPlayer" , $id);
		$id = $this->db_escape($id) ;
		
		$sql = "SELECT * FROM players where player_id = " . $id;
		
		$result = mysql_query($sql);
	
		if($row = mysql_fetch_array($result)) {
		  return $row;
		} else die ("Could not retrieve person: " . mysql_error() . "<br>" . $sql);
	}
	
	function db_check_login($login_details) {
		if(!$this->db) {
			db_connect();
		}
		$email = $this->db_escape($login_details['email']) ;
		$password = $this->db_escape($login_details['password']) ;
		
		$sql = "SELECT * FROM players where email = '" . $email ."' and password = '".$password."'";
		
		$result = mysql_query($sql);
	
		if($row = mysql_fetch_array($result)) {
			$this->db_log("Player_Login", "p=".$email);		
			return $row;
		} else return null;
	}
	
	
	
	function create_avatar($player_id) {
		$player = new Player($player_id);
		
		$sql = "INSERT INTO  `avatars` (
				`player_id` ,
				`is_current_avatar` ,
				`avatar_image_url` ,
				`avatar_name` ,
				`avatar_gender` ,
				`player_choice` ,
				`score_wellbeing` ,
				`score_awareness` ,
				`score_ability` ,
				`score_professionalism` ,
				`score_work_ethic` ,
				`weekly_time_units_current` ,
				`weekly_time_units_base` ,
				`weekly_time_units_buff` ,
				`daily_time_units_current` ,
				`daily_time_units_base` ,
				`daily_time_units_buff` ,
				`last_modified`
				)
				VALUES (
				  '".$player_id."',  '1',  'dfavatar.png',  '".$player->forename . $player->surname ."',  '0',  '1',  ".
				  "'5',  '3',  '3',  '3',  '3',  '4',  '4',  '0',  '1',  '1',  '0', 
				CURRENT_TIMESTAMP
				);";
				
		$result = mysql_query($sql);
		if (!$result) {
			die(mysql_error());	
		}
	}
	
	function db_load_current_avatar($player_id) {
		if(!$this->db) {
			db_connect();
		}
		$player_id = $this->db_escape($player_id) ;
		
		$sql = "SELECT * FROM avatars where is_current_avatar = 1 and player_id = " . $player_id;
		
		$result = mysql_query($sql);
	
		if($row = mysql_fetch_array($result)) {
		  return $row;
		} else die ("Could not retrieve current avatar for player id $player_id: " . mysql_error() . "<br>\n" . $sql);
	}
	
	function db_escape($var) {
		$var = mysql_real_escape_string($var);
		return $var;	
	}
	
	// returns an array populated by Activity objects
	function db_load_activities() {
		if(!$this->db) {
			db_connect();
		}
		
		$sql = "SELECT * FROM activities order by activity_id asc";
		
		$result = mysql_query($sql);
	
		if($row = mysql_fetch_array($result)) {
			$current_activity = new Activity(null, $row);
			$activities[] =  $current_activity;
			while ($row = mysql_fetch_array($result)) {
				$current_activity = new Activity(null, $row);
				$activities[] =  $current_activity;
			}
			return $activities;
		} else die ("Could not retrieve activity for activity_id $activity_id: " . mysql_error() . "<br>\n" . $sql);
	}
	
	function db_load_activity($activity_id) {
		if(!$this->db) {
			db_connect();
		}
		$activity_id = $this->db_escape($activity_id) ;
		
		$sql = "SELECT * FROM activities where activity_id = " . $activity_id;
		
		$result = mysql_query($sql);
	
		if($row = mysql_fetch_array($result)) {
		  return $row;
		} else die ("Could not retrieve activity for activity_id $activity_id: " . mysql_error() . "<br>\n" . $sql);
	}
	
	/* this should account for game id but I forgot to do so! */
	function get_player_weekly_activities($player_id, $game_turn) {
		if(!$this->db) {
			db_connect();
		}
		$player_id = $this->db_escape($player_id) ;
		$game_turn = $this->db_escape($game_turn) ;
		
		$activities = null;
		$sql = "SELECT * FROM player_weekly_activities where player_id = ". $player_id ." and game_turn = ". $game_turn . " order by activity_id asc";
		
		$result = mysql_query($sql);
	
		if($row = mysql_fetch_array($result)) {
			$activity_id = $row['activity_id'];
			$current_activity = new Activity($activity_id);
			$current_activity->activityChosen = $row['chosen'];
			$activities[] =  $current_activity;
			while ($row = mysql_fetch_array($result) ) {
				$activity_id = $row['activity_id'];
				$current_activity = new Activity($activity_id);
				$current_activity->activityChosen = $row['chosen'];
				$activities[] = $current_activity;
			}
			return $activities;
		} else {
			if ($GLOBALS['debug']) {
				print "Could not retrieve weekly activities for player $player_id in week $game_turn: " . mysql_error() . "<br>\n" . $sql;
			}
			return null;
		}
	}
	
	function get_all_player_weekly_activities($player_id) {
		if(!$this->db) {
			db_connect();
		}
		$player_id = $this->db_escape($player_id) ;
		$activities = null;
		$sql = "SELECT * FROM player_weekly_activities where player_id = ". $player_id ."  order by game_turn asc, activity_id  asc";
		
		$result = mysql_query($sql);
	
		if($row = mysql_fetch_array($result)) {
			$activity_id = $row['activity_id'];
			$current_activity = new Activity($activity_id);
			$current_activity->activityChosen = $row['chosen'];
			$activities[] =  $current_activity;
			while ($row = mysql_fetch_array($result) ) {
				$activity_id = $row['activity_id'];
				$current_activity = new Activity($activity_id);
				$current_activity->activityChosen = $row['chosen'];
				$activities[] = $current_activity;
			}
			return $activities;
		} else {
			if ($GLOBALS['debug']) {
				print "Could not retrieve weekly activities for player $player_id: " . mysql_error() . "<br>\n" . $sql;
			}
			return null;
		}
	}
	
	
	/*	this is prone to error if there are very few dilemmas that have not been picked for this person
	 *  i.e. if the available set of numbers to randomly pick from is very small
	 *	so when having more time, I should come back and put a proper algorithm in to methodically check for available numbers
	 */
	 /* MISTAKE - I SAY GAME ID HERE WHEN I AM REFRRING TO GAME TURM */
	function pick_weekly_activities($player_id, $game_id) {
		$activities = $this->db_load_activities();
		$previous_activities = $this->get_all_player_weekly_activities($player_id);
		$avatar = new Avatar($player_id);
		// need to chagne this should be weekly options current
		$time_units = 1;
		$time_units = $avatar->weeklyTimeUnitsCurrent + $avatar->weeklyTimeUnitsBuff;
		$random_activity_index = null;
		$random_activity = null;
		// chosen items represents the items selected in this function - it contains activity ids, not Activities.
		$chosen_items = null;
		
		while ($time_units >= 0) {
				
			if ( $random_activity_index == null || $has_been_picked ) {
				$random_activity_index = rand(0, (sizeof($activities)-1));
				$random_activity = $activities[$random_activity_index];
				$has_been_picked = false;
			}
			// first check if we picked it today
			if ( $chosen_items != null ) {
				foreach ($chosen_items as $key=>$currentActivity) {
					if ($currentActivity == $random_activity->activityId) {
						$has_been_picked = true;
						//print " Rejected 1: item is same[".$random_activity->activityId."]\n";
					}	
				}
			}
	
			// now check if picked in the past 
			if (!$has_been_picked && $previous_activities != null) { 			
				foreach($previous_activities as $key=>$currentActivity) {
					if ($currentActivity->activityId == $random_activity->activityId) {
						$has_been_picked = true;
					//	print " Rejected 2: item is same[".$random_activity->activityId."]\n";
					}
				}
			}
			
			if (!$has_been_picked) {
				
				//print "chose to add: ".$random_activity->activityId."]\n\n";
				$chosen_items[] = $random_activity->activityId;
				$random_activity_index = null;
				$random_activity = null;
				$time_units--;	
			}
		}
		
		// now actually insert into DB
		foreach($chosen_items as $key=>$activityId) {
			if(!$this->db) {
				db_connect();
			}
			$player_id = $this->db_escape($player_id) ;
			$game_id = $this->db_escape($game_id);
			$activityId = $this->db_escape($activityId);
			
			$sql = "INSERT INTO player_weekly_activities (player_id, activity_id, game_turn) VALUES (".$player_id.",".$activityId.",".$game_id.")";
			
			
			$result = mysql_query($sql);
		
			if(!$result) {
				if ($GLOBALS['debug']) {
					print "Failed to insert into player_weekly_activities.\n$sql\n". mysql_error();
				}
			}
		}
	}
	
	/*	
	 *	This updates the weekly activities with the player's choices.
	 */
	function update_weekly_activities($player_id, $game_id, $game_turn, $activities_chosen) {
		if(!$this->db) {
			db_connect();
		}
		
		$player_id = $this->db_escape($player_id);
		$game_id = $this->db_escape($game_id);
		$game_turn = $this->db_escape($game_turn);
		
		$activities = $this->get_player_weekly_activities($player_id, $game_turn);
		
		foreach($activities as $key=>$currentActivity) {
			if ( $activities_chosen[$currentActivity->activityId] == $currentActivity->activityId ) {
				$sql =  "UPDATE  `player_weekly_activities` SET  `chosen` =  '1' WHERE ".
						"`player_weekly_activities`.`player_id` = ".$player_id."  AND ".
						" `player_weekly_activities`.`activity_id` =".$currentActivity->activityId;
				
				
				$result = mysql_query($sql);
			
				if(!$result) {
					if ($GLOBALS['debug']) {
						die ("Failed to insert into player_weekly_activities.\n$sql\n". mysql_error() );;
					}
				} else {
					$this->db_log("Player_selected_weekly_activity","p = " . $player_id . "|gi = ".$game_id."|gt = ".$game_turn."|ai = ". $currentActivity->activityId, $player_id, $game_id); 	
				}
			} else {
				$sql =  "UPDATE  `player_weekly_activities` SET  `chosen` =  '0' WHERE ".
						"`player_weekly_activities`.`player_id` = ".$player_id."  AND ".
						" `player_weekly_activities`.`activity_id` =".$currentActivity->activityId;
				
				
				$result = mysql_query($sql);
			
				if(!$result) {
					if ($GLOBALS['debug']) {
						die("Failed to insert into player_weekly_activities.\n$sql\n". mysql_error());
					}
				} else {
					$this->db_log("Player_deselected_weekly_activity","p = " . $player_id . "|gi = ".$game_id."|gt = ".$game_turn."|ai = ". $currentActivity->activityId, $player_id, $game_id); 	
				}
			}
		}
	}
	
	// returns an array populated by Dilemma objects
	function db_load_dilemmas() {
		if(!$this->db) {
			db_connect();
		}
		
		$sql = "SELECT dilemma_id FROM dilemmas order by dilemma_id asc";
		
		$result = mysql_query($sql);
		$dilemmas= null;
			
		while($row = mysql_fetch_array($result)) {
			$current_dilemma = new Dilemma($row['dilemma_id']);
			$dilemmas[] = $current_dilemma;
			
		} 
		return $dilemmas;
	}
	
	function db_load_dilemma($dilemma_id) {
		if(!$this->db) {
			db_connect();
		}
		$dilemma_id = $this->db_escape($dilemma_id) ;
		
		$sql = "SELECT * FROM dilemmas where dilemma_id = " . $dilemma_id;
		
		$result = mysql_query($sql);
	
		if($row = mysql_fetch_array($result)) {
		  return $row;
		} else die ("Could not retrieve dilemma for dilemma_id $dilemma_id: " . mysql_error() . "<br>\n" . $sql);
	}
	
	function db_load_dilemma_options($dilemma_id) {
		if(!$this->db) {
			db_connect();
		}
		$dilemma_id = $this->db_escape($dilemma_id) ;
		
		$sql = "SELECT * FROM dilemma_options where dilemma_id = " . $dilemma_id . " order by dilemma_option_id asc";
		
		$result = mysql_query($sql);
		$options = null;
		
		if($row = mysql_fetch_array($result)) {
		  $options[] = $row;
		  while ($row = mysql_fetch_array($result)) {
			 $options[] = $row; 
		  }
		  return $options;
		} else die ("Could not retrieve options for dilemma_id $dilemma_id: " . mysql_error() . "<br>\n" . $sql);
	}
	
	
	/* Dilemma - singular*/
	function get_player_weekly_dilemmas($player_id, $game_id,$game_turn) {
		if(!$this->db) {
			db_connect();
		}
		$player_id = $this->db_escape($player_id) ;
		$game_turn = $this->db_escape($game_turn) ;
		$game_id = $this->db_escape($game_id) ;
		
		$sql = "SELECT * FROM player_weekly_dilemmas where player_id = ". $player_id ." and game_turn = ". $game_turn . " order by dilemma_id asc";
		
		$result = mysql_query($sql);
	
		if($row = mysql_fetch_array($result)) {
			$dilemma_id = $row['dilemma_id'];
			$dilemma = new Dilemma($dilemma_id);
			// update the dilemma with player specific information
			$dilemma->dilemmaOptionChosen = $row['dilemma_option_chosen'];
			$dilemma->playerOptionChosen = $row['player_option_chosen'];
			$dilemma->playerOptionId = $row['player_option_id'];
			return $dilemma;
		} else {
			if ($GLOBALS['debug']) {
				print "Could not retrieve dilemma for player $player_id in week $game_turn: " . mysql_error() . "<br>\n" . $sql;
			}
			return null;
		}
	}

	function get_player_submitted_dilemma_description($player_id, $game_id,$game_turn, $dilemma_id) {
		if(!$this->db) {
			db_connect();
		}
		$player_id = $this->db_escape($player_id) ;
		$game_turn = $this->db_escape($game_turn) ;
		$game_id = $this->db_escape($game_id) ;
		$dilemma_id = $this->db_escape($dilemma_id);
		
		$sql = "SELECT * FROM player_submitted_dilemma_solutions where player_id = ". $player_id .
				" and dilemma_id = ". $dilemma_id . " order by dilemma_id asc";
		
		$result = mysql_query($sql);
	
		if($row = mysql_fetch_array($result)) {
			$description = $row['solution_description'];
			return $description;
		} else {
			if ($GLOBALS['debug']) {
				print "Could not retrieve player dilemma submitted description: " . mysql_error() . "<br>\n" . $sql;
			}
			return null;
		}
	}
	
	function get_all_player_weekly_dilemmas($player_id) {
		if(!$this->db) {
			db_connect();
		}
		$player_id = $this->db_escape($player_id) ;
		$dilemmas = null;
		$sql = "SELECT * FROM player_weekly_dilemmas where player_id = ". $player_id ."  order by game_turn asc, dilemma_id asc";
		
		$result = mysql_query($sql);
	
		if($row = mysql_fetch_array($result)) {
			$dilemma_id = $row['dilemma_id'];
			$current_dilema = new Dilemma($dilemma_id);
			$dilemmas[] =  $current_dilema;
			while ($row = mysql_fetch_array($result) ) {
				$dilemma_id = $row['dilemma_id'];
				$current_dilema = new Dilemma($dilemma_id);
				$dilemmas[] = $current_dilema;
			}
			return $dilemmas;
		} else {
			if ($GLOBALS['debug']) {
				print "Could not retrieve weekly dilemmas for player $player_id: " . mysql_error() . "<br>\n" . $sql;
			}
			return null;
		}
	}
	
	/*	this is prone to error if there are very few dilemmas that have not been picked for this person
	 *  i.e. if the available set of numbers to randomly pick from is very small
	 *	so when having more time, I should come back and put a proper algorithm in to methodically check for available numbers
	 */
	function pick_weekly_dilemmas($player_id, $game_id) {
		$dilemmas = $this->db_load_dilemmas();
		$previous_dilemmas = $this->get_all_player_weekly_dilemmas($player_id);
		$avatar = new Avatar($player_id);
		// need to chagne this should be weekly options current
		$time_units = 1;
		//$time_units = $avatar->weeklyTimeUnitsCurrent;
		$random_dilemma_index = null;
		$random_dilemma = null;
		// chosen items represents the items selected in this function - it contains dilemma ids, not Dilemmas.
		$chosen_items = null;
		
		while ($time_units > 0) {
				
			if ( $random_dilemma_index == null || $has_been_picked ) {
				$random_dilemma_index = rand(0, (sizeof($dilemmas)-1));
				$random_dilemma = $dilemmas[$random_dilemma_index];
				$has_been_picked = false;
			}
			// first check if we picked it today
			if ( $chosen_items != null ) {
				foreach ($chosen_items as $key=>$currentDilemma) {
					if ($currentDilemma == $random_dilemma->dilemmaId) {
						$has_been_picked = true;
						print " Rejected 1: item is same[".$random_dilemma->dilemmaId."]\n";
					}	
				}
			}
	
			// now check if picked in the past 
			if (!$has_been_picked && $previous_dilemmas != null) { 			
				foreach($previous_dilemmas as $key=>$currentDilemma) {
					if ($currentDilemma->dilemmaId == $random_dilemma->dilemmaId) {
						$has_been_picked = true;
						print " Rejected 2: item is same[".$random_dilemma->dilemmaId."]\n";
					}
				}
			}
			
			if (!$has_been_picked) {
				
				print "chose to add: ".$random_dilemma->dilemmaId."]\n\n";
				$chosen_items[] = $random_dilemma->dilemmaId;
				$random_dilemma_index = null;
				$random_dilemma = null;
				$time_units--;	
			}
		}
		
		// now actually insert into DB
		foreach($chosen_items as $key=>$dilemmaId) {
			if(!$this->db) {
				db_connect();
			}
			$player_id = $this->db_escape($player_id) ;
			$game_id = $this->db_escape($game_id);
			$dilemmaId = $this->db_escape($dilemmaId);
			
			$sql = "INSERT INTO player_weekly_dilemmas (player_id, dilemma_id, game_turn) VALUES (".$player_id.",".$dilemmaId.",".$game_id.")";
			
			
			$result = mysql_query($sql);
		
			if(!$result) {
				if ($GLOBALS['debug']) {
					print "Failed to insert into player_weekly_dilemmas.\n$sql\n". mysql_error();
				}
			}
		}
	}
	
	
	/*	
	 *	This updates the weekly dilemma with the player's choice.
	 */
	function update_weekly_dilemma($player_id, $game_id, $game_turn, $dilemma_options) {
		if(!$this->db) {
			db_connect();
		}
		
		$player_id = $this->db_escape($player_id);
		$game_id = $this->db_escape($game_id);
		$game_turn = $this->db_escape($game_turn);
		
		$dilemma = $this->get_player_weekly_dilemmas($player_id, $game_id, $game_turn);
		
		// is it a normal submission and not a "user generated" submission?
		if ( $dilemma_options["option_submitted"] != $GLOBALS['player_choice_dilemma'] ) {
			$sql =  "UPDATE  `player_weekly_dilemmas` SET  `dilemma_option_chosen` =  '".  
					$dilemma_options["option_submitted"] ."' WHERE  `player_weekly_dilemmas`.`player_id` = ".
					$player_id ." AND  `player_weekly_dilemmas`.`dilemma_id` = ". $dilemma->dilemmaId .
					" AND game_turn = " . $game_turn;
		
			$result = mysql_query($sql);
			if(!$result) {
				if ($GLOBALS['debug']) {
					die ("Failed to update weekly dilemma.\n$sql\n". mysql_error() );;
				}
			} else {
				$this->db_log("Player_selected_weekly_dilemma_option","p = " . $player_id . "|gi = ".$game_id."|gt = ".$game_turn."|dId = ". $dilemma->dilemmaId."|opId = ". $dilemma_options["option_submitted"], $player_id, $game_id ); 	
			}
		} else {
			// player has submitted their own response
			try {
				$player = new Player($player_id);
				mail("davidfarrell81@gmail.com", "CareerQuest - Dilemma(".$dilemma->dilemmaId.") Answer from ". $player->forename. " " . $player->surname, $player_text);
	
			} catch (Exception $e) {
				$this->db_log("Exception", $e, $player_id, $game_id);	
			}
			
			
			$player_text = $this->db_escape($dilemma_options["player_text"] );
			
			// first insert player option into DB
			$sql =  "replace INTO  `player_submitted_dilemma_solutions` (
					`dilemma_id` ,
					`player_id` ,
					`solution_scored` ,
					`solution_description` ,
					`score_wellness` ,
					`score_awareness` ,
					`score_ability` ,
					`score_professionalism` ,
					`score_work_ethic` ,
					`solution_feedback`
					)
					VALUES (
					'".$dilemma->dilemmaId."',  '".$player_id."',  '0',  '".$player_text."', NULL , NULL , NULL , NULL , NULL , NULL
					);";
		
			$result = mysql_query($sql);
			if(!$result) {
				if ($GLOBALS['debug']) {
					die ("Failed to save player option.\n$sql\n". mysql_error() );;
				}
			} else {
				$player_option_id =  mysql_insert_id();
			
				$this->db_log("Player_submitted_dilemma_option_saved","p = " . $player_id . "|gi = ".$game_id."|gt = ".$game_turn."|dId = ". $dilemma->dilemmaId."|opId = ". player_option_id ."|optionSubmitted = ".$player_text, $player_id, $game_id); 	
			}	
			
			
			// now update weekly dilemma record
			$sql =  "UPDATE  `player_weekly_dilemmas` SET  `dilemma_option_chosen` =  null, ".
					" `player_option_chosen` = 1 ".
					" WHERE  `player_weekly_dilemmas`.`player_id` = ".
					$player_id ." AND  `player_weekly_dilemmas`.`dilemma_id` = ". $dilemma->dilemmaId .
					" AND game_turn = " . $game_turn;
		
			$result = mysql_query($sql);
			if(!$result) {
				if ($GLOBALS['debug']) {
					die ("Failed to update weekly dilemma.\n$sql\n". mysql_error() );;
				}
			} else {
				$this->db_log("Player_selected_weekly_dilemma_option","p = " . $player_id . "|gi = ".$game_id."|gt = ".$game_turn."|dId = ". $dilemma->dilemmaId."|opId = ". $dilemma_options["option_submitted"], $player_id, $game_id ); 	
			}	
		}
	}

	
	
	function db_save_feedback($player_id, $game_id, $game_turn, $feedback_type, $feedback_text, $feedback_acknowledged=null) {
		if(!$this->db) {
			db_connect();
		}
		$player_id = $this->db_escape($player_id);
		$game_id = $this->db_escape($game_id);
		$game_turn = $this->db_escape($game_turn);
		$feedback_type = $this->db_escape($feedback_type);
		$feedback_text = $this->db_escape($feedback_text);
		if ($feedback_acknowledged != null) {
			$feedback_acknowledged = $this->db_escape($feedback_acknowledged);
		}
		$sql =  "replace INTO  `feedback` (
					`player_id` ,
					`game_id` ,
					`game_turn` ,
					`feedback_type` ,
					`feedback_text`";
		if ( $feedback_acknowledged != null ) {
			$sql .= " , `feedback_acknowledged` ";	
		}
		$sql.= " )
					VALUES (
					'".$player_id."',  '".$game_id."',  '".$game_turn."',  '".
					$feedback_type."', '".$feedback_text."' ";
					
		if ($feedback_acknowledged != null ) {
			$sql .= ", '".$feedback_acknowledged."' ";	
		}
		$sql .= " );";
		$result = mysql_query($sql);
		if(!$result) {
			if ($GLOBALS['debug']) {
				die ("Failed to save Feedback.\n$sql\n". mysql_error() );;
			}
		}
	}
	
	/*
		returns an array, indexed thus
		[mechanic type (e.g. weekly)][score type (e.g. wellness)] = score
		
		because the avatar has scores hard coded, you must subtract if you want to show change over time
	*/
	function db_get_cumulative_scores($player_id, $game_id, $game_turn) {
		if(!$this->db) {
			db_connect();
		}
		$avatar = $this->db_load_current_avatar($player_id);
	
		$player_id = $this->db_escape($player_id);
		$game_id = $this->db_escape($game_id);
		$game_turn = $this->db_escape($game_turn);
		$scores = null;
		// first get all weekly scores
		$sql = "SELECT player_weekly_activities.activity_id, activities.score_wellness, activities.score_awareness,".
				" activities.score_ability, activities.score_professionalism, activities.score_work_ethic ". 
				" FROM player_weekly_activities, activities  ". 
				" WHERE player_weekly_activities.activity_id = activities.activity_id ". 
				" AND player_weekly_activities.player_id = ". $player_id . 
				" AND player_weekly_activities.game_id = ". $game_id .  
				" AND player_weekly_activities.game_turn = ". $game_turn. 
				" AND player_weekly_activities.chosen =1 " .
				" ORDER BY player_weekly_activities.game_turn asc, activities.activity_id asc";
		$result = mysql_query($sql);
		while ($row = mysql_fetch_array($result)) {
			$scores[$GLOBALS['mechanic_weekly']] [$GLOBALS['scoretype_wellbeing']] += $row['score_wellness'];
			$scores[$GLOBALS['mechanic_weekly']] [$GLOBALS['scoretype_awareness']] += $row['score_awareness'];
			$scores[$GLOBALS['mechanic_weekly']] [$GLOBALS['scoretype_ability']] += $row['score_ability'];
			$scores[$GLOBALS['mechanic_weekly']] [$GLOBALS['scoretype_professionalism']] += $row['score_professionalism'];
			$scores[$GLOBALS['mechanic_weekly']] [$GLOBALS['scoretype_work_ethic']] += $row['score_work_ethic'];
		}
		
		
		// then check for Dilemmas where the player chose an existing answer.
		$sql = "SELECT dilemmas.dilemma_name, ".
				"player_weekly_dilemmas.dilemma_id, player_weekly_dilemmas.dilemma_option_chosen, 
				 player_weekly_dilemmas.player_option_chosen, ".
				"dilemma_options.dilemma_option_description, dilemma_options.dilemma_option_id, dilemma_options.score_wellness, ".
				"dilemma_options.score_awareness, dilemma_options.score_ability, dilemma_options.score_professionalism, ". 			
				"dilemma_options.score_work_ethic ".					
				"FROM dilemma_options, dilemmas, player_weekly_dilemmas ".
				"WHERE dilemma_options.dilemma_option_id = player_weekly_dilemmas.dilemma_option_chosen ".
				"AND dilemma_options.dilemma_id = dilemmas.dilemma_id ".
				"AND dilemmas.dilemma_id = player_weekly_dilemmas.dilemma_id ".					
				"AND player_id = ". $player_id . 
				" AND game_turn =" . $game_turn;
			$result = mysql_query($sql);
		while ($row = mysql_fetch_array($result)) {
			$scores[$GLOBALS['mechanic_dilemma']] [$GLOBALS['scoretype_wellbeing']] += $row['score_wellness'];
			$scores[$GLOBALS['mechanic_dilemma']] [$GLOBALS['scoretype_awareness']] += $row['score_awareness'];
			$scores[$GLOBALS['mechanic_dilemma']] [$GLOBALS['scoretype_ability']] += $row['score_ability'];
			$scores[$GLOBALS['mechanic_dilemma']] [$GLOBALS['scoretype_professionalism']] += $row['score_professionalism'];
			$scores[$GLOBALS['mechanic_dilemma']] [$GLOBALS['scoretype_work_ethic']] += $row['score_work_ethic'];
		}
		
		// and now for Dilemmas that the user submitted themselves
		// then check for Dilemmas where the player chose an existing answer.
		$sql = "SELECT 

				player_weekly_dilemmas.dilemma_id, player_weekly_dilemmas.dilemma_option_chosen,
				player_weekly_dilemmas.player_option_chosen,
				
				player_submitted_dilemma_solutions.score_wellness, player_submitted_dilemma_solutions.score_awareness,
				player_submitted_dilemma_solutions.score_ability, player_submitted_dilemma_solutions.score_professionalism, 
				player_submitted_dilemma_solutions.score_work_ethic
				
				from player_weekly_dilemmas, player_submitted_dilemma_solutions
				
				where player_weekly_dilemmas.dilemma_id = player_submitted_dilemma_solutions.dilemma_id and 
				player_weekly_dilemmas.player_id = player_submitted_dilemma_solutions.player_id and
				
				player_weekly_dilemmas.player_id = ". $player_id . 
				" AND player_weekly_dilemmas.game_turn =" . $game_turn;
			$result = mysql_query($sql);
		while ($row = mysql_fetch_array($result)) {
			$scores[$GLOBALS['mechanic_dilemma']] [$GLOBALS['scoretype_wellbeing']] += $row['score_wellness'];
			$scores[$GLOBALS['mechanic_dilemma']] [$GLOBALS['scoretype_awareness']] += $row['score_awareness'];
			$scores[$GLOBALS['mechanic_dilemma']] [$GLOBALS['scoretype_ability']] += $row['score_ability'];
			$scores[$GLOBALS['mechanic_dilemma']] [$GLOBALS['scoretype_professionalism']] += $row['score_professionalism'];
			$scores[$GLOBALS['mechanic_dilemma']] [$GLOBALS['scoretype_work_ethic']] += $row['score_work_ethic'];
		}
		
		
		//finally get scores for dailies
		$sql = "select * from player_daily_tasks where player_id = ". $player_id .
				" and game_turn = " . $game_turn." order by day asc";
				
			$result = mysql_query($sql);
		while ($row = mysql_fetch_array($result)) {
			$scores[$GLOBALS['mechanic_daily']] [$GLOBALS['scoretype_wellbeing']] += $row['score_wellness'];
			$scores[$GLOBALS['mechanic_daily']] [$GLOBALS['scoretype_awareness']] += $row['score_awareness'];
			$scores[$GLOBALS['mechanic_daily']] [$GLOBALS['scoretype_ability']] += $row['score_ability'];
			$scores[$GLOBALS['mechanic_daily']] [$GLOBALS['scoretype_professionalism']] += $row['score_professionalism'];
			$scores[$GLOBALS['mechanic_daily']] [$GLOBALS['scoretype_work_ethic']] += $row['score_work_ethic'];
		}
		return $scores;
	}
	
	function db_update_avatar_scores($player_id, $scores) {
		if(!$this->db) {
			db_connect();
		}
		$avatar = new Avatar($player_id);
		
		$avatar->scoreWellbeing += $scores[$GLOBALS['scoretype_wellbeing']];
		$avatar->scoreAwareness += $scores[$GLOBALS['scoretype_awareness']];
		$avatar->scoreAbility += $scores[$GLOBALS['scoretype_ability']];
		$avatar->scoreProfessionalism += $scores[$GLOBALS['scoretype_professionalism']];
		$avatar->scoreWorkEthic += $scores[$GLOBALS['scoretype_work_ethic']];
		
		$sql = "Update avatars set score_wellbeing = " .$avatar->scoreWellbeing. 
								", score_awareness = " .$avatar->scoreAwareness. 
								", score_ability = " .$avatar->scoreAbility. 
								", score_professionalism = " .$avatar->scoreProfessionalism. 
								", score_work_ethic = " .$avatar->scoreWorkEthic .
				" WHERE player_id = " . $player_id;
				
		$result = mysql_query($sql);
	}
	
	function db_get_last_week_scores($player_id, $game_id, $game_turn) {
		if(!$this->db) {
			db_connect();
		}
		$avatar = $this->db_load_current_avatar($player_id);
	
		$player_id = $this->db_escape($player_id);
		$game_id = $this->db_escape($game_id);
		$game_turn = $this->db_escape($game_turn);
		$scores = null;
		
		$scores[0] = $this->db_get_cumulative_scores($player_id, $game_id, 0);
		$scores[1] = $this->db_get_cumulative_scores($player_id, $game_id, 1);
		$scores[2] = $this->db_get_cumulative_scores($player_id, $game_id, 2);
		$scores[3] = $this->db_get_cumulative_scores($player_id, $game_id, 2);
		
		$last_turn = ($game_turn -1);
		
		$last_week_scores[$GLOBALS['scoretype_wellbeing']] = $avatar->scoreWellbeing;
		$last_week_scores[$GLOBALS['scoretype_wellbeing']] -= $scores[ $last_turn ][$GLOBALS['mechanic_weekly']][$GLOBALS['scoretype_wellbeing']];
		$last_week_scores[$GLOBALS['scoretype_wellbeing']] -= $scores[ $last_turn ][$GLOBALS['mechanic_daily']][$GLOBALS['scoretype_wellbeing']];
		$last_week_scores[$GLOBALS['scoretype_wellbeing']] -= $scores[ $last_turn ][$GLOBALS['mechanic_dilemma']][$GLOBALS['scoretype_wellbeing']];
		
		$last_week_scores[$GLOBALS['scoretype_awareness']] = $avatar->scoreAwareness;
		$last_week_scores[$GLOBALS['scoretype_awareness']] -= $scores[ $last_turn ][$GLOBALS['mechanic_weekly']][$GLOBALS['scoretype_awareness']];
		$last_week_scores[$GLOBALS['scoretype_awareness']] -= $scores[ $last_turn ][$GLOBALS['mechanic_daily']][$GLOBALS['scoretype_awareness']];
		$last_week_scores[$GLOBALS['scoretype_awareness']] -= $scores[ $last_turn ][$GLOBALS['mechanic_dilemma']][$GLOBALS['scoretype_awareness']];
		
		$last_week_scores[$GLOBALS['scoretype_ability']] = $avatar->scoreAbility;
		$last_week_scores[$GLOBALS['scoretype_ability']] -= $scores[ $last_turn ][$GLOBALS['mechanic_weekly']][$GLOBALS['scoretype_ability']];
		$last_week_scores[$GLOBALS['scoretype_ability']] -= $scores[ $last_turn ][$GLOBALS['mechanic_daily']][$GLOBALS['scoretype_ability']];
		$last_week_scores[$GLOBALS['scoretype_ability']] -= $scores[ $last_turn ][$GLOBALS['mechanic_dilemma']][$GLOBALS['scoretype_ability']];
		
		$last_week_scores[$GLOBALS['scoretype_professionalism']] = $avatar->scoreAwareness;
		$last_week_scores[$GLOBALS['scoretype_professionalism']] -= $scores[ $last_turn ][$GLOBALS['mechanic_weekly']][$GLOBALS['scoretype_professionalism']];
		$last_week_scores[$GLOBALS['scoretype_professionalism']] -= $scores[ $last_turn ][$GLOBALS['mechanic_daily']][$GLOBALS['scoretype_professionalism']];
		$last_week_scores[$GLOBALS['scoretype_professionalism']] -= $scores[ $last_turn ][$GLOBALS['mechanic_dilemma']][$GLOBALS['scoretype_professionalism']];
		
		$last_week_scores[$GLOBALS['scoretype_work_ethic']] = $avatar->scoreAwareness;
		$last_week_scores[$GLOBALS['scoretype_work_ethic']] -= $scores[ $last_turn ][$GLOBALS['mechanic_weekly']][$GLOBALS['scoretype_work_ethic']];
		$last_week_scores[$GLOBALS['scoretype_work_ethic']] -= $scores[ $last_turn ][$GLOBALS['mechanic_daily']][$GLOBALS['scoretype_work_ethic']];
		$last_week_scores[$GLOBALS['scoretype_work_ethic']] -= $scores[ $last_turn ][$GLOBALS['mechanic_dilemma']][$GLOBALS['scoretype_work_ethic']];
		
		return $last_week_scores;
	}
	
	
	function db_load_feedback($player_id, $game_id, $game_turn, $feedback_type) {
		if(!$this->db) {
			db_connect();
		}
		$player_id = $this->db_escape($player_id);
		$game_id = $this->db_escape($game_id);
		$game_turn = $this->db_escape($game_turn);
		$feedback_type = $this->db_escape($feedback_type);
		
		$sql = "SELECT * FROM feedback where player_id = " . $player_id . " and game_id = " . $game_id  .
				" and game_turn = " . $game_turn . " and feedback_type = " . $feedback_type;
		$result = mysql_query($sql);
	
		if($row = mysql_fetch_array($result)) {
		  return $row;
		} else return null;
	}
	
	// returns array of feedback objects ordered by feedback type asc
	function db_find_unacknowledged_feedback($player_id, $game_id, $game_turn) {
		if(!$this->db) {
			db_connect();
		}
		$player_id = $this->db_escape($player_id);
		$game_id = $this->db_escape($game_id);
		$game_turn = $this->db_escape($game_turn);
		$feedbacks = null;
		// 4 types of fedback.
		$weeklyFeedback = new Feedback($player_id, $game_id, $game_turn, $GLOBALS['feedback_weekly']);
		$dailyFeedback =  new Feedback($player_id, $game_id, $game_turn, $GLOBALS['feedback_daily']);
		$dilemmaFeedback =  new Feedback($player_id, $game_id, $game_turn, $GLOBALS['feedback_dilemma']);
		$bevFeedback =  new Feedback($player_id, $game_id, $game_turn, $GLOBALS['feedback_bev']);
		
		if ( ($dailyFeedback->playerId != null) && !$dailyFeedback->feedbackAcknowledged ) {
			$feedbacks[] = $dailyFeedback;	
		}
		if ( ($weeklyFeedback->playerId != null) && !$weeklyFeedback->feedbackAcknowledged ) {
			$feedbacks[] = $weeklyFeedback;	
		}
		if ( ($dilemmaFeedback->playerId != null) && !$dilemmaFeedback->feedbackAcknowledged ) {
			$feedbacks[] = $dilemmaFeedback;	
		}
		if ( ($bevFeedback->playerId != null) && !$bevFeedback->feedbackAcknowledged ) {
			$feedbacks[] = $bevFeedback;	
		}
		return $feedbacks;
	}
	
	function acknowledged_feedback($player_id, $game_id, $game_turn) {
		if(!$this->db) {
			db_connect();
		}
		$player_id = $this->db_escape($player_id);
		$game_id = $this->db_escape($game_id);
		$game_turn = $this->db_escape($game_turn);
		
		$sql = "UPDATE feedback set feedback_acknowledged = 1 where player_id =  ". $player_id . " and game_id = ". $game_id . " and game_turn = ". $game_turn;
		
		$result = mysql_query($sql);
	}
}
?>