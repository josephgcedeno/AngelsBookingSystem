<?php
	
	require_once('../import/connectdb.php');
	session_start();

	header('location:../login.php');	
	$name=$_POST['username'];
	$pass=$_POST['password'];
	$dbTable = new connectdb('root','','inventory');


	$num=$dbTable->checkAccountIfExist('account',$name);
	if ($num>0) 
	{
		echo "Account already Exist";
		
	}
	else
	{
		$dbTable->insertData('account',array("username"=>$name,"password"=>$pass));
		echo "Account successfully added";
	}



?>