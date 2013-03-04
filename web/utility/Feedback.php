<?php

class Feedback {
	
	public $playerId;
	public $gameId;
	public $gameTurn;
	public $feedbackType;
	public $feedbackText;
	public $feedbackAcknowledged;
	public $lastModified;
	
	function __construct($player_id, $game_id, $game_turn, $feedback_type) {
		if ( $player_id != null && $game_id != null && $game_turn != null && $feedback_type) {
			$this->loadFeedback($player_id, $game_id, $game_turn, $feedback_type);	
		}
	}
	
	function loadFeedback($player_id, $game_id, $game_turn, $feedback_type)  {
		if ( $player_id != null && $game_id != null && $game_turn != null && $feedback_type) {
			$feedback_array = $GLOBALS['databaseUtility']->db_load_feedback($player_id, $game_id, $game_turn, $feedback_type);	
		
			$this->playerId = $avatar_array['player_id'];
			$this->gameId = $avatar_array['gameId'];
			$this->gameTurn = $avatar_array['gameTurn'];
			$this->feedbackType = $avatar_array['feedback_type'];
			$this->feedbackText = $avatar_array['feedback_text'];
			$this->feedbackAcknowledged = $avatar_array['feedback_acknowledged'];
			$this->lastModified = $avatar_array['last_modified'];
		}
	}
	
	function __toString() {
		$returnString = "[Feedback :\n";
		$returnString .= "	playerId=[".$this->playerId."]\n";
		$returnString .= "	gameId=[".$this->gameId."]\n";
		$returnString .= "	gameTurn=[".$this->gameTurn."]\n";
		$returnString .= "	feedbackType=[".$this->feedbackType."]\n";
		$returnString .= "	feedbackAcknowledged=[".$this->feedbackAcknowledged."]\n";
		$returnString .= "	lastModified=[".$this->lastModified."]\n";
		$returnString .="		//end Avatar]";
		
		return $returnString;
	
	}
	
}