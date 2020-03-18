<?php
	require_once( '../../run.php');
	session_start();

 
	if (isset($_POST['asuser'])) 
	{
		$username=$_POST['username'];
		$password=$_POST['Password'];
	    $_SESSION['userclient']=$username;
		$check=$gfdb->loginAccount2(" 
				SELECT c.pm_account_id as 'id'
				FROM pm_account b 
				INNER JOIN pm_account_clients c 
				ON c.pm_account_id=b.id
				WHERE 
				(b.username='$username' AND b.password='$password' AND b.type='client') OR
				(c.userclient_email='$username' AND b.password='$password' AND b.type='client')
				");
		
		$separte=explode('-', $check );

		if ($separte[0]>0) 
		{	

				$results=$gfdb->resultRowAsArrayAll2('SELECT * FROM pm_account_clients WHERE pm_account_id='.$separte[1].'');
				$randomCode=random_strings(20);
				$exist=$gfdb->checkGenerateIfExist('pm_client',$randomCode);
				while ($exist>1) 
				{	
					$exist=$gfdb->checkGenerateIfExist('pm_client',$randomCode);
					$randomCode=random_strings(20);
				}
				$gfdb->insertData('pm_client',
				 	array(
				 		"client_fullname"=>$results['userclient_fullname'],
				 		"client_fbname"=>$results['userclient_fbname'],
				 		"client_email"=>$results['userclient_email'],
				 		"client_address"=>$results['userclient_address'],
				 		"client_phonenumber"=>$results['userclient_phonenumber'],
				 		"client_expense"=>$_POST['totalPriceToPay'],
				 		"client_ordered"=>$_POST['date'],
				 		"client_code"=>$randomCode
				 	)
				 );

				
				$id = $gfdb->lastDataInserted('pm_client'); //get the latest id 
				$gfdb->insertData('pm_client_transaction',
					array(
						'pm_client_id'=>$separte[1],
						'pm_transaction_id'=>$id
					)
				);
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
						$sent=$gfes->sendEmail($results['userclient_email'],
						'Successfully book!','
						<h1>Angels Cupcake</h1>
						<p>Your order was successfully booked!</p>
						<b>Cancelation Code:</b> '.$randomCode.'
						<br>Thank you!');	
						
					if ($sent) 
					{
					echo  'separtethis'.$randomCode;
					 	
					}

		}
		else
		{
			    echo  'separtethisaccnotfound';

		}

	}
	if (isset($_POST['signin'])) 
	{

		$username=$_POST['username'];
		$password=$_POST['password'];
		$check=$gfdb->loginAccount2(
			"
				SELECT c.pm_account_id as 'id'
				FROM pm_account b 
				INNER JOIN pm_account_clients c 
				ON c.pm_account_id=b.id
				WHERE 
				(b.username='$username' AND b.password='$password' AND b.type='client') OR
				(c.userclient_email='$username' AND b.password='$password' AND b.type='client')
				
			"
			);
		$separte=explode('-', $check );
		var_dump($separte);
		if ($separte[0]!=0) 
		{
				$_SESSION['userclient']=$_POST['username'];
				if (!empty($_POST['remember'])) 
				{
					
					    setcookie ("usernameclient",$_POST['username'],time()+ (10 * 365 * 24 * 60 * 60),'/');  
		   				setcookie ("passwordclient",$_POST['password'],time()+ (10 * 365 * 24 * 60 * 60),'/');

				}
				else
				{
				
					if(isset($_COOKIE["usernameclient"]))   
				    {  
				     setcookie ("usernameclient",'',time()+ (10 * 365 * 24 * 60 * 60),'/');  
				    }  
				    if(isset($_COOKIE["passwordclient"]))   
				    {  
				     setcookie ("passwordclient",'',time()+ (10 * 365 * 24 * 60 * 60),'/');  
				    }  
				}
				
			   header('location: ../account.php');

		}
		else
		{
				$_SESSION['respond']="danger-Incorrect input!";
				header('location: ../login.php');
		}
	}






?>