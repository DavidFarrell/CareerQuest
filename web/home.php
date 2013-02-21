<?php
require_once("./utility/requires.php");

//$player = new Player($player->playerId);

?>

<!DOCTYPE HTML>
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
        <img src="../assets/employability_logo.png" width="52" height="52" alt="Employability">
    </div>
	
  </header>
  
  
  <div class="sidebar_bubble" style="height:340px;">
      <div class="sidebar">
        <div class="avatar_sidebar" >
            <a href=""><img src="../avatars/dfavatar.png" width="73" height="73" id="avatar_image"></a>
           <br/><?php print $avatar->avatarName; ?>
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
            	<li><a href="daily1.php"><?php print $GLOBALS["homestrings"]["plan_day"][ ($player->autonomySupport)]; ?> <img src="../assets/plan_my_day_logo.png" width="51" height="51"></a></li>
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
<?php
//tidyUp();
?>