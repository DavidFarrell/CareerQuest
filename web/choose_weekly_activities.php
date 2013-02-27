<?php

require_once("./utility/requires.php");


//css id "view_time_units" is current remaining TUs
// just now game turn id is hardcoded 

$weekly_activities = $GLOBALS['databaseUtility']->get_player_weekly_activities( $player->playerId, 0 );

$hasMadeChoices = false;
// if player has previously submitted options, reduce score.
foreach($weekly_activities as $key=>$currentActivity) {
	if ($currentActivity->activityChosen) {
		$avatar->weeklyTimeUnitsCurrent -= $currentActivity->activityCost;	
	}
}
if ( $avatar->weeklyTimeUnitsCurrent <= 0 ) {
	$hasMadeChoices = true;	
}


$GLOBALS['databaseUtility']->db_log("Player_Looked_At_Weeklies", "p = " . $player->playerId . "|Completed_choices = " . $hasMadeChoices, $player->playerId, $game->gameId);

?>

<!DOCTYPE HTML>
<html>
<head>
<script src="./utility/javascript_utils.js"> </script>
<script language="javascript">

var avatar = new Object();
avatar.weeklyTimeUnitsCurrent = <?php print $avatar->weeklyTimeUnitsCurrent; ?>;

var activities = new Array();
<?php 
foreach ($weekly_activities as $key=>$activity) {
?>

	var activity = new Object;
	activity.activityId = <?php print $activity->activityId; ?>;
	activity.activityCost = <?php print $activity->activityCost; ?>;
	activities[ activity.activityId ] = activity;
<?php
}
?>

function submitForm() {
	document.getElementById("activity_picker").submit();
	//dump(document.getElementById("activity_picker").action );
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Career Quest: Fortnightly Planner</title>
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
    	<p><?php print $GLOBALS["homestrings"]["Graduation"][ ($player->autonomySupport) ]; ?>: 8 Weeks</p>
    </div>

  	<div class="header_score">
		<?php print $avatar->scoreEmployability; ?>
        <a href="logout.php">
      	  <img src="../assets/employability_logo.png" width="52" height="52" alt="Employability">
        </a>
    </div>
	
  </header>
  
  <article class="content">
    <section>
     <div class="content_area_bubble_wide">
     	<div class="content_area_activity_chooser">
        	<form id="activity_picker" action="submit_weekly_activities.php" method="post">
           
            <!-- PICK TASKS FOR NEXT FORTNIGHT -->
           <h1><?php print $GLOBALS["weeklystrings"]["Title"][ ($player->autonomySupport)]; ?></h1>
            <!-- YOU HAVE 4 TIME UNITS -->
            <?php if (!$hasMadeChoices) {
			?>
            	<h2 style="float:left"><?php print $GLOBALS["weeklystrings"]["Instructions_beginning"][ ($player->autonomySupport)];?><section class='action_orange' id="time_units";><?php print $avatar->weeklyTimeUnitsCurrent;?></section><?php print $GLOBALS["weeklystrings"]["Instructions_end"][ ($player->autonomySupport)]; ?></h2>
            
	            <a href="" onclick="submitForm(); return false;"><h2 ><span class="save_changes">Save Choices</span></h2></a>
			<?php
			}
			?>	
        	<div id="error_message">
            	<!-- filled by JS -->
            </div>

			<!--	loop round each activity and offer to player   -->
			<?php
			foreach ($weekly_activities as $key=>$currentActivity) {
				?>
<div class="activity_option">
    <div class="activity_checkbox">
    	<br />
        &nbsp;&nbsp;<input type="checkbox" <?php  if ($hasMadeChoices) print 'disabled="true"'; ?> onchange='toggleWeeklyActivity(this);' name="<?php print $currentActivity->activityId; ?>" value="<?php print $currentActivity->activityId; ?>" 
		<?php if ($currentActivity->activityChosen) {
			print "checked";
		} else print ""; ?>/>	
        <br />
        <?php print $currentActivity->activityCost; ?> <img src="../assets/time_units.jpg" width="26">
    </div> <!-- end div activity checkbox -->
    
    <div class="activity_details">
    	<br />
        <h3 class="fltlft"><a href=""><?php print $currentActivity->activityName; ?></a></h3>  
        <!-- now choose the level of scoring detail baseed on competence support -->  
        <?php 
		if ($player->competenceSupport == $higha) {?>
			          
			<p class="fltrt" >
				<?php print $currentActivity->scoreWellness; ?> <img src="../assets/wellbeing_logo.png" width="39" height="39"> / 
				( <?php print $currentActivity->scoreAwareness; ?> <img src="../assets/awareness_logo.png" width="20" height="20">
				<?php print $currentActivity->scoreAbility; ?> <img src="../assets/ability_logo.png" width="20" height="20">
				<?php print $currentActivity->scoreProfessionalism; ?> <img src="../assets/professionalism_logo.png" width="20" height="20">
				<?php print $currentActivity->scoreWorkEthic; ?> <img src="../assets/work_ethic_logo.png" width="20" height="20"> ) = 
                 <span style="text-decoration:underline">
				 <?php print floor( ($currentActivity->scoreAwareness + $currentActivity->scoreAbility + $currentActivity->scoreProfessionalism + $currentActivity->scoreWorkEthic)/4 ); ?> <img src="../assets/employability_logo.png" width="39" height="39">
                 </span>
			</p><br />
		<?php
        } else if ($player->competenceSupport == $meda) {?>
			          
			<p class="fltrt" >
				+1 <img src="../assets/wellbeing_logo.png" width="26" height="26"> / 
                <?php print floor( ($currentActivity->scoreAwareness + $currentActivity->scoreAbility + $currentActivity->scoreProfessionalism + $currentActivity->scoreWorkEthic)/4 ); ?> <img src="../assets/employability_logo.png" width="26" height="26">
			</p><br />
		<?php
        }
		?>
        <p class="fltlft">
            <?php print ucfirst($currentActivity->activityDescription); ?><br/>
            
            
            	<?php 
				// only high competence feedbackers get the nitty gritty
				if ($player->competenceSupport == $higha) {
					print "<br>".ucfirst($currentActivity->activityDetails); 
				}
				?>
        	
        </p>
    </div><!-- end div activity details -->
    
</div><!-- end div activity option -->
				<?
				// end foreach weekly activities loop
			} 
			?>
            </form>
        </div><!-- end div content area activity chooser -->
     </div><!-- end div content area bubble wide -->
    </section>
  <!-- end .content -->
  </article><!-- end article class content -->
  
  
  
  <footer>
    
    <div class="footer_bubble">
    	<h1 class="fltlft" style="padding: 0 0 0 15px;">My Goal:</h1>   
        <p class="fltlft" style="padding: 4px 0;">
        	Haven't thought about my goal!
        </p><br class="clearfloat">
        <h1 class="fltlft" style="padding: 0 0 0 15px;">Feedback:</h1>   
        <p class="fltlft" >Feedback will appear here in due course.
        <!--
        	+1 <img src="../assets/awareness_logo.png" width="26" height="26">
            +5 <img src="../assets/ability_logo.png" width="26" height="26">
            -2 <img src="../assets/professionalism_logo.png" width="26" height="26">
            -8 <img src="../assets/work_ethic_logo.png" width="26" height="26">
        -->
        </p><br/>
    </div>
    
  </footer>
  <!-- end .container --></div>
</body>
</html>
