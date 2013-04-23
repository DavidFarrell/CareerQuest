<?php

require_once("./utility/requires.php");

$players = $GLOBALS['databaseUtility']->db_load_all_players();




?><form id="submit_feedback_form" action="submit_feedback.php" method="post">
<table>
	<tr>
    	<td>Choose Person:</td>
        <td>
        	<select name="player_id" >
            <?php
				foreach ($players as $index=>$player) {
			?>
              	<option value="<?php print $player->playerId;?>"><?php print $player->forename;?> <?php print $player->surname;?></option>
            <?php
			}
			?>
            </select>
        </td>
    </tr>
    <tr>
    	<td>Choose Game:</td>
        <td><input type="text" name="game_id" value="<?php print $game->gameId; ?>" /></td>
    </tr>
    <tr>
    	<td>Choose Turn:</td>
        <td><input type="text" name="game_turn" value="<?php print $game->gameTurn; ?>" /></td>
    </tr>
    <tr>
    	<td>Feedback Type:</td>
        <td>
        	<select name="feedback_type" >
              <option value="<?php print $GLOBALS['feedback_weekly'];?>">Weekly</option>
              <option value="<?php print $GLOBALS['feedback_dilemma'];?>">Dilemma</option>
              <option value="<?php print $GLOBALS['feedback_daily'];?>" selected>Daily</option>
              <option value="<?php print $GLOBALS['feedback_bev'];?>" >Bev</option>
            </select>
        </td>
    </tr>
    <tr>
    	<td>Feedback:</td>
        <td><textarea name="feedback_text" cols="30" rows="10"></textarea></td>
    </tr>
    <input type="hidden" value="" />
    <tr>
    	<td></td>
        <td><input type="submit" /></td>
    </tr>
    

</table>
<p>
<a href="home.php">home</a>

</form>