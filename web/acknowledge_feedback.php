<?php
require_once("./utility/requires.php");

$GLOBALS['databaseUtility']->acknowledged_feedback($player->playerId, $game->gameId, ($game->gameTurn-1)) ;

header('Location: home.php');
?>