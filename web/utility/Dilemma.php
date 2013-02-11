<?php

class Dilemma {
	
	public $dilemmaId;
	public $dilemmaName;
	public $dilemmaDescription;
	public $lastUpdated;
	//this one is an array of DilemmaOption items
	public $dilemmaOptions;
	
	function __construct($id = "") {
		if ( !($id == null && $dilemma_array == null) ) {
			$this->loadDilemma($id);	
		} else {
			die ("no dilemma id $id or array $dilemma_array passed to new dilemma");			
		}
	}
	
	function loadDilemma($id = "")  {
		if (  ($id == null) ) {
			die ("no dilemma id $id passed to load dilemma");		
		}
		
		$dilemma_array = $GLOBALS['databaseUtility']->db_load_dilemma($id);	
		$this->dilemmaId = $dilemma_array['dilemma_id'];
		$this->dilemmaName = $dilemma_array['dilemma_name'];
		$this->dilemmaDescription = $dilemma_array['dilemma_description'];
		$this->lastUpdated = $dilemma_array['last_updated'];
		
		$options = $GLOBALS['databaseUtility']->db_load_dilemma_options($id);	
		foreach ($options as $key=>$option_array) {
			$option = new DilemmaOption($option_array);	
			$this->dilemmaOptions[] = $option;
		}
		
	}
	
	function __toString() {
		$returnString = "[Dilemma [".$this->dilemmaId."]:\n";
		$returnString .= "	dilemmaName=[".$this->dilemmaName."]\n";
		$returnString .= "	dilemmaDescription=[".$this->dilemmaDescription."]\n";
		$returnString .= "	lastUpdated=[".$this->lastUpdated."]\n";
		
		$returnString .="		//end Dilemma]";
		
		return $returnString;
	
	}
	
}