<?php
	require_once('../../run.php');
		session_start();

	

	if ($_POST['client_status']=='open') 
	{
	 	
   		$gfdb->makeDataFromDatabaseToJasonFormatForTable("SELECT *  FROM pm_client WHERE client_status='open' ",$_SESSION['cols'], 9, "../js/value.json");

	}
	else if ($_POST['client_status']=='confirm') 
	{
	  
   		$gfdb->makeDataFromDatabaseToJasonFormatForTable("SELECT *  FROM pm_client WHERE client_status='confirm' ", $_SESSION['cols'], 9, "../js/value.json");

	}
	else if ($_POST['client_status']=='reject') 
	{
	  
   		$gfdb->makeDataFromDatabaseToJasonFormatForTable("SELECT *  FROM pm_client WHERE client_status='reject' ", $_SESSION['cols'], 9, "../js/value.json");

	}
	else if ($_POST['client_status']=='done') 
	{

   		$gfdb->makeDataFromDatabaseToJasonFormatForTable("SELECT *  FROM pm_client WHERE client_status='done' ", $_SESSION['cols'], 9, "../js/value.json");
	}









?>

