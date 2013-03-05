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
		if ( $player_id != null && $game_id != null && $game_turn != null ) {
			$this->loadFeedback($player_id, $game_id, $game_turn, $feedback_type);	
		} 
	}
	
	function loadFeedback($player_id, $game_id, $game_turn, $feedback_type)  {
		if ( $player_id != null && $game_id != null && $game_turn != null ) {
			$feedback_array = $GLOBALS['databaseUtility']->db_load_feedback($player_id, $game_id, $game_turn, $feedback_type);	
			if ($feedback_array != null ) {
				$this->playerId = $feedback_array['player_id'];
				$this->gameId = $feedback_array['game_id'];
				$this->gameTurn = $feedback_array['game_turn'];
				$this->feedbackType = $feedback_array['feedback_type'];
				$this->feedbackText = $feedback_array['feedback_text'];
				$this->feedbackAcknowledged = $feedback_array['feedback_acknowledged'];
				$this->lastModified = $feedback_array['last_updated'];
			} else {
				$this->playerId = null;
				$this->gameId = null;
				$this->gameTurn = null;
				$this->feedbackType = null;
				$this->feedbackText = null;
				$this->feedbackAcknowledged = null;
				$this->lastModified = null;
			}
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