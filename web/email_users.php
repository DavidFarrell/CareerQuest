<?php

require_once("./utility/requires.php");

$players = $GLOBALS['databaseUtility']->db_load_all_players();



$to      = 'davidfarrell81@gmail.com';
$subject = 'CareerQuest Player';
$message = 'Hi there,
This email is to let you know that all of the avatar changes have been added to the game.  Let me know if your avatar isn\'t correct.  

Don\'t forget that every day, there is a new daily thing you can do.  They won\'t ALL make you march about campus...

Also let me know if you have any other problems.  

Cheers,

David';
$headers = 'From: david.farrell@gcu.ac.uk' . "\r\n" .
    'Reply-To: david.farrell@gcu.ac.uk' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$users = 0;

foreach ($players as $key=>$player) {
	$users++;
	mail($player->email, $subject, $message, $headers);	
}

print "Emailed $users players.";
?>