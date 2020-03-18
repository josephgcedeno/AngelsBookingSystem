<?php

	require_once( '../../run.php');
	session_start();

	if (isset($_POST['username'])) 
	{
		$result = explode("-", $gfdb->checkIfExist(
			'SELECT id,client_status FROM pm_client 
			 WHERE client_fullname LIKE "%'.$_POST['username'].'%" 
			 AND client_code = "'.$_POST['cancelationcode'].'"'));

		$checkifcoderight=$gfdb->checkIfExist('SELECT id FROM pm_client 
			 WHERE client_fullname LIKE "%'.$_POST['username'].'%"  AND client_code <> "'.$_POST['cancelationcode'].'"');
		if ($result[0]>0) 
		{
			if ($result[1]=='open') 
			{
				$gfdb->updatedataID('pm_client',array("client_status" => 'cancel'),$result[2]);
				$results=$gfdb->resultRowAsArrayAll2('SELECT * FROM pm_client WHERE id='.$result[2].'');
				$gfes->sendEmail($results['client_email'],
				'Successfully Canceled!','
				<div class="alert alert-success">
				<h1>Angels Cupcake</h1>
				<p>Your order has now successfully cancel. </p> 
				<br><a href="#">Contact Details</a>
				</div><br>Thank you!');	
				echo 'separtedcanceled';
			}
			else if($result[1]=='confirm') 
			{
				echo 'separtedconfirm';
			}
			else if ($result[1]=='cancel') 
			{
				echo 'separtedcancel';
			}
			else if ($result[1]=='reject') 
			{
				echo 'separtedreject';
			}			
		}
		else if ($checkifcoderight>0) 
		{
			echo 'separtedwrongkey';
		}
		else
		{
			echo 'separtednotfound';
		}


	}




?>