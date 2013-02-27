<?php

require_once("./utility/requires.php");

$players = $GLOBALS['databaseUtility']->db_load_all_players();



$to      = 'davidfarrell81@gmail.com';
$subject = 'CareerQuest Player';
$message = 'This email is to confirm that you are registered to play CareerQuest under email address: ';
$headers = 'From: david.farrell@gcu.ac.uk' . "\r\n" .
    'Reply-To: david.farrell@gcu.ac.uk' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$users = 0;
foreach ($players as $key=>$player) {
	$users++;
	mail($player->email, $subject, $message . $player->email, $headers);	
}

print "Emailed $users players.";
?>