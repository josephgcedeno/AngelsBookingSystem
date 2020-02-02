<?php

	require_once('../run.php');
	session_start();

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <script type="text/javascript" src="js/password.js"></script>
  </head>
  <body>
<div class="login-box">
  <h1>Login</h1>

 
  <form method="POST" action="process/validate.php">

  			<div class="textbox">
  		 <?php
		  
		
			if (isset($_SESSION['result'])) 
			{
				actionAfterLogin($_SESSION['result']);
				session_destroy();
			}
		 	
			
		  ?>

		   <i class="fas fa-user"></i>
		    <input type="text" placeholder="Username" name="username" id="username">
		   </div>

		  <div class="textbox">
		    <i class="fas fa-lock"></i>
		    <input type="password" placeholder="Password" name="password" id="password">
		    <i style=" font-size: 15px;
  			float: right; position: absolute; opacity: 0.3; margin-left: -30px; margin-top: 3px; cursor:pointer" onclick="passwordShow()" id="show">
			show</i>
		  </div>

		  	<a href="forgotpassword.php">Forgot Password</a>
	
		 

		  <input type="submit" class="btn" name="submitlogin" value="Sign in">
	
  </form>
   
  </div>
  
  </body>
</html>

<script type="text/javascript">
	

	$('#username').keyup(function()
	{
		$('.alert').fadeOut(500);
	});
</script>