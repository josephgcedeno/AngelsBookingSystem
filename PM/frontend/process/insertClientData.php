<?php
	require_once('../../run.php');
	session_start();


	if (isset($_POST['buyproduct'])) 
	{
		$toRecieve=dateAnalyzer($_POST['date1'],maxDate($_POST['idFromBoughted'],'product_day','pm_product'));  

		 $args=$_SESSION['comment'];
		 $gfdb->insertData('pm_client',
		 	array(
		 		"client_fullname"=>$_POST['fullName'],
		 		"client_fbname"=>$_POST['fbacc'],
		 		"client_email"=>$_POST['emailadd'],
		 		"client_phonenumber"=>$_POST['phonenumber'],
		 		"client_expense"=>$_POST['totalPriceToPay'],
		 		"client_ordered"=>$_POST['date1'],
		 		"client_expectedD"=>$toRecieve
		 	)
		 );
		$id = $gfdb->lastDataInserted('pm_client');
		$counter=0;
		foreach ($args as $row) //accessing multi dimension array
	    { 
	    	
	    		$gfdb->insertData('pm_client_bridge',
				array(
						"client_id"=>$id,
						"product_id"=>$row['id'],
						"quantity"=>$_POST['quantityFromBoughted'][$counter],
						"comments"=>$row['comment']
					)
				);
				$counter++;
	    }
	
		
	}

?>