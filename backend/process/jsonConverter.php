<?php

	require_once('../../run.php');
	echo 'return$gfdbJSON$'.$gfdb->directCodeJSONFormat($_POST['sql']);
 
?>