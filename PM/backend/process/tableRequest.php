<?php
	require_once('../../run.php');
	
	session_start();
	if (isset($_POST['open'])) 
	{
	


		$_SESSION['result']="success- Successfully Confirm Customer";
		
		$gfdb->updatedataID('pm_client',
			array(
				"client_status"=>"confirm"
			),
			$_POST['clientid']);
		
		header('location: ../home.php');

//		echo 'Client click with id of '.$_POST['clientid'];

	}
	else if (isset($_POST['reject'])) 
	{
		
		$_SESSION['result']="reject- Warning! Successfully rejected Customer";
		
		$gfdb->updatedataID('pm_client',
			array(
				"client_status"=>"reject"
			),
			$_POST['clientid']);
		
		header('location: ../home.php');

	}

	else if (isset($_POST['done'])) 
	{
		$_SESSION['result']="success-  Successfully Finish Orders";
		
		$gfdb->updatedataID('pm_client',
			array(
				"client_status"=>"done"
			),
			$_POST['clientid']);
		
		header('location: ../home.php');
	}
	else if (isset($_POST['delete'])) 
	{
		$_SESSION['result']="success- Warning! Successfully Deleted Record";
		$gfdb->deleteData('pm_client',$_POST['clientid']);
		header('location: ../home.php');
	}
	else
	{
		echo "string";
	}

?>