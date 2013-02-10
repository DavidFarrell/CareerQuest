<?php

class Avatar {
	
	public $avatarId;
	public $playerId;
	public $isCurrentAvatar;
	public $avatarImageURL;
	public $avatarName;
	public $avatarGender;
	public $isPlayerChoice;
	public $scoreWellbeing;
	public $scoreAwareness;
	public $scoreAbility;
	public $scoreProfessionalism;
	public $scoreWorkEthic;
	public $weeklyTimeUnitsCurrent;
	public $weeklyTimeUnitsBase;
	public $weeklyTimeUnitsBuff;
	public $dailyTimeUnitsCurrent;
	public $dailyTimeUnitsBase;
	public $dailyTimeUnitsBuff;
	public $lastModified;
	
	// AVATAR USES PLAYER ID TO FIND MOST RECENT AVATAR - NO CURRENT SUPPORT FOR OTHER AVATARS
	function __construct($playerId = "") {
		if ( $playerId != null) {
			$this->loadAvatar($playerId);	
		}
	}
	
	function loadAvatar($playerId = "")  {
		if ($playerId != null) {
			$avatar_array = $GLOBALS['databaseUtility']->db_load_current_avatar($playerId);	
		
			$this->avatarId = $avatar_array['avatar_id'];
			$this->playerId = $avatar_array['player_id'];
			$this->isCurrentAvatar = $avatar_array['is_current_avatar'];
			$this->avatarImageURL = $avatar_array['avatar_image_url'];
			$this->avatarName = $avatar_array['avatar_name'];
			$this->avatarGender = $avatar_array['avatar_gender'];
			$this->isPlayerChoice = $avatar_array['player_choice'];
			$this->scoreWellbeing = $avatar_array['score_wellbeing'];
			$this->scoreAwareness = $avatar_array['score_awareness'];
			$this->scoreAbility = $avatar_array['score_ability'];
			$this->scoreProfessionalism = $avatar_array['score_professionalism'];
			$this->scoreWorkEthic = $avatar_array['score_work_ethic'];
			$this->weeklyTimeUnitsCurrent = $avatar_array['weekly_time_units_current'];
			$this->weeklyTimeUnitsBase = $avatar_array['weekly_time_units_base'];
			$this->weeklyTimeUnitsBuff = $avatar_array['weekly_time_units_buff'];
			$this->dailyTimeUnitsCurrent = $avatar_array['daily_time_units_current'];
			$this->dailyTimeUnitsBase = $avatar_array['daily_time_units_base'];
			$this->dailyTimeUnitsBuff = $avatar_array['daily_time_units_buff'];
			$this->lastModified = $avatar_array['last_modified'];
	
		}
	}
	
	function __toString() {
		$returnString = "[Avatar [".$this->avatarId."]:\n";
		$returnString .= "	playerId=[".$this->playerId."]\n";
		$returnString .= "	isCurrentAvatar=[".$this->isCurrentAvatar."]\n";
		$returnString .= "	avatarImageURL=[".$this->avatarImageURL."]\n";
		$returnString .= "	avatarName=[".$this->avatarName."]\n";
		$returnString .= "	avatarGender=[".$this->avatarGender."]\n";
		$returnString .= "	isPlayerChoice=[".$this->isPlayerChoice."]\n";
		$returnString .= "	scoreWellbeing=[".$this->scoreWellbeing."]\n";
		$returnString .= "	scoreAwareness=[".$this->scoreAwareness."]\n";
		$returnString .= "	scoreAbility=[".$this->scoreAbility."]\n";
		$returnString .= "	scoreProfessionalism=[".$this->scoreProfessionalism."]\n";
		$returnString .= "	scoreWorkEthic=[".$this->scoreWorkEthic."]\n";
		$returnString .= "	weeklyTimeUnitsCurrent=[".$this->weeklyTimeUnitsCurrent."]\n";
		$returnString .= "	weeklyTimeUnitsBase=[".$this->weeklyTimeUnitsBase."]\n";
		$returnString .= "	weeklyTimeUnitsBuff=[".$this->weeklyTimeUnitsBuff."]\n";
		$returnString .= "	dailyTimeUnitsCurrent=[".$this->dailyTimeUnitsCurrent."]\n";
		$returnString .= "	dailyTimeUnitsBase=[".$this->dailyTimeUnitsBase."]\n";
		$returnString .= "	dailyTimeUnitsBuff=[".$this->dailyTimeUnitsBuff."]\n";
		$returnString .= "	lastModified=[".$this->lastModified."]\n";
		$returnString .="		//end Avatar]";
		
		return $returnString;
	
	}
	
}