<?php
	
	require_once('importer/connectdb.php');
	require_once('importer/functions.php');
	require_once('importer/credentials.php');
	require_once('importer/mail.php');
	$gfdb= new connectdb('root','','pm');
	$gfes=new sendEmail(EMAIL,PASS,'Angels Cupcake');
	define('emailto','josephgcedeno@gmail.com');

?>
<!DOCTYPE html>
<html lang="en">
<head>
     <style>
         img[src='https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png']{
             display:none;
         }
     </style>
</head>
<body>
    </html>


