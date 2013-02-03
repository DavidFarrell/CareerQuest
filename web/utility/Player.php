<?php

class Player {
	
	public $playerId;
	public $email;
	public $password;
	public $forename;
	public $surname;
	public $autonomy_support;
	public $relatedness_support;
	public $competencee_support;
	public $lab_time;
	public $notes;
	public $experiment_opt_out;
	public $game_id;
	public $time_created;
	
	function __construct() {
		
	}
	
	function loadPlayer($id) {
		$player_array = db_load_player($id);	
	}
	
}