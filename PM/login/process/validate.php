<?php
	
	require_once('../../run.php');
	session_start();



	if (isset($_POST['submitlogin'])) {
		$check=$gfdb->loginAccount('pm_account',array(
			"username"=>$_POST['username'],
			"password"=>$_POST['password']
			));
		
		if ($check!=0) 
		{
				$_SESSION['user']=$_POST['username'];
				header('location: ../../backend/home.php');
		}
		else
		{
				$_SESSION['result']="wrong credentials";
				header('location: ../login.php');
		}
			
	}
	
	


//On page 2



?>