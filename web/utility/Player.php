<?php

class Player {
	
	public $playerId;
	public $email;
	public $password;
	public $forename;
	public $surname;
	public $autonomySupport;
	public $relatednessSupport;
	public $competenceSupport;
	public $labTime;
	public $notes;
	public $experimentOptOut;
	public $gameId;
	public $timeCreated;
	
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
			$this->autonomySupport = $player_array['autonomy_support'];
			$this->relatednessSupport = $player_array['relatedness_support'];
			$this->competenceSupport = $player_array['competence_support'];
			$this->labTime = $player_array['lab_time'];
			$this->notes = $player_array['notes'];
			$this->experimentOptOut = $player_array['experiment_opt_out'];
			$this->gameId = $player_array['game_id'];
			$this->timeCreated = $player_array['time_created'];
		}
	}
	
	function __toString() {
		$returnString = "[Player [".$this->playerId."]:\n";
		$returnString .= "	forename=[".$this->forename."]\n";
		$returnString .= "	surname=[".$this->surname."]\n";
		$returnString .= "	email=[".$this->email."]\n";
		$returnString .= "	password=[".$this->password."]\n";
		$returnString .= "	autonomySupport=[".$this->autonomySupport."]\n";
		$returnString .= "	relatednessSupport=[".$this->relatednessSupport."]\n";
		$returnString .= "	competenceSupport=[".$this->competenceSupport."]\n";
		$returnString .= "	labTime=[".$this->labTime."]\n";
		$returnString .= "	notes=[".$this->notes."]\n";
		$returnString .= "	experimentOptOut=[".$this->experimentOptOut."]\n";
		$returnString .= "	gameId=[".$this->gameId."]\n";
		$returnString .= "	timeCreated=[".$this->timeCreated."]\n";
		$returnString .="		//end Player]";
		
		return $returnString;
	
	}
	
}