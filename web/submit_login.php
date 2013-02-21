<?
require_once("./utility/DatabaseUtility.php");
require_once("./utility/globals.php");
require_once("./utility/Player.php");
require_once("./utility/Avatar.php");
require_once("./utility/Activity.php");
require_once("./utility/DilemmaOption.php");
require_once("./utility/Dilemma.php");
	
$found = $GLOBALS['databaseUtility']->db_check_login($_POST);

if ($found == null ) {
	die ("You entered incorrect details.  <br>Use the back button to try again or contact David Farrell");
}

if (!isset($_SESSION['sessionStarted']) ) {
	session_start();
	$_SESSION['sessionStarted'] = true;
}

$player = new Player($found['player_id']);
$avatar = new Avatar( $player->playerId );
$game = new ArrayObject();
$game->gameId = 0;
$game->gameTurn = 0;
$_SESSION['player'] = null;
$_SESSION['avatar'] = null;
$_SESSION['game'] = null;

$_SESSION['player_id'] = $player->playerId;



header('Location: home.php');
?>