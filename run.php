<?php
	
	require_once('importer/connectdb.php');
	require_once('importer/functions.php');
	require_once('importer/credentials.php');
	require_once('importer/mail.php');
	$gfdb= new connectdb('root','','pm');
	$gfes=new sendEmail(EMAIL,PASS,'Angels Cupcake');
	define('emailto','josephgcedeno@gmail.com');

?>



