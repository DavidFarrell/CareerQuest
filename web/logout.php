<?php
require_once("./utility/requires.php");



$GLOBALS['databaseUtility']->db_log("Player_Logged_out", "p = " . $player->playerId, $player->playerId, $game->gameId);

session_start();
session_destroy();
?>
You have been logged out.  
Click <a href="home.php">here</a> to log back in again.
