<?php

	require_once('../../run.php');

	session_start();

	if (isset($_POST['addP'])) 
	{
	    header('location: ../product.php');
		$target=[];
		$target[0]="../../pimage/".basename($_FILES['images']['name']);
		$target[1]="../../pimage/".basename($_FILES['images2']['name']);
		$toMoveFile=[];
		$toMoveFile[0]=$_FILES['images']['tmp_name'];
		$toMoveFile[1]=$_FILES['images2']['tmp_name'];
		$toMoveFile1=$_FILES['images']['name'];
		$toMoveFile2=$_FILES['images2']['name'];
		/*$imagesMerge=$toMoveFile1.'$GF@'.$toMoveFile2;*/

		if (!empty($_POST['pname']) || !empty($_POST['pprice']) || !empty($_POST['pdescription'])
		 || !empty($toMoveFile1)    || !empty($toMoveFile2) ) 
		{

				$check=$gfdb->checkItemIfExist('pm_product','product_name',$_POST['pname']);
				
				if ($check==0) 
				{
					   $gfdb->insertData('pm_product',
										array(
										"product_name"=>$_POST['pname'],
										"product_price"=>$_POST['pprice'],
										"product_description"=>$_POST['pdescription']
														
										));
						$id = $gfdb->lastDataInserted('pm_product'); //get the latest id 
						$gfdb->insertData('pm_product_img',
										 array(
										 "pm_product_id"=>$id,
										 "pm_img1"=>$toMoveFile1,
										 "pm_img"=>$toMoveFile2

										 ));
							
								for ($i=0; $i < count($toMoveFile); $i++) 
								{ 
									if (move_uploaded_file($toMoveFile[$i], $target[$i])) 
									{
										$msg="Image uploaded successfully";
									
									}
									else
									{
										$msg="There was a error";
									}
								}
					$_SESSION['result']="success- Successfully Add product";
				}
				else
				{
					$_SESSION['result']="danger- Product Already Exist!";
				}
						
		}
		else
		{
			$_SESSION['result']="danger- Unable to add product";
		}

	}
	if (isset($_POST['addacc'])) 
	{
		$check=$gfdb->checkAccountIfExistwithtype('pm_account',$_POST['username'],'admin');

		if ($check==0) 
		{
			$gfdb->insertData('pm_account',
				array(
				"username"=>$_POST['username'],
				"password"=>$_POST['password'],
				"type"=>'admin'
				));
			
			$idthis=$gfdb->lastDataInserted('pm_account');
			$ss=$gfdb->insertData('pm_account_qna',
				array(
					"pm_account_id"=>$idthis,
					"pm_account_q1"=>$_POST['ques1'],
					"pm_account_q2"=>$_POST['ques2'],
					"pm_account_q3"=>$_POST['ques3'],
					"pm_account_a1"=>$_POST['ans1'],
					"pm_account_a2"=>$_POST['ans2'],
					"pm_account_a3"=>$_POST['ans3']
				));

			echo 'returnthisaddedsuccessfully';	
			if ($ss) 
			{
			 $_SESSION['result']="success- Successfully Add Account";
				# code...
			}
		}
		else
		{
			echo 'returnthisalreadyexist';	

		}


	}
	if (isset($_POST['updateacc'])) 
	{
		$username=$_POST['usernameToUpdate'];
		$id=$_POST['id'];
	$check=$gfdb->checkAccountIfExistForUpdate2("
		SELECT id 
		FROM pm_account 
		WHERE 
		username='$username' AND id<>$id AND type<>'client' ");
		if ($check==0) 
		{
				
				if ($_POST['usernamethatholds']==$_POST['usernameToUpdate']) 
				{	
					$_SESSION['userpasssword']=$_POST['passwordToUpdate'];

				}
			
				
				$gfdb->updatedataID('pm_account',
				array(
				"username"=>$_POST['usernameToUpdate'],
				"password"=>$_POST['passwordToUpdate']
				),$_POST['id']);
				$gfdb->updatedataIDBySemiBridge('pm_account_qna',
				array(
				"pm_account_q1"=>$_POST['ques1ToUpdate'],
				"pm_account_q2"=>$_POST['ques2ToUpdate'],
				"pm_account_q3"=>$_POST['ques3ToUpdate'],
				"pm_account_a1"=>$_POST['ans1ToUpdate'],
				"pm_account_a2"=>$_POST['ans2ToUpdate'],
				"pm_account_a3"=>$_POST['ans3ToUpdate']
				),'pm_account_id',$_POST['id']);

				echo 'returnthissuccessful';	
		}
		else
		{
			echo 'returnthisalreadyexist!';	

		}
	}

	if(isset($_POST['productName']))
	{


		$check=$gfdb->checkItemIfExist2('pm_product','product_name',$_POST['productName'],$_POST['id']);
		if ($check==0) 
		{
						if (empty($_FILES['image1']['name']) && empty($_FILES['image2']['name'])) 
						{

							//echo 'perform both original picture';
							$imagesMerge=$_POST['origimg1'].'$GF@'.$_POST['origimg2'];
							$gfdb->updatedataID('pm_product',
										array(
										"product_name"=>$_POST['productName'],
										"product_price"=>$_POST['productPrice'],
										"product_description"=>$_POST['description']
										),$_POST['id']);
							$gfdb->updatedataIDBySemiBridge('pm_product_img',
										array(
										"pm_img1" => $_POST['origimg1'],
										"pm_img"=> $_POST['origimg2']
										),'pm_product_id',$_POST['id']);
							echo 'returnthis'.$imagesMerge;			
						}
						else if(empty($_FILES['image1']['name']) && !empty($_FILES['image2']['name']))
						{
							//echo 'perform origimg1 lang except kang image2 [image2][name]';
							$toMoveFile2=$_FILES['image2']['name'];
							$imagesMerge=$_POST['origimg1'].'$GF@'.$toMoveFile2;
							$gfdb->updatedataID('pm_product',
										array(
										"product_name"=>$_POST['productName'],
										"product_price"=>$_POST['productPrice'],
										"product_description"=>$_POST['description']
										
														
										),$_POST['id']);
							$gfdb->updatedataIDBySemiBridge('pm_product_img',
										array(
										"pm_img1" => $_POST['origimg1'],
										"pm_img"=> $toMoveFile2
										),'pm_product_id',$_POST['id']);
							echo 'returnthis'.$imagesMerge;			

						}
						else if(!empty($_FILES['image1']['name']) && empty($_FILES['image2']['name']))
						{
							//echo 'perform origimg2 lang except kang image1 = [image1][name]';


							$toMoveFile2=$_FILES['image1']['name'];
							$imagesMerge=$toMoveFile2.'$GF@'.$_POST['origimg2'];
							$gfdb->updatedataID('pm_product',
										array(
										"product_name"=>$_POST['productName'],
										"product_price"=>$_POST['productPrice'],
										"product_description"=>$_POST['description']			
										),$_POST['id']);
							$gfdb->updatedataIDBySemiBridge('pm_product_img',
										array(
										"pm_img1" => $toMoveFile2,
										"pm_img"=> $_POST['origimg2']
										),'pm_product_id',$_POST['id']);
							echo 'returnthis'.$imagesMerge;	
						
						}
						else
						{
							//echo 'base lang sa files image1 and 2';
							$toMoveFile1=$_FILES['image1']['name'];
							$toMoveFile2=$_FILES['image2']['name'];
							$imagesMerge=$toMoveFile1.'$GF@'.$toMoveFile2;
							$gfdb->updatedataID('pm_product',
										array(
										"product_name"=>$_POST['productName'],
										"product_price"=>$_POST['productPrice'],
										"product_description"=>$_POST['description']
														
										),$_POST['id']);
							$gfdb->updatedataIDBySemiBridge('pm_product_img',
										array(
										"pm_img1" => $toMoveFile1,
										"pm_img"=> $toMoveFile2
										),'pm_product_id',$_POST['id']);
							echo 'returnthis'.$imagesMerge;	
						}
		}
		else
		{
			echo 'returnthisalreadyexist!';	
		}
		

/*
		$toMoveFile1=$_FILES['image1']['name'];
		$toMoveFile2=$_FILES['image2']['name'];
		
		/*
		echo $imagesMerge;*/
	}




?>