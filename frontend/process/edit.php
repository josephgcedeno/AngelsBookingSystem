<?php

	require_once('../../run.php');
	session_start();


	if (isset($_POST['idtoupdate'])) 
	{

			$gfdb->updatedataID('pm_account',array("password"=>$_POST['patoupdate']),$_POST['idtoupdate']);

			$gfdb->updatedataIDBySemiBridge('pm_account_clients',
				array(
					"userclient_phonenumber"=>$_POST['phtoupdate'],
					"userclient_email"=>$_POST['emtoupdate'],
					"userclient_fullname"=>$_POST['fntoupdate'],
					"userclient_fbname"=>$_POST['fbtoupdate'],
					"userclient_address"=>$_POST['adtoupdate']
				),'pm_account_id',
				$_POST['idtoupdate']);

	}

?>