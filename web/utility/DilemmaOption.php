<?php

class DilemmaOption {
	
	public $dilemmaId;
	public $optionId;
	public $optionDescription;
	public $scoreWellness;
	public $scoreAwareness;
	public $scoreAbility;
	public $scoreProfessionalism;
	public $scoreWorkEthic;
	
	function __construct($option_array = "") {
		if ( !( $option_array == null) ) {
			$this->loadOption($option_array);	
		} else {
			die ("no array $option_array passed to new option");			
		}
	}
	
	function loadOption($option_array = "")  {
		if ($option_array == null) {
			die ("no array passed to load option");		
		}
		
		$this->dilemmaId = $option_array['dilemma_id'];
		$this->optionId = $option_array['dilemma_option_id'];
		$this->optionDescription = $option_array['dilemma_option_description'];
		$this->scoreWellness = $option_array['score_wellness'];
		$this->scoreAwareness = $option_array['score_awareness'];
		$this->scoreAbility = $option_array['score_ability'];
		$this->scoreProfessionalism = $option_array['score_professionalism'];
		$this->scoreWorkEthic = $option_array['score_work_ethic'];
		
		
	}
	
	function __toString() {
		$returnString = "[Dilemma [".$this->dilemmaId."] - Option [".$this->optionId."]:\n";
		$returnString .= "	optionDescription=[".$this->optionDescription."]\n";
		$returnString .= "	scoreWellness=[".$this->scoreWellness."]\n";
		$returnString .= "	scoreAwareness=[".$this->scoreAwareness."]\n";
		$returnString .= "	scoreAbility=[".$this->scoreAbility."]\n";
		$returnString .= "	scoreProfessionalism=[".$this->scoreProfessionalism."]\n";
		$returnString .= "	scoreWorkEthic=[".$this->scoreWorkEthic."]\n";
		
		$returnString .="		//end Dilemma Option]";
		
		return $returnString;
	
	}
	
}