<?php

require_once ("./utility/database_config.php");
class DatabaseUtility {
	public $db;
	
	private $MYSQL_HOST = "localhost";
	private $MYSQL_PORT = "8889";
	private $MYSQL_DATABASE = "career_quest";
	private $MYSQL_USER = "root";
	private $MYSQL_PASSWORD = "root";

	function __construct() {
		$this->db_connect();
		
	}
	
	function __toString() {
		return "Connection status: " . $this->db;	
	}

	function db_connect() {
		$this->db = mysql_connect($this->MYSQL_HOST, $this->MYSQL_USER, $this->MYSQL_PASSWORD);
		if (!$this->db) {
			die ('Could not connect to database host: ' . mysql_error());
		} else {
			$db_selected = mysql_select_db($this->MYSQL_DATABASE, $this->db);
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
	
	function db_log($type, $params) {
		if (!$this->db) {
			db_connect();
		}
		
		$sql="INSERT INTO game_log (event_type, event_params)
		VALUES
		('".$type."','".$params."')";
		
		if (!mysql_query($sql,$this->db)) {
			die('Error: ' . mysql_error() . '<br>' . $sql . "<br>" . $this->db);
		}
	}
	
	function db_load_player($id) {
		if(!$this->db) {
			db_connect();
		}
		//$this->db_log("LoadPlayer" , $id);
		$id = $this->db_escape($id) ;
		
		$sql = "SELECT * FROM players where player_id = " . $id;
		
		$result = mysql_query($sql);
	
		if($row = mysql_fetch_array($result)) {
		  return $row;
		} else die ("Could not retrieve person: " . mysql_error() . "<br>" . $sql);
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
	
	function get_all_player_weekly_activities($player_id) {
		if(!$this->db) {
			db_connect();
		}
		$player_id = $this->db_escape($player_id) ;
		$activities = null;
		$sql = "SELECT * FROM player_weekly_activities where player_id = ". $player_id ."  order by game_turn asc, activity_id asc";
		
		$result = mysql_query($sql);
	
		if($row = mysql_fetch_array($result)) {
			$activity_id = $row['activity_id'];
			$current_activity = new Activity($activity_id);
			$activities[] =  $current_activity;
			while ($row = mysql_fetch_array($result) ) {
				$activity_id = $row['activity_id'];
				$current_activity = new Activity($activity_id);
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
	
	
	
	
	function pick_weekly_activities($player_id, $game_id) {
		$activities = $this->db_load_activities();
		$previous_activities = $this->get_all_player_weekly_activities($player_id);
		$avatar = new Avatar($player_id);
		// need to chagne this should be weekly options current
		$time_units = 1;
		$time_units = $avatar->weeklyTimeUnitsCurrent;
		$random_activity = null;
		
		// chosen items represents the items selected in this function - it contains activity ids, not Activities.
		$chosen_items = null;
		
		while ($time_units > 0) {
				
			if ( $random_activity == null || $has_been_picked ) {
				$random_activity = rand(1, (sizeof($activities)-1));
				$has_been_picked = false;
			}
			// first check if we picked it today
			if ( $chosen_items != null ) {
				foreach ($chosen_items as $key=>$currentActivity) {
					if ($currentActivity == $random_activity) {
						$has_been_picked = true;
					}	
				}
			}
	
			// now check if picked in the past 
			if (!$has_been_picked && $previous_activities != null) { 			
				foreach($previous_activities as $key=>$currentActivity) {
					if ($currentActivity->activityId == $random_activity) {
						$has_been_picked = true;
					}
				}
			}
			
			if (!$has_been_picked) {
				$chosen_items[] = $random_activity;
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
	
	function pick_weekly_dilemmas($player_id, $game_id) {
		//$dilemmas = $this->db_load_dilemmas();
		/*$previous_activities = $this->get_all_player_weekly_activities($player_id);
		$avatar = new Avatar($player_id);
		// need to chagne this should be weekly options current
		$time_units = 1;
		$time_units = $avatar->weeklyTimeUnitsCurrent;
		$random_activity = null;
		
		// chosen items represents the items selected in this function - it contains activity ids, not Activities.
		$chosen_items = null;
		
		while ($time_units > 0) {
				
			if ( $random_activity == null || $has_been_picked ) {
				$random_activity = rand(1, (sizeof($activities)-1));
				$has_been_picked = false;
			}
			// first check if we picked it today
			if ( $chosen_items != null ) {
				foreach ($chosen_items as $key=>$currentActivity) {
					if ($currentActivity == $random_activity) {
						$has_been_picked = true;
					}	
				}
			}
	
			// now check if picked in the past 
			if (!$has_been_picked && $previous_activities != null) { 			
				foreach($previous_activities as $key=>$currentActivity) {
					if ($currentActivity->activityId == $random_activity) {
						$has_been_picked = true;
					}
				}
			}
			
			if (!$has_been_picked) {
				$chosen_items[] = $random_activity;
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
		}*/
	}
	
}
?>