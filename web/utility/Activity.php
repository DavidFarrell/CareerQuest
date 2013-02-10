<?php

class Activity {
	
	public $activityId;
	public $activityName;
	public $activityDescription;
	public $activityDetails;
	public $activityNotes;
	public $activityCost;
	public $activityMainArea;
	public $scoreWellness;
	public $scoreAwareness;
	public $scoreProfessionalism;
	public $scoreWorkEthic;
	
	// if creating from array row from DB, send null id
	function __construct($id = "", $activity_array = "") {
		if ( !($id == null && $activity_array == null) ) {
			$this->loadActivity($id, $activity_array);	
		} else {
			die ("no activity id $id or array $activity_array passed to new activity");			
		}
	}
	
	function loadActivity($id = "", $activity_array = "")  {
		if (  ($id == null && $activity_array == null) ) {
			die ("no activity id $id or array passed to load activity");		
		}
		
		// we can send an array here, or get one from DB
		if ($id != null) {
			$activity_array = $GLOBALS['databaseUtility']->db_load_activity($id);	
		} 
		$this->activityId = $activity_array['activity_id'];
		$this->activityName = $activity_array['activity_name'];
		$this->activityDescription = $activity_array['activity_description'];
		$this->activityDetails = $activity_array['activity_details'];
		$this->activityNotes = $activity_array['activity_notes'];
		$this->activityCost = $activity_array['activity_cost'];
		$this->activityMainArea = $activity_array['activity_main_area'];
		$this->scoreWellness = $activity_array['score_wellness'];
		$this->scoreAwareness = $activity_array['score_awareness'];
		$this->scoreAbility = $activity_array['score_professionalism'];
		$this->scoreProfessionalism = $activity_array['score_professionalism'];
		$this->scoreWorkEthic = $activity_array['score_work_ethic'];
	}
	
	function __toString() {
		$returnString = "[Activity [".$this->activityId."]:\n";
		$returnString .= "	activityName=[".$this->activityName."]\n";
		$returnString .= "	activityDescription=[".$this->activityDescription."]\n";
		$returnString .= "	activityDetails=[".$this->activityDetails."]\n";
		$returnString .= "	activityNotes=[".$this->activityNotes."]\n";
		$returnString .= "	activityCost=[".$this->activityCost."]\n";
		$returnString .= "	activityMainArea=[". $GLOBALS['activity_type'][ $this->activityMainArea] ."]\n";
		$returnString .= "	scoreWellness=[".$this->scoreWellness."]\n";
		$returnString .= "	scoreAwareness=[".$this->scoreAwareness."]\n";
		$returnString .= "	scoreAbility=[".$this->scoreAbility."]\n";
		$returnString .= "	scoreProfessionalism=[".$this->scoreProfessionalism."]\n";
		$returnString .= "	scoreWorkEthic=[".$this->scoreWorkEthic."]\n";
		
		$returnString .="		//end Activity]";
		
		return $returnString;
	
	}
	
}