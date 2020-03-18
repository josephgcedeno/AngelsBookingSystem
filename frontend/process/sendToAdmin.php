<?php
	require_once( '../../run.php');

	if ($_POST['sent']) 
	{
		$gfes->sendEmail(emailto,
						'Heads Up, Somebody ordered!','
						<h1>Angels Cupcake</h1>
						<p>You have new order from
						<b>'.$results['userclient_fullname'].'</b> Confirm the order now!!!</p> ');	
	}






?>