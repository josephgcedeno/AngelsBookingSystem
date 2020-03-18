

<?php

	require_once('../run.php');
	session_start();

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Forgot password</title>
    <link rel="stylesheet" type="text/css" href="../importer/css/bootstrap.min.css">
    <script src="../importer/js/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
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
					unset($_SESSION['userPassword']);
	 	   		}
		}
  		else if (isset($_POST['submittedUsername']) ||isset($_SESSION['result'])) 
 	    { 	

 	    	$account;
 	    	$getUsername;
 	   		if (!isset($_POST['username'])) 
 	   		{	
 	   			$getUsername=explode('-',$_SESSION['result']);
 	   	
 	   			$account=$gfdb->selectQuestionsByUsernameOrId2(" 
 	   				 SELECT
					 c.id,c.username,c.password, b.pm_account_q1,b.pm_account_q2,b.pm_account_q3,
					 b.pm_account_a1,b.pm_account_a2,b.pm_account_a3
					 FROM  pm_account c
					 INNER JOIN pm_account_qna b ON c.id=b.pm_account_id
					 WHERE c.username='$getUsername[0]'");
 	   
 	   		}
 	   		else
 	   		{	
 	   			$usernameRecieve=$_POST['username'];

 	   			$account=$gfdb->selectQuestionsByUsernameOrId2(" 
 	   				 SELECT
					 c.id,c.username,c.password, b.pm_account_q1,b.pm_account_q2,b.pm_account_q3,
					 b.pm_account_a1,b.pm_account_a2,b.pm_account_a3
					 FROM  pm_account c
					 INNER JOIN pm_account_qna b ON c.id=b.pm_account_id
					 WHERE c.username='$usernameRecieve'");

 	   		}
 	   		 	   		

 	   		if (empty($account[0]) &&  isset($_SESSION['result'])!='Answer does not match!') 
 	   		{
 	   			$_SESSION['searchUsername']="danger-Username not found!";
 	   			header('location: forgotpassword.php');
 	   		}
 	   		else
 	   		{	


 	   			

 	  	
 	   	?>
				  <form method="POST" action="process/recover.php">
				
<!-- echo 'Hello '.$account[0][1].'!'; -->
				  			<input type="hidden" name="yourUsername" value="<?php echo $account[0][1]; ?>">
				  			<input type="hidden" name="yourPassword" value="<?php echo $account[0][2]; ?>">
				  			<div class="textbox">
				  					<?php	  	
						 	if (isset($_SESSION['result'])) 
						 	{
							alerts('danger-'.$getUsername[1]);
							session_destroy();

		
							}	
		 	   			
		 	   		
			 	   		?>
						   	<h4>Q1.</h4><p><?php echo $account[0][3] ?></p> 
						    <input type="text" placeholder="Enter first answer" name="firstQuestion" id="username" required>
						    <input type="hidden" name="firstAnswer" 
						    value="<?php echo $account[0][6]; ?>" >
						   	</div>

						 	<div class="textbox">
							<h4>Q2.</h4><p><?php echo $account[0][4] ?></p> 
						    <input type="text" placeholder="Enter first answer" name="secondQuestion" required>
						    <input type="hidden" name="secondAnswer" 
						    value="<?php echo $account[0][7]; ?>" >
						   </div>

						 	<div class="textbox">
								<h4>Q3.</h4><p><?php echo $account[0][5] ?></p> 
						    <input type="text" placeholder="Enter first answer" name="thirdQuestion" required>
						    <input type="hidden" name="thirdAnswer" 
						    value="<?php echo $account[0][8]; ?>" >
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
							alerts($_SESSION['searchUsername']);
							unset($_SESSION['searchUsername']);
						}
						
					  ?>
					<p>Enter Username:</p> 
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
	 $(`.close`).on('click',function()
      {
          $(`.alert`).hide("slow"); //ALERT HIDER

      })

	$('#username').keyup(function()
	{
		$('.alert').fadeOut(500);
	});
</script>



<!-- 



 SELECT
 c.id,c.username,c.password,
 b.pm_account_q1,b.pm_account_q2,b.pm_account_q3,b.pm_account_a1,b.pm_account_a2,b.pm_account_a3
 FROM  pm_account c
 INNER JOIN pm_account_qna b ON c.id=b.pm_account_id
 -->