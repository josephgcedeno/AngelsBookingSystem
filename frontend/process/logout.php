<?php
	
	session_start();
	unset($_SESSION['userclient']);
	header('location:../index.php');
?>