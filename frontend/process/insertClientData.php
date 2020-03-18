<?php
	require_once( '../../run.php');
	session_start();


	if (isset($_POST['fullName'])) 
	{
		$randomCode=random_strings(20);
		$exist=$gfdb->checkGenerateIfExist('pm_client',$randomCode);
		while ($exist>1) 
		{	
			$exist=$gfdb->checkGenerateIfExist('pm_client',$randomCode);
			$randomCode=random_strings(20);
		}
		// $args=$_SESSION['comment'];
		 $gfdb->insertData('pm_client',
		 	array(
		 		"client_fullname"=>$_POST['fullName'],
		 		"client_fbname"=>$_POST['fbacc'],
		 		"client_email"=>$_POST['emailadd'],
		 		"client_address"=>$_POST['address'],
		 		"client_phonenumber"=>$_POST['phonenumber'],
		 		"client_expense"=>$_POST['totalPriceToPay'],
		 		"client_ordered"=>$_POST['date1'],
		 		"client_code"=>$randomCode
		 	)
		 );
		$id = $gfdb->lastDataInserted('pm_client'); //get the latest id 
		
	    for($i=0; $i<count($_POST['productID']);$i++)
	    {
	    	$check=$gfdb->insertData('pm_client_bridge',
								array(
									"client_id"=>$id,
									"product_id"=>$_POST['productID'][$i],
									"quantity"=>$_POST['productQuantity'][$i],
									"comments"=>$_POST['productComments'][$i]
								 )
			 				);
	    	
	    }
	
	   		
	   	$sent=$gfes->sendEmail($_POST['emailadd'],
			'Successfully book!','
			<h1>Angels Cupcake</h1>
			<p>Your order was successfully booked!</p>
			<b>Cancelation Code:</b> '.$randomCode.' <br>Thank you!');	
		if ($sent) 
		{
			echo  'separtethis'.$randomCode;

		}
		
	
	

		
	}
	if (isset($_POST['fullName'])) 
	{


	}
	if (isset($_POST['signup'])) 
	{
		$username=$_POST["username"];
		$check=$gfdb->loginAccount2(" 
				SELECT id FROM pm_account 
				WHERE 
				username='$username' AND type='client'
				");

		if ($check==0) 
		{
			if ($_POST["password"]==$_POST["copassword"]) 
			{
				if (strlen($_POST["password"])<8) 
				{
			
					$_SESSION['respond']='danger- Password must atleast 8 characters!';
					header('location: ../signup.php');
				}
				else
				{

					$gfdb->insertData('pm_account',
						array(
							"username"=>$_POST['username'],
							"password"=>$_POST['password'],
							"type"=>'client'
						));


					$id = $gfdb->lastDataInserted('pm_client'); //get the latest id 

					$gfdb->insertData('pm_account_clients',
						array(
						
							"userclient_fullname"=>$_POST['fullname'],
							"userclient_fbname"=>$_POST['fbacc'],
							"userclient_email"=>$_POST['email'],
							"userclient_address"=>$_POST['address'],
							"userclient_phonenumber"=>$_POST['phoneno'],
							"userclient_gender"=>$_POST['gender'],
							"pm_account_id"=>$id
						));

					$_SESSION['respond']='success- Account Successfully Created!';
					$_SESSION['userclient']=$_POST['username'];
					header('location: ../index.php');

/*CK*/
				}
			}
			else 
			{	
				if (strlen($_POST["password"])<8 && $_POST["password"]!=$_POST["copassword"]) 
				{
					$_SESSION['respond']='danger- Password must atleast 8 characters and must be match!';
				}
				else if (strlen($_POST["password"])<8) 
				{
					$_SESSION['respond']='danger- Password must atleast 8 characters!';
				}
			    else if($_POST["password"]!=$_POST["copassword"])
				{
					$_SESSION['respond']='danger- Password did not match!';
					header('location: ../signup.php');

				}
					header('location: ../signup.php');

			}

		}
		else
		{
			$_SESSION['respond']='danger- Already exist!';
					header('location: ../signup.php');
		}







	}

?>