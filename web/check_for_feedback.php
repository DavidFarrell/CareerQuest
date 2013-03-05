<?php
require_once("./utility/requires.php");

$feedbacks = $GLOBALS['databaseUtility']->db_find_unacknowledged_feedback($player->playerId, $game->gameId, ($game->gameTurn-1)) ;
if (sizeof($feedbacks) > 0) {


?>

<!DOCTYPE HTML>
<html>
<head>
<script src="./utility/javascript_utils.js"> </script>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Feedback</title>
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
    	<p class="action_orange">Weekly Feedback on <?php print $avatar->avatarName;?>'s Employability.</p>
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
    <p><br></p>
     <div class="content_area_bubble_wide">
     	<div class="content_area_activity_chooser">
        	<h1>Feedback</h1>&nbsp;<br>
            	<div style="margin-left:20px;" >
                	This feedback is presented at the start of each new week only.  Make sure you pay attention! <br>&nbsp;<br>

                    <?php
					// loop around feedbacks
					foreach ($feedbacks as $index=>$feedback) {
					?>
                    <p>	
						<span class="action_orange"><?php print $GLOBALS['feedback_type'][$feedback->feedbackType] ;?></span><br>&nbsp;<br>
                        <?php
						if ( $feedback->feedbackType == $GLOBALS['feedback_bev']) {?>
							<img src="../avatars/bev.png" width="75" class="fltlft">
				  <?php }
						print $feedback->feedbackText;
					?>
                    </p>
	                <?php
					}
					
					?>
                </div>
                <div class
        	<div id="error_message">
            	<!-- filled by JS -->
            </div>
        </div><!-- end div content area activity chooser -->
        <div class="content_area_activity_chooser">
            <div style="margin-left:20px;">
            <p>
                <a href="acknowledge_feedback.php"><span class="save_changes" style="float:left;">Click here once you've read your feedback.</span></a>
            </p>
            </div>
                
        </div>
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
die();
}
?>