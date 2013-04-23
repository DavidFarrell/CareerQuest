<?php

require_once("./utility/requires.php");



$GLOBALS['databaseUtility']->db_log("Player_Looked_At_Daily_Option", "p = " . $player->playerId, $player->playerId, $game->gameId);

?>
<!DOCTYPE HTML>
<html>
<head>
<script src="./utility/javascript_utils.js"> </script>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Daily Option!</title>
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js">
        </script>
    <![endif]-->
<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="container">
  <header>
  	<div id="logo" class="fltlft">
        <a href="home.php">
            <img 
                src="../assets/career_quest_logo.png" 
                width="299" height="73" alt="Career Quest Logo"  
                id="Insert_logo" class="fltlft"
            />
        </a>
    </div>
    <div class="graduation">
    	<p class="action_orange">Meet and Greet.</p>
    </div>

  	
	
  </header>
  
  <article class="content">
    <section>
     <div class="content_area_bubble_wide">
     	<div class="content_area_activity_chooser">
        	<h1>Daily Option</h1>&nbsp;<br>
            	<div style="margin-left:20px;">
                	There is a talk TODAY by one of Scotland's oldest and most successful game companies: <a href="http://www.denki.co.uk//">Denki!</a>.
                   <br style="line-height:2;">
                  The talk, by Ex-GCU student, Scottish Game Jam organisor and current Denki Player Champion, Romana Kahn-Ramzen  will be talking about how to break into the industry TODAY (Tuesday 12th) at 12 noon in C001.  
                    <p>&nbsp;<br></p>
                    
                    <span class="action_orange">Rewards</span>&nbsp;<br>
                    
                    <?php if ( $player->competenceSupport == $GLOBALS['competence_support']['low'] ) {
						?>
						If you do this daily task, <?php print $avatar->avatarName; ?> will receive a boost.
						<!--
							+1 <img src="../assets/awareness_logo.png" width="26" height="26">
							+5 <img src="../assets/ability_logo.png" width="26" height="26">
							-2 <img src="../assets/professionalism_logo.png" width="26" height="26">
							-8 <img src="../assets/work_ethic_logo.png" width="26" height="26">
						-->
					<?php
					} else if ($player->competenceSupport == $GLOBALS['competence_support']['medium'] ) {
						?>
					   If you do this daily task, <?php print $avatar->avatarName; ?> will receive a boost to Awareness <img src="../assets/awareness_logo.png" width="26" height="26" style="padding-left: 0px;">.
						<!--
							+1 <img src="../assets/awareness_logo.png" width="26" height="26">
							+5 <img src="../assets/ability_logo.png" width="26" height="26">
							-2 <img src="../assets/professionalism_logo.png" width="26" height="26">
							-8 <img src="../assets/work_ethic_logo.png" width="26" height="26">
						-->
					<?php
					} else if ( $player->competenceSupport == $GLOBALS['competence_support']['high'] ) {
						?>
						If you do this daily task, <?php print $avatar->avatarName; ?> will receive a +5 boost to Awareness <img src="../assets/awareness_logo.png" width="26" height="26" style="padding-left: 0px;"> .
						<!--
							+1 <img src="../assets/awareness_logo.png" width="26" height="26">
							+5 <img src="../assets/ability_logo.png" width="26" height="26">
							-2 <img src="../assets/professionalism_logo.png" width="26" height="26">
							-8 <img src="../assets/work_ethic_logo.png" width="26" height="26">
						-->
					<?php
					} 
					?>
					<p>
                    	<br>&nbsp;<br>
                    	<a href="submit_daily_task.php?id=20130312_mana"><span class="save_changes" style="float:left;">Click here if you did this.</span></a>
                    </p>			
                </div>
                
            
        	<div id="error_message">
            	<!-- filled by JS -->
            </div>
        </div><!-- end div content area activity chooser -->
     </div><!-- end div content area bubble wide -->
    </section>
  <!-- end .content -->
  </article><!-- end article class content -->
  
  
  
  <footer>
    
  </footer>
  <!-- end .container --></div>
</body>
</html>

<?php

	
?>