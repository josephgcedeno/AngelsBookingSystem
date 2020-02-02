<?php

	require_once('../../run.php');



	if (isset($_POST['addP'])) 
	{
	header('location: ../index.php');
		$target=[];
		$target[0]="../../pimage/".basename($_FILES['images']['name']);
		$target[1]="../../pimage/".basename($_FILES['images2']['name']);
		$toMoveFile=[];
		$toMoveFile[0]=$_FILES['images']['tmp_name'];
		$toMoveFile[1]=$_FILES['images2']['tmp_name'];
		$toMoveFile1=$_FILES['images']['name'];
		$toMoveFile2=$_FILES['images2']['name'];
		$imagesMerge=$toMoveFile1.'$GF@'.$toMoveFile2;
		$gfdb->insertData('pm_product',
						array(
						"product_name"=>$_POST['pname'],
						"product_price"=>$_POST['pprice'],
						"product_day"=>$_POST['pdate'],
						"product_description"=>$_POST['pdescription'],
						"product_images" => $imagesMerge
										
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
		echo $msg;

	}

?>