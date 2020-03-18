<?php
	
	require_once('../../run.php');
	session_start();



	if (isset($_POST['submitlogin'])) {
		$username=$_POST['username'];
		$password=$_POST['password'];

		$check=$gfdb->loginAccount2(
			"
				SELECT id
				FROM pm_account 
				WHERE 
				username='$username' AND password='$password' AND type='admin'
			"
			);

		$separte=explode('-', $check );
		var_dump($separte);
		if ($separte[0]!=0) 
		{
				$_SESSION['user']=$_POST['username'];
				$_SESSION['userpasssword']=$_POST['password'];

				if (!empty($_POST['remember'])) 
				{
					
					    setcookie ("username_remember",$_POST['username'],time()+ (10 * 365 * 24 * 60 * 60),'/');  
		   				setcookie ("password_remember",$_POST['password'],time()+ (10 * 365 * 24 * 60 * 60),'/');

				}
				else
				{
				
					if(isset($_COOKIE["username_remember"]))   
				    {  
				     setcookie ("username_remember",'',time()+ (10 * 365 * 24 * 60 * 60),'/');  
				    }  
				    if(isset($_COOKIE["password_remember"]))   
				    {  
				     setcookie ("password_remember",'',time()+ (10 * 365 * 24 * 60 * 60),'/');  
				    }  
				}

				if (empty($_POST['url'])) 
				{
					header('location: ../../backend/home.php');
				}
				else
				{	
					$direct= explode('/backend/', $_POST['url']);
					header('location:../../backend/'.$direct[1]);
					
					
				}	

		}
		else
		{
				$_SESSION['result']="danger-Incorrect input!";
				header('location: ../login.php');
		}
			
	}
	
	


//On page 2



?>