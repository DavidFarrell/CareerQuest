<?php

require_once("./utility/requires.php");

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
    	<p>Graduation: 8 Weeks</p>
    </div>

  	<div class="header_score">
		8
        <img src="../assets/employability_logo.png" width="52" height="52" alt="Employability">
    </div>
	
  </header>
  
  
  <div class="sidebar_bubble" style="height:320px;">
      <div class="sidebar">
        <div class="avatar_sidebar" >
            <a href=""><img src="../avatars/dfavatar.png" width="73" height="73" id="avatar_image"></a>
           <br/>Unthank
           <br>Level 1: Jobseeker
        </div>
      
        <div class="sidebar_scores" id="employability_score">
        	<a href="">
                Employability: 8
                <img src="../assets/employability_logo.png" width="26" height="26"><br/>
			</a>
            <a href="">
                Wellbeing: 5
                <img src="../assets/wellbeing_logo.png" width="26" height="26">
			</a>        	
            <a href="">
                Awareness: 4
                <img src="../assets/awareness_logo.png" width="26" height="26"><br/>
        	</a>
            <a href="">
                Ability: 6
                <img src="../assets/ability_logo.png" width="26" height="26"><br/>
        	</a>
			<a href="">
                Professionalism: 8
                <img src="../assets/professionalism_logo.png" width="26" height="26"><br/>
        	</a>
			<a href="">
                Work Ethic: 4
                <img src="../assets/work_ethic_logo.png" width="26" height="26">
        	</a>
        </div>
      </div>
   </div>
  
  <article class="content">
    <section>
     <div class="content_area_bubble" style="height:300px;">
     	<div class="content_area_activity_chooser">
        	<h1>Weekly Options</h1>
            <H2>How would you like to act over the next fortnight?</H2>
            <ul>
            	<li><a href="">Plan my week <img src="../assets/plan_my_week_logo.png" width="51" height="52"></a></li>
                <li><a href="">Dilemma! <img src="../assets/dilemma_logo.png" width="52" height="52"></li></a>
            </ul>
        </div>
        <div class="content_area_activity_chooser">
        	<h1>Daily Options</h1>
            <H2>Check in daily for extra events.</H2>
            <ul>
            	<li><a href="">Daily Activity <img src="../assets/plan_my_day_logo.png" width="51" height="51"></a></li>
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
        	To get a trainee job at a game development company.
        </p><br class="clearfloat">
        <h1 class="fltlft" style="padding: 0 0 0 15px;">Feedback:</h1>   
        <p class="fltlft" >
        	+1 <img src="../assets/awareness_logo.png" width="26" height="26">
            +5 <img src="../assets/ability_logo.png" width="26" height="26">
            -2 <img src="../assets/professionalism_logo.png" width="26" height="26">
            -8 <img src="../assets/work_ethic_logo.png" width="26" height="26">
        </p><br/>
    </div>
    
  </footer>
  <!-- end .container --></div>
</body>
</html>
