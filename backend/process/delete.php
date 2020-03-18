<?php


		require_once('../../run.php');
		session_start();
		$table='';
		$table2='';
		$checkwith='';
		if (isset($_POST['deletebtn'])) 
		{
	  		header('location: ../product.php');
	  		$table='pm_product'; 	//table 1
			$table2='pm_product_img'; 	//table 2 bridge
			$checkwith='pm_product_id'; 	//

		}
		else if (isset($_POST['deletebtnacc']))
		{
	  		header('location: ../account.php');
	  		$table='pm_account';
	  		$table2='pm_account_qna'; 	//table 2 bridge
			$checkwith='pm_account_id'; 	//
		}
		
		if (count($_POST['deleted'])==0) 
  		{
  			$_SESSION['result']="danger- Nothing to Delete!";
  		}
  		else
  		{
  			for($i=0 ; $i < count($_POST['deleted']); $i++)
			{
				$gfdb->deleteData($table,$_POST['deleted'][$i]);
				$gfdb->deleteDataIDBySemiBridge($table2,$checkwith,$_POST['deleted'][$i]);
				
			}
			$_SESSION['result']="success- Successfully Delete!";
  		}
			

		

?>