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

		$gfes->sendEmail($_POST['emailtosend'],
			'Successfully Confirmed!','
			<div class="alert alert-success">
			<h1>Angels Cupcake</h1>
			<p>Your order has now successfully confirmed therefor you can no longer cancel your order. 
			<strong>Note:</strong> In order to cancel your order you must call the owner. 
			<br><a href="https://angelsbooking.ml/frontend/about.php">Contact Details</a></p>
			
			</div><br>Thank you!');	
		
		header('location: ../home.php');

//		echo 'Client click with id of '.$_POST['clientid'];

	}
	else if (isset($_POST['reject'])) 
	{
		
		$_SESSION['result']="success- Successfully rejected Customer";
		
		$gfdb->updatedataID('pm_client',
			array(
				"client_status"=>"reject"
			),
			$_POST['clientid']);


		$gfes->sendEmail($_POST['emailtosend'],
		'Rejected Order!','
		<div class="alert alert-success">
		<h1>Angels Cupcake</h1>
		<p>Unfortunately your order was rejected.
		To know more contact admin</p> 
		<br><a href="https://angelsbooking.ml/frontend/about.php">Contact Details</a></p>
			</div><br>Thank you!');	
		header('location: ../home.php');

	}
	else if (isset($_POST['cancel'])) 
	{
		
		$_SESSION['result']="success- Successfully cancel Customer";
		
		$gfdb->updatedataID('pm_client',
			array(
				"client_status"=>"cancel"
			),
			$_POST['clientid']);

		$gfes->sendEmail($_POST['emailtosend'],
		'Canceled Order!','
		<div class="alert alert-success">
		<h1>Angels Cupcake</h1>
		<p>Your order was  successfully canceled by the owner as you requested.</p> 
		</div><br>Thank you!');	
		
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
		$gfes->sendEmail($_POST['emailtosend'],
		'Order is done!','
		<div class="alert alert-success">
		<h1>Angels Cupcake</h1>
		<p>Your order is successfully finish!
		Your order will be recieve soon. 
		To know more contact admin</p> 
		<br><a href="https://angelsbooking.ml/frontend/about.php">Contact Details</a></p>
			</div><br>Thank you!');	
		header('location: ../home.php');
	}
	else if (isset($_POST['delete'])) 
	{
		$_SESSION['result']="success- Successfully Deleted Record";
		$id=$_POST['clientid'];
		$gfdb->deleteDataSpecificId('pm_client_bridge','client_id',$id);
		$gfdb->deleteData('pm_client',$_POST['clientid']);
		header('location: ../home.php');
	}
	
?>