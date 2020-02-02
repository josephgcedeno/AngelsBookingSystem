

<?php

	require_once('../run.php');
	session_start();

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Forgot password</title>
    <link rel="stylesheet" href="css/login.css">
    <script type="text/javascript" src="js/password.js"></script>
  </head>
  <body>


<div class="login-box">
  <h1>Recover</h1>

 <?php 
		if (isset($_SESSION['userPassword'])) 
		{
		 	$passwordSplit=explode(' ',$_SESSION['userPassword']);
		 	if ($passwordSplit[0]=='passwordRecover') 
	 	   		{
	 	   			recoverPasswordSuccessfUlly($passwordSplit);
					session_destroy();
	 	   		}
		}
  		else if (isset($_POST['submittedUsername']) ||isset($_SESSION['result'])) 
 	    { 	

 	    	$account;
 	    	$getUsername;
 	   		if (!isset($_POST['username'])) 
 	   		{	
 	   			$getUsername=explode('-',$_SESSION['result']);
 	   	
 	   			$account=$gfdb->selectQuestionsByUsernameOrId('pm_account',$getUsername[0]);
 	   		}
 	   		else
 	   		{

 	   			$account=$gfdb->selectQuestionsByUsernameOrId('pm_account',$_POST['username']);
 	   		}
 	   		 	   		

 	   		if (empty($account[0]) &&  isset($_SESSION['result'])!='Answer does not match!') 
 	   		{
 	   			$_SESSION['searchUsername']="Username not found!";
 	   			header('location: forgotpassword.php');
 	   		}
 	   		else
 	   		{	


 	   			echo 'Hello '.$account[0][1].'!';

 	  	
 	   	?>
				  <form method="POST" action="process/recover.php">
				

				  			<input type="hidden" name="yourUsername" value="<?php echo $account[0][1]; ?>">
				  			<input type="hidden" name="yourPassword" value="<?php echo $account[0][2]; ?>">
				  			<div class="textbox">
				  					<?php	  	
						 	if (isset($_SESSION['result'])) 
						 	{
							actionAfterLogin($getUsername[1]);
							session_destroy();

		
							}	
		 	   			
		 	   		
			 	   		?>
						   	<h4>Q1.</h4><p><?php echo $account[0][4] ?></p> 
						    <input type="text" placeholder="Enter first answer" name="firstQuestion" id="username" required>
						    <input type="hidden" name="firstAnswer" 
						    value="<?php echo $account[0][7]; ?>" >
						   	</div>

						 	<div class="textbox">
							<h4>Q2.</h4><p><?php echo $account[0][5] ?></p> 
						    <input type="text" placeholder="Enter first answer" name="secondQuestion" required>
						    <input type="hidden" name="secondAnswer" 
						    value="<?php echo $account[0][8]; ?>" >
						   </div>

						 	<div class="textbox">
								<h4>Q3.</h4><p><?php echo $account[0][6] ?></p> 
						    <input type="text" placeholder="Enter first answer" name="thirdQuestion" required>
						    <input type="hidden" name="thirdAnswer" 
						    value="<?php echo $account[0][9]; ?>" >
						   </div>

						  <a href="forgotpassword.php">Back</a>
						  	
						 

						  <input type="submit" class="btn" name="submitRecovery" value="Submit">
					
				  </form>
   <?php 	} 
		} 
 	  else{ 
 	  	?>
		 	<form method="POST">
		 		  	<div class="textbox">
			 		  <?php
						if (isset($_SESSION['searchUsername'])) 
						{
							actionAfterLogin($_SESSION['searchUsername']);
							session_destroy();
						}
						
					  ?>
				   	<h4>Q1.</h4><p>Enter Username:</p> 
				    <input type="text" placeholder="Enter..." name="username" id="username"required>
		    		</div>
		    		<a href="login.php">Back</a>
		    		 <input type="submit" class="btn" name="submittedUsername" value="Submit">
		 	</form>

	 <?php } ?>

   
  </div>
  
  </body>
</html>

<script type="text/javascript">
	

	$('#username').keyup(function()
	{
		$('.alert').fadeOut(500);
	});
</script>