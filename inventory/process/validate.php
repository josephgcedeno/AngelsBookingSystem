<?php

	require_once('../import/connectdb.php');

	session_start();
	$name=$_POST['username'];
	$pass=$_POST['password'];
	$dbTable = new connectdb('root','','inventory');

	
	$idNnum=explode('-', $dbTable->loginAccount('account',$name,$pass));


	if ($idNnum[0]>0) 
	{
		$_SESSION['username']=$name;
		$_SESSION['id']=$idNnum[1];
		$_SESSION['status']="active";
		$dbTable->updatedataID('account',array('status' => 'active'),$_SESSION['id']);
		header('location:../home.php');
	}
	else
	{   
		header('refresh: 2; url=../login.php');
		echo 'account not found';
	}



?>