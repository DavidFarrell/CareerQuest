<?php

require_once("./utility/requires.php");


$dilemma = $GLOBALS['databaseUtility']->get_player_weekly_dilemmas( $player->playerId, $game->gameId, $game->gameTurn );
$dilemmaHasBeenDecided = false;
if ( $dilemma->dilemmaOptionChosen != null || $dilemma->playerOptionChosen !=null ) {
	$dilemmaHasBeenDecided = true;
}

?>
<!-- <?php print_r($dilemma); ?> -->
<!DOCTYPE HTML>
<html>
<head>
<script src="./utility/javascript_utils.js"> </script>
<script language="javascript">

function submitDilemmaOption(option_chosen) {
	document.getElementById('option_submitted').value=option_chosen;
	document.getElementById('dilemma_picker').submit();
}

</script>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Career Quest: Dilemma</title>
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
  
  <article class="content">
    <section>
     <div class="content_area_bubble_wide">
     	<div class="content_area_activity_chooser">
        	<form id="dilemma_picker" action="submit_dilemma_choice.php" method="post">
            <input type="hidden" name="option_submitted" value="" id="option_submitted"/> 
            <!-- PICK TASKS FOR NEXT FORTNIGHT -->
           <h1><?php print $GLOBALS["dilemmastrings"]["Title"][ ($player->autonomySupport)]; ?></h1>
            <h2><?php print ucwords($dilemma->dilemmaName); ?></h2>
            <div class="dilemma_area">
            	<?php
					print nl2br($dilemma->dilemmaDescription); 
				?>
                <br/>
                <div class="dilemma_options">
                	<?php
					if ($dilemmaHasBeenDecided) { ?>
                        <h2> You Picked: </h2>
                        <?php
						if ($dilemma->dilemmaOptionChosen != null) {
							$option = $dilemma->dilemmaOptions[$dilemma->dilemmaOptionChosen];
						} else if ($dilemma->playerOptionChosen) {
							$option = new ArrayObject();
							$option->optionDescription = $GLOBALS['databaseUtility']->get_player_submitted_dilemma_description($player->playerId, $game->gameId,$game->gameTurn, $dilemma->dilemmaId);
						} else {
							die("error: We think the dilemma is answered but no player option or dilemma option exists");
						}
						?>
                        <div class="dilemma_option_area">
								<content>
									<?php print ucfirst($option->optionDescription); ?>
                                	<br/>
                                    You will hear in due course how you have been scored.
                                </content>	
								
						</div>
					<?php 
					} // end display of previously chosen answer 
					else { ?> 
                    	<h2>Select One:</h2> 
						<?php
						foreach ($dilemma->dilemmaOptions as $optionId=>$option) {
					   
						?>
						
							<div class="dilemma_option_area">
								<content><?php print ucfirst($option->optionDescription); ?></content>	
								<h2 ><span class="save_changes"><a href="" onClick="submitDilemmaOption(<?php print $option->optionId; ?>);return false;">Choose</a></span></h2>
							</div>
						<?php
						}  // end foreach
						if ( ($player->autonomySupport == $higha) && ($player->competenceSupport == $higha) && ($player->relatednessSupport == $higha)) {
						?>
							<div class="dilemma_option_area">
								<content>                                         
									<textarea cols=60 rows=5 name="player_text" placeholder="<?php print $GLOBALS["dilemmastrings"]["placeholder"][$higha] ?>"></textarea>
								</content>	
								<h2 ><span class="save_changes"><a href="" onClick="submitDilemmaOption(<?php print $GLOBALS['player_choice_dilemma']; ?>);return false;">Choose</a></span></h2>
							</div>
						<?php	
						} else if ( ($player->autonomySupport == $higha) && ($player->competenceSupport == $higha) && ($player->relatednessSupport != $higha)) {
						?>
							<div class="dilemma_option_area">
								<content>                                         
									<textarea cols=60 rows=5 name="player_text" placeholder="<?php print $GLOBALS["dilemmastrings"]["placeholder"][$meda] ?>"></textarea>
								</content>	
								<h2 ><span class="save_changes"><a href="" onClick="submitDilemmaOption(<?php print $GLOBALS['player_choice_dilemma']; ?>); return false;">Choose</a></span></h2>
							</div>
						<?php	
						} // end if else for ARC high
					} // end else
					?>
                </div>
            </div><!-- end div dilemma picker -->
			</form>		
        	<div id="error_message">
            	<!-- filled by JS -->
            </div>
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
