<?php

	require_once('../run.php');
	session_start();

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  	<meta charset="utf-8">
  	<title>Login</title>
    <link rel="stylesheet" type="text/css" href="../importer/css/bootstrap.min.css">
    <script src="../importer/js/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/login.css">
    <script type="text/javascript" src="js/password.js"></script>
  </head>

<body>
	<div class="login-box">
	  <h1><b>LOGIN</b></h1>
	 
	  <form method="POST" action="process/validate.php">

	  			<div class="textbox">
	  		 <?php
			  
		
				if (isset($_SESSION['result'])) 
				{
					alerts($_SESSION['result']);
					unset($_SESSION['result']);
				}
			 	
				
			  ?>

			   <i class="fas fa-user"></i>
			    <input type="text" placeholder="Username" name="username"  value="<?php if(isset($_COOKIE['username_remember'])) { echo $_COOKIE['username_remember']; } ?>"  id="username">
			   </div>

			  <div class="textbox">
			    <i class="fas fa-lock"></i>
			    <input type="password" placeholder="Password" name="password" value="<?php if(isset($_COOKIE['password_remember'])) { echo $_COOKIE['password_remember']; } ?>"  id="password">


			    <input type="hidden" name="url" value="<?php echo $_SESSION['req']; ?>">
			    <i style=" color: #90a4ae; font-size: 15px;
	  			float: right; position: absolute; opacity: 0.3; margin-left: -30px; margin-top: 3px; cursor:pointer" onclick="passwordShow()" id="show">
				show</i>
			  </div>

			  <div class="form-group" style="margin-top: 30px;">
			  	 <input type="checkbox" id="remember-me" name="remember" <?php if(isset($_COOKIE["username_remember"])) { ?> checked <?php } ?> /> 
			  	<label for="remember-me">Remember me</label>
			  </div>
			  
			  <a href="forgotpassword.php">Forgot Password</a>
		
			  <input type="submit" class="btn" name="submitlogin" value="SIGN IN">
		
	  </form>
	</div>
</body>
</html>

<script type="text/javascript">
	 $(`.close`).on('click',function()
      {
          $(`.alert`).hide("slow"); //ALERT HIDER

      })

	$('#username').keyup(function()
	{
		$('.close').fadeOut(500);
	});
</script>