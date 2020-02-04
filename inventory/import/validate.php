<?php


	require_once('connectdb.php');

	class validate
	{	
		private $connectdb;
		
		function __construct()
		{
			$this->connect2db();//composition
		}
		function connect2db()
		{
			$this->connectdb=new connectdb('root','','pm');
		}
	 	function validateAccount($dbname,$username,$password)
	 	{
	 		
			$check="SELECT * FROM `$dbname`";
			$result = mysqli_query($this->connectdb->db,$check);
			while($row=mysqli_fetch_array($result))
			{
				if ($row['username']==$username && $row['password'] ==$password) 
				{
					return true;
				}
				else
				{
					return false;
				}
	  		}
	  	}

	  	

	}


?>


