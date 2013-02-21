<?php
?>
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
<title>Log In to Career Quest</title>
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
    	<p>Log In</p>
    </div>

  	
	
  </header>
  
  <article class="content">
    <section>
     <div class="content_area_bubble_wide">
     	<div class="content_area_activity_chooser">
        	<h1>Career Quest: Login Page</h1>&nbsp;<br>
        	<form id="login" action="submit_login.php" method="post">
            	<div class="fltlft" style="margin-left: 100px;">
                	<table>
                    	<tr>
                        	<td>Email:</td>
                            <td><input name="email" width="50">
                        </tr>
                        <tr>
                        	<td>Password:</td>
                            <td><input type="password" name="password" width="50"></td>
                        </tr>
                        <tr>
                        	<td></td>
                            <td><input type="submit">
                        </tr>
                    
                    </table>
                    <br>
                    <div >
                    	If you have any problems, contact David Farrell at: <br>&nbsp;<br>
                        <span style="margin-left:50px; padding-top:20px;">david.farrell@gcu.ac.uk</span><br >&nbsp;<br>
                        <span style="margin-left:50px; padding-top:20px;">@unthank</span><br>&nbsp;<br>
                        
                    </div>
                </div>
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
    
  </footer>
  <!-- end .container --></div>
</body>
</html>

<?php

	
?>