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
    	<p class="action_orange">Working 9-5 (it's a fulltime job lookign for work!).</p>
    </div>

  	
	
  </header>
  
  <article class="content">
    <section>
     <div class="content_area_bubble_wide">
     	<div class="content_area_activity_chooser">
        	<h1>Daily Option</h1>&nbsp;<br>
            	<div style="margin-left:20px;">
                	This task is about boosting Whuffie as well as helping your skills and profile.<br>&nbsp;<br>

                    <span class="action_orange">The Quest: You are not here merely to make a living...</span><br>&nbsp;<br>
                    How can you differentiate yourself from all the other hundreds of candidates <strong>and</strong> help make a difference?<br>
                    <span class="action_orange">Voluntary work!</span> <br>&nbsp;<br>
                    Co-curricular activities are an excellent way to develop your transferrable skills, they build up your network (one of the most powerful ways of improving your career) and provide <i>evidence</i> of your skills that you can use to support an application.<br>&nbsp;<br>
                    Your mission, should you choose to accept it, is to head over to <a href="http://www.it4communities.org.uk">it4communities.org.uk</a> to learn about how you could use your skills to help others and boost your CV.  
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
					   If you do this daily task, <?php print $avatar->avatarName; ?> will receive a boost to Emplyability <img src="../assets/employability_logo.png" width="26" height="26" style="padding-left: 0px;">.
						<!--
							+1 <img src="../assets/awareness_logo.png" width="26" height="26">
							+5 <img src="../assets/ability_logo.png" width="26" height="26">
							-2 <img src="../assets/professionalism_logo.png" width="26" height="26">
							-8 <img src="../assets/work_ethic_logo.png" width="26" height="26">
						-->
					<?php
					} else if ( $player->competenceSupport == $GLOBALS['competence_support']['high'] ) {
						?>
						If you do this daily task, <?php print $avatar->avatarName; ?> will receive a +3 boost to Work Ethic <img src="../assets/work_ethic_logo.png" width="26" height="26" style="padding-left: 0px;"> and a +2 boost to Ability <img src="../assets/ability_logo.png" width="26" height="26" style="padding-left: 0px;">.
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
                    	<a href="submit_daily_task.php?id=20130306"><span class="save_changes" style="float:left;">Click here if you did this.</span></a>
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