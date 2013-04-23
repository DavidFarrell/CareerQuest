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
    	<p class="action_orange">There is no spoon.</p>
    </div>

  	
	
  </header>
  
  <article class="content">
    <section>
     <div class="content_area_bubble_wide">
     	<div class="content_area_activity_chooser">
        	<h1>Daily Option</h1>&nbsp;<br>
            	<div style="margin-left:20px;">
                	Easy Portfolios  <br style="line-height:2;">
                     You probably have heard that to get a job in the games industry, you need a portfoli.<br>&nbsp;<br>
                     But... you probably don't have one.  It takes time to build a great portfolio site.<br>&nbsp;<br>
                     However.  It does not take long to get started.<br>
                     Head over to  <a href="http://www.squarespace.com/twit">SquareSpace</a> and register a new site. In just 15 minutes, you can hava a basic, but functional portfolio website up.  If you don't have any content - still create one to hold your CV.<br>&nbsp;<br>
                     There is a 14 day free trial, but that's enough to get you thinking about your REAL portfolio site and you could always register another 14 day trial under a different name :)
                     
                   <br style="line-height:2;">
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
					   If you do this daily task, <?php print $avatar->avatarName; ?> will receive a boost to Ability <img src="../assets/ability_logo.png" width="26" height="26">.
						<!--
							+1 <img src="../assets/awareness_logo.png" width="26" height="26">
							+5 <img src="../assets/ability_logo.png" width="26" height="26">
							-2 <img src="../assets/professionalism_logo.png" width="26" height="26">
							-8 <img src="../assets/work_ethic_logo.png" width="26" height="26">
						-->
					<?php
					} else if ( $player->competenceSupport == $GLOBALS['competence_support']['high'] ) {
						?>
						If you do this daily task, <?php print $avatar->avatarName; ?> will receive +3 Ability <img src="../assets/ability_logo.png" width="26" height="26">.
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
                    	<a href="submit_daily_task.php?id=20130318_squarespace_3_ability"><span class="save_changes" style="float:left;">Click here if you did this.</span></a>
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