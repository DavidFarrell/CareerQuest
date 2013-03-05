<?php
require_once("./utility/requires.php");
// if logged in but not acknowledged feedback, redirect
require_once("./check_for_feedback.php");


$GLOBALS['databaseUtility']->db_log("Player_Looked_At_Home_Screen", "p = " . $player->playerId, $player->playerId, $game->gameId);

$last_week_scores = $GLOBALS['databaseUtility']->db_get_last_week_scores($player->playerId, $game->gameId, $game->gameTurn);

$employabilityLastWeek = floor( ($last_week_scores[$GLOBALS['scoretype_awareness']] + 
								 $last_week_scores[$GLOBALS['scoretype_ability']] + 
								 $last_week_scores[$GLOBALS['scoretype_professionalism']] + 
								 $last_week_scores[$GLOBALS['scoretype_work_ethic']]) / 4); 

?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Career Quest Hub</title>
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js">
        </script>
    <![endif]-->
<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="container">
<?php if ($GLOBALS['debug']) {?>
    <span class="error_red">
		<!--Feedback: <?php print_r ($_SESSION);    ?> -->
    </span>
<?php
}
?>  <header>
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
    	<p><?php print $GLOBALS["homestrings"]["Graduation"][ ($player->autonomySupport) ]; ?>: 8 Weeks.</p>
    </div>

  	<div class="header_score">
		<?php print $avatar->scoreEmployability; ?>
         <a href="logout.php">
      	  <img src="../assets/employability_logo.png" width="52" height="52" alt="Employability">
          </a>
    </div>
	
  </header>
  
  
  <div class="sidebar_bubble" style="height:340px;">
      <div class="sidebar">
        <div class="avatar_sidebar" >
            <a href=""><img src="../avatars/<?php print $avatar->avatarImageURL; ?>" width="73" height="73" id="avatar_image"></a>
           <br/><?php print htmlspecialchars($avatar->avatarName); ?>
           <br>Level 1: Jobseeker
        </div>
      
        <div class="sidebar_scores" id="employability_score">
        	 <a href="">
                Wellbeing: <?php print $avatar->scoreWellbeing; ?>
                <img src="../assets/wellbeing_logo.png" width="39" height="39">
			</a>        	
           <a href="">
                Employability: <?php print $avatar->scoreEmployability; ?>
                <img src="../assets/employability_logo.png" width="39" height="39"><br/>
			</a>
            <?php
			if ( $player->competenceSupport >= $meda ) {
				?>
				<a href="">
					Awareness: <?php print $avatar->scoreAwareness; ?>
					<img src="../assets/awareness_logo.png" width="26" height="26"><br/>
				</a>
				<a href="">
					Ability: <?php print $avatar->scoreAbility; ?>
					<img src="../assets/ability_logo.png" width="26" height="26"><br/>
				</a>
				<a href="">
					Professionalism: <?php print $avatar->scoreProfessionalism; ?>
					<img src="../assets/professionalism_logo.png" width="26" height="26"><br/>
				</a>
				<a href="">
					Work Ethic: <?php print $avatar->scoreWorkEthic; ?>
					<img src="../assets/work_ethic_logo.png" width="26" height="26">
				</a>
			<?php
			}
			?>
        </div>
      </div>
   </div>
  
  <article class="content">
    <section>
     <div class="content_area_bubble" style="height:320px;">
     	<div class="content_area_activity_chooser">
      	 	<h1><?php print $GLOBALS["homestrings"]["Weekly Options"][ ($player->autonomySupport)]; ?></h1>
            <H2><?php print $GLOBALS["homestrings"]["weekly_prompt"][ ($player->autonomySupport)]; ?></H2>
            <ul> 
            	<!-- Plan your week -->
     			<li><a href="choose_weekly_activities.php"><?php print $GLOBALS["homestrings"]["plan_activities"][ ($player->autonomySupport)]; ?> <img src="../assets/plan_my_week_logo.png" width="51" height="52"></a></li>
                <!-- Dilemma! -->
     			<li><a href="answer_dilemma.php"><?php print $GLOBALS["homestrings"]["plan_dilemmas"][ ($player->autonomySupport)]; ?> <img src="../assets/dilemma_logo.png" width="52" height="52"></li></a>
            </ul>
        </div>
        <div class="content_area_activity_chooser">
        	<h1><?php print $GLOBALS["homestrings"]["Daily_Options"][ ($player->autonomySupport)]; ?></h1>
            <H2><?php print $GLOBALS["homestrings"]["daily_prompt"][ ($player->autonomySupport)]; ?></H2>
            <ul>
            	<li><a href="daily20130304.php"><?php print $GLOBALS["homestrings"]["plan_day"][ ($player->autonomySupport)]; ?> <img src="../assets/plan_my_day_logo.png" width="51" height="51"></a></li>
            </ul>
        </div>
     </div>
    </section>
  <!-- end .content -->
  </article>
  
  
  
  <footer>
    
    <div class="footer_bubble">
    	<h1 class="fltlft" style="padding: 0 0 0 15px;">My Goal:</h1>   
        <p class="fltlft" style="padding: 4px 0;">
        	<?php
				print ucfirst(nl2br(htmlspecialchars($player->goal)));				
			?>
        </p><br class="clearfloat">
        <h1 class="fltlft" style="padding: 0 0 0 15px;">Feedback:</h1>   
        <p class="fltlft" >
        <?php if ( $player->competenceSupport == $GLOBALS['competence_support']['low'] ) {
			?>
            This was a rough week for <?php print $avatar->avatarName; ?>.<br>
            Over the last week, your score changed by this amount: 
             <?php 
			 	if ( ($avatar->scoreWellbeing - $last_week_scores[$GLOBALS['scoretype_wellbeing']]  ) > 0) {
					print "+";
				}
			 	print ($avatar->scoreWellbeing - $last_week_scores[$GLOBALS['scoretype_wellbeing']]  ) ; 
			?> <img src="../assets/wellbeing_logo.png" width="26" height="26">
              <?php
			  	 if ( ($avatar->scoreEmployability - $employabilityLastWeek) > 0) {
					print "+";
				}
			     print ($avatar->scoreEmployability - $employabilityLastWeek);
			  ?> <img src="../assets/employability_logo.png" width="26" height="26"><br>
             This puts <?php print $avatar->avatarName; ?> in the bottom third of the class.<br>
             If <?php print $avatar->avatarName; ?> wants a job at the end of term, things have to change.
            <!--
                +1 <img src="../assets/awareness_logo.png" width="26" height="26">
                +5 <img src="../assets/ability_logo.png" width="26" height="26">
                -2 <img src="../assets/professionalism_logo.png" width="26" height="26">
                -8 <img src="../assets/work_ethic_logo.png" width="26" height="26">
            -->
        <?php
		} else if ($player->competenceSupport == $GLOBALS['competence_support']['medium'] ) {
			?>
           Over the last week, <?php print $avatar->avatarName; ?>'s score changed by: 
             <?php 
			 	if ( ($avatar->scoreWellbeing - $last_week_scores[$GLOBALS['scoretype_wellbeing']]  ) > 0) {
					print "+";
				}
			 	print ($avatar->scoreWellbeing - $last_week_scores[$GLOBALS['scoretype_wellbeing']]  ) ; 
			?> <img src="../assets/wellbeing_logo.png" width="26" height="26">
              <?php
			  	 if ( ($avatar->scoreEmployability - $employabilityLastWeek) > 0) {
					print "+";
				}
			     print ($avatar->scoreEmployability - $employabilityLastWeek);
			  ?> <img src="../assets/employability_logo.png" width="26" height="26"><br>
            <!--
                +1 <img src="../assets/awareness_logo.png" width="26" height="26">
                +5 <img src="../assets/ability_logo.png" width="26" height="26">
                -2 <img src="../assets/professionalism_logo.png" width="26" height="26">
                -8 <img src="../assets/work_ethic_logo.png" width="26" height="26">
            -->
        <?php
		} else if ( $player->competenceSupport == $GLOBALS['competence_support']['high'] ) {
			?>
            Compared to other players, <?php print $avatar->avatarName; ?> did well this week. <br>&nbsp;<br>
            Wellbeing 
             <?php 
			 	if ( ($avatar->scoreWellbeing - $last_week_scores[$GLOBALS['scoretype_wellbeing']]  ) > 0) {
					print "+";
				}
			 	print ($avatar->scoreWellbeing - $last_week_scores[$GLOBALS['scoretype_wellbeing']]  ) ; 
			?> <img src="../assets/wellbeing_logo.png" width="26" height="26">
             Employability 
             
              <?php
			  	 if ( ($avatar->scoreEmployability - $employabilityLastWeek) > 0) {
					print "+";
				}
			     print ($avatar->scoreEmployability - $employabilityLastWeek);
			  ?> <img src="../assets/employability_logo.png" width="26" height="26"><br>&nbsp;<br>
              The individual Employability Attributes (each 1/4 Employability)<br>&nbsp;<br>
            
                <?php 
			 	if ( ($avatar->scoreAwareness - $last_week_scores[$GLOBALS['scoretype_awareness']]  ) > 0) {
					print "+";
				} 
			 	print ($avatar->scoreAwareness - $last_week_scores[$GLOBALS['scoretype_awareness']]  ) ; 
			?> <img src="../assets/awareness_logo.png" width="26" height="26">
                <?php 
			 	if ( ($avatar->scoreAbility - $last_week_scores[$GLOBALS['scoretype_ability']]  ) > 0) {
					print "+";
				} 
			 	print ($avatar->scoreAbility - $last_week_scores[$GLOBALS['scoretype_ability']]  ) ; 
			?> <img src="../assets/ability_logo.png" width="26" height="26">
                <?php 
			 	if ( ($avatar->scoreProfessionalism - $last_week_scores[$GLOBALS['scoretype_professionalism']]  ) > 0) {
					print "+";
				} 
			 	print ($avatar->scoreProfessionalism - $last_week_scores[$GLOBALS['scoretype_professionalism']]  ) ; 
			?> <img src="../assets/professionalism_logo.png" width="26" height="26">
                 <?php 
			 	if ( ($avatar->scoreWorkEthic - $last_week_scores[$GLOBALS['scoretype_work_ethic']]  ) > 0) {
					print "+";
				} 
			 	print ($avatar->scoreWorkEthic - $last_week_scores[$GLOBALS['scoretype_work_ethic']]  ) ; 
			?> <img src="../assets/work_ethic_logo.png" width="26" height="26">
           
        <?php
		} 
		?>
       
        <span class="error_red">
			<?php if ( isset($_GET["message"]) ) {
				?>  <br>&nbsp;<br>
                <?php
                print $_GET["message"];
            }
            
            ?>
        </span>
        </p><br/>
    </div>
    
  </footer>
  <!-- end .container --></div>
</body>
</html>
<?php
//tidyUp();
?>