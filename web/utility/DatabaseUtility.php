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
				$this->db_log("OpenConnection", "".$this->db);	
			}
		}
	}
	
	function db_disconnect(){
		$this->db_log("CloseConnection", "".$this->db);
		mysql_close($this->db);	
	}
	
	function db_log($type, $params) {
		print "DB:[".$this->db."]\n";
		if (!$this->db) {
			db_connect();
		}
		print "DB:[".$this->db."]\n";
		//$type = db_escape($type);
		//$params = db_escape($params);
		
		$sql="INSERT INTO game_log (event_type, event_params)
		VALUES
		('".$type."','".$params."')";
		
		if (!mysql_query($sql,$this->db))
		  {
		  die('Error: ' . mysql_error() . '<br>' . $sql . "<br>" . $this->db);
		  }
		echo "1 record added";
	}
	
	function db_load_player($id) {
		if(!$this->db) {
			db_connect();
		}
		
		db_log("LoadPlayer" , $id);
		$id = db_escape($id) ;
		
		$sql = "SELECT * FROM players where player_id = " . $id;
		$result = mysql_query($sql);
	
		if($row = mysql_fetch_array($result)) {
		  echo $row['forename'] . " " . $row['surname'];
		  return $row;
		} else die ("Could not retrieve person: " . mysql_error() . "<br>" . $sql);
	}
	
	function db_escape($var) {
		return $var;	
	}
}
?>