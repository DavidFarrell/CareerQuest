<?

require_once("./utility/requires.php");

	
$player_id = $_POST['player_id'];
$game_id = $_POST['game_id'];
$game_turn = $_POST['game_turn'];
$feedback_type = $_POST['feedback_type'];
$feedback_text = $_POST['feedback_text'];
	
	
$GLOBALS['databaseUtility']->db_save_feedback($player_id, $game_id, $game_turn, $feedback_type, $feedback_text);
		
header('Location: home.php');
?>