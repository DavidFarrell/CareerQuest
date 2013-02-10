<?php

class Player {
	
	public $playerId;
	public $email;
	public $password;
	public $forename;
	public $surname;
	public $autonomy_support;
	public $relatedness_support;
	public $competence_support;
	public $lab_time;
	public $notes;
	public $experiment_opt_out;
	public $game_id;
	public $time_created;
	
	function __construct($id = "") {
		if ( $id != null) {
			$this->loadPlayer($id);	
		}
	}
	
	function loadPlayer($id = "")  {
		if ($id != null) {
			$player_array = $GLOBALS['databaseUtility']->db_load_player($id);	
		//	$row['forename'] . " " . $row['surname'];
			$this->playerId = $player_array['player_id'];
			$this->email = $player_array['email'];
			$this->password = $player_array['password'];
			$this->forename = $player_array['forename'];
			$this->surname = $player_array['surname'];
			$this->autonomy_support = $player_array['autonomy_support'];
			$this->relatedness_support = $player_array['relatedness_support'];
			$this->competence_support = $player_array['competence_support'];
			$this->lab_time = $player_array['lab_time'];
			$this->notes = $player_array['notes'];
			$this->experiment_opt_out = $player_array['experiment_opt_out'];
			$this->game_id = $player_array['game_id'];
			$this->time_created = $player_array['time_created'];
		}
	}
	
	function __toString() {
		$returnString = "[Player [".$this->playerId."]:\n";
		$returnString .= "	forename=[".$this->forename."]\n";
		$returnString .= "	surname=[".$this->surname."]\n";
		$returnString .= "	email=[".$this->email."]\n";
		$returnString .= "	password=[".$this->password."]\n";
		$returnString .= "	autonomy_support=[".$this->autonomy_support."]\n";
		$returnString .= "	relatedness_support=[".$this->relatedness_support."]\n";
		$returnString .= "	competence_support=[".$this->competence_support."]\n";
		$returnString .= "	lab_time=[".$this->lab_time."]\n";
		$returnString .= "	notes=[".$this->notes."]\n";
		$returnString .= "	experiment_opt_out=[".$this->experiment_opt_out."]\n";
		$returnString .= "	game_id=[".$this->game_id."]\n";
		$returnString .= "	time_created=[".$this->time_created."]\n";
		$returnString .="		//end Player]";
		
		return $returnString;
	
	}
	
}