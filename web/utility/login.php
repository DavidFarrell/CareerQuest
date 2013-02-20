<?php

require_once("./utility/requires.php");


$player = new Player(1);
$avatar = new Avatar( $player->playerId );
$game = new ArrayObject();
$game->gameId = 0;
$game->gameTurn = 0;

$player->autonomySupport = 2;
?>