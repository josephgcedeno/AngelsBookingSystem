<?php
	
	require_once('../../run.php');
	session_start();



	if (isset($_POST['submitRecovery'])) {


		$firstQuestion=$_POST['firstQuestion'];
		$secondQuestion=$_POST['secondQuestion'];
		$thirdQuestion=$_POST['thirdQuestion'];
		$firstAnswer=$_POST['firstAnswer'];
		$secondAnswer=$_POST['secondAnswer'];
		$thirdAnswer=$_POST['thirdAnswer'];

			
		if ($firstQuestion==$firstAnswer && $secondQuestion==$secondAnswer && $thirdQuestion ==$thirdAnswer) 
		{
				$_SESSION['userPassword']='passwordRecover '.$_POST['yourUsername'].' '.$_POST['yourPassword'];
				header('location: ../forgotpassword.php');
		}
	
		if ($firstQuestion!=$firstAnswer || $secondQuestion!=$secondAnswer || $thirdQuestion !=$thirdAnswer) 
		{
				$_SESSION['result']= $_POST['yourUsername']."-Answer does not match!";
				header('location: ../forgotpassword.php');
		}
			
	}
	
	


//On page 2



?>