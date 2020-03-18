<?php


	require_once('../../run.php');


	$sql=$_POST['sql'];
	/*$var=' {"data":';*/
	$var=$gfdb->directCodeJSONFormat($sql);
	/*$var.='}';*/

	$returnThis= 'return$gfdbJSON$'.$var;
 

	echo $returnThis;



?>