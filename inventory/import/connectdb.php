<!-- VERSION 1.2 DB CONNECTION -->

<?php

	require_once('functions.php');

	class connectdb
	{	
		public $db;
		function __construct($username,$password,$database)
		{
			$user=$username;
			$pass=$password;
			$this->db=$database;

			$this->db = new mysqli('localhost',$user,$pass,$this->db) or die("unable to connect");
			if ($this->db->connect_error) 
			{
				die("connection failed; ".$db-> connect_error);
			}
		}
		
		function loginAccount($dbname,$arrayInfo)
		{
			$keys = array_keys( $arrayInfo ); 	
			$username= $arrayInfo[$keys[0]];
			$password= $arrayInfo[$keys[1]];
			$s= " 
				SELECT id FROM $dbname WHERE 
				$keys[0]='$username' AND 
				$keys[1]='$password' 
				";		

			$result=mysqli_query($this->db,$s);
			$num=mysqli_num_rows($result);
			$id=mysqli_fetch_assoc($result);
			return $num.'-'.$id['id'];
		}
		function checkAccountIfExist($dbname,$username)
		{
			$s= "SELECT id FROM $dbname WHERE username='$username'";
			$result=mysqli_query($this->db,$s);
			$num=mysqli_num_rows($result);
			return $num;
		}

		function resultRowAsArray($dbname,$id){


			$value=[];

			$sql="SELECT * FROM $dbname WHERE account_id=$id";
			$result=mysqli_query($this->db,$sql);
			$counter=0;
			while ($row = mysqli_fetch_row($result))
			{	
				for ($i=0; $i <count($row); $i++) { 
					$value[$counter][$i]=$row[$i];
				}
				$counter++;
			}
			
			return $value;
			
		}
		//mysql> select *from LastInsertedRow where Id=(SELECT LAST_INSERT_ID());
		//this will chech the latest inserted data
		function lastDataInserted($dbname)
		{
			$sql = "SELECT last_insert_id() AS latestID FROM $dbname";
			$result=mysqli_query($this->db,$sql);
			$id;
			while ($row = mysqli_fetch_array($result))
			{	
				$id=$row['latestID'];
			}
		
			return $id;
		}
		function getResultProductNameNProductTotalPrice($dbname,$id,$quantity)
		{
			$sql= "SELECT product_price,product_description, product_name, ($quantity*product_price) AS totalAsProduct   
				   FROM $dbname 
				   WHERE id=$id";
			$result=mysqli_query($this->db,$sql);
			$productName;
			$totalPrice=0;
			$price=0;
			$productDescription;
			while ($row = mysqli_fetch_array($result))
			{			
				$productName=$row['product_name'];
				$totalPrice=$row['totalAsProduct']; 
				$productDescription=$row['product_description'];
				$price=$row['product_price'];
			}	

			return $productName.'$gf@'.$totalPrice.'$gf@'.$productDescription.'$gf@'.$price;

		}
		//WHOLE VALUE FROM CURRENT TABLE
		function resultRowAsArrayAll($dbname){


			$value=[];

			$sql="SELECT * FROM $dbname";
			$result=mysqli_query($this->db,$sql);
			$counter=0;
			while ($row = mysqli_fetch_row($result))
			{	
				for ($i=0; $i <count($row); $i++) { 
					$value[$counter][$i]=$row[$i];
				}
				$counter++;
			}
			
			return $value;
			
		}

		//USE FOR VERIFICATION  OR PASSWORD RECOVERY
		function selectQuestionsByUsernameOrId($dbname,$userNameOrId){


			$value=[];

			$sql="SELECT * FROM $dbname WHERE 
			
				  username='$userNameOrId' 
			";
			$result=mysqli_query($this->db,$sql);
			$counter=0;
			while ($row = mysqli_fetch_row($result))
			{	
				for ($i=0; $i <count($row); $i++) { 
					$value[$counter][$i]=$row[$i];
				}
				$counter++;
			}
			
			return $value;
			
		}


		function selectAllFromTable($dbname)
		{
			$sql="SELECT *  FROM $dbname";
			$result=mysqli_query($this->db,$sql);
			return $result;

		}
		function makeDataFromDatabaseToJasonFormatForTable($sql,$columns,$numberColumns,$location)
		{
			$result=mysqli_query($this->db,$sql);
			$noCol=$numberColumns;

			/* COUNT TABLE COLUMN
			$countTableCol= "SELECT count(*) AS numberColumns FROM information_schema.columns  WHERE table_name ='$dbname'";
			$columnsTB=mysqli_query($this->db,$countTableCol);
			while ( $row = mysqli_fetch_array($columnsTB)) 
			{
				$noCol=$row['numberColumns'];
			}*/

			/*
			c client
			b product
			r is bridge

// SELECT 


//PRODUCTS
SELECT
c.id,c.client_fullname,c.client_fbname,c.client_email,c.client_phonenumber,c.client_status,c.client_expense,c.client_ordered,c.client_expectedD ,
b.product_name, r.client_id,r.product_id,r.quantity,r.comments
FROM  pm_client_bridge r
INNER JOIN pm_product b ON r.product_id=b.id
INNER JOIN pm_client c ON r.client_id = c.id 
		*/
			$counter=0;
			$toWrite=' {"data":';
			$totalCol=count($columns);
			$toWrite.="[";
			while ( $row = mysqli_fetch_array($result)) 
			{
				for ($i=0; $i < $noCol; $i++) 
				{ 
						if ($i==0) 
						{
							$toWrite.='{';
						}
						$toWrite.='"'.$columns[$i].'":"'.$row[$columns[$i]].'"';

						if ($i+1==$noCol) 
						{
							$toWrite.='}';
						}
						else
						{
							$toWrite.=',';
						}
				}	
				if ($counter+1!=mysqli_num_rows($result)) 
				{
					$toWrite.=',';
				}
					$counter++;
			}
			$toWrite.=']}';
			$myfile = fopen($location, "w") or die("Unable to open file!");
			fwrite($myfile, $toWrite);
			fclose($myfile);
		}
		
		function makeDataFromDatabaseToJasonFormat($sql,$columns,$noCol,$location)
		{
	
			$result=mysqli_query($this->db,$sql);
			$counter=0;
			$toWrite="";
			$totalCol=count($columns);
			$toWrite.="[";
			while ( $row = mysqli_fetch_array($result)) 
			{
				for ($i=0; $i < $noCol; $i++) 
				{ 
						if ($i==0) 
						{
							$toWrite.='{';
						}
						$toWrite.='"'.$columns[$i].'":"'.$row[$columns[$i]].'"';

						if ($i+1==$noCol) 
						{
							$toWrite.='}';
						}
						else
						{
							$toWrite.=',';
						}
				}	
				if ($counter+1!=mysqli_num_rows($result)) 
				{
					$toWrite.=',';
				}
					$counter++;
			}
			$toWrite.=']';
			$myfile = fopen($location, "w") or die("Unable to open file!");
			fwrite($myfile, $toWrite);
			fclose($myfile);
		}
		function insertData($dbname,$arrayInfo)
		{
			$colRow=explode("/",queryArranger($arrayInfo));
			$this->db->query(
			"INSERT INTO `$dbname` ($colRow[1]) VALUES 
			($colRow[0])");

		}

		function updatedataID($dbname,$data,$id)
		{	
			$values=queryArrangerForUpdate($data);

			 mysqli_query($this->db,("UPDATE `$dbname` SET
			 $values 
			 WHERE id=$id"));

		}
		function updatedataUSERNAME($dbname,$data,$username)
		{	
			$values=queryArrangerForUpdate($data);
			echo $values;
			 mysqli_query($this->db,("UPDATE `$dbname` SET
			 $values 
			 WHERE username='$username'"));

		}
		function deleteData($dbname,$id)
		{	
			 mysqli_query($this->db,("DELETE FROM `$dbname` WHERE id=$id"));
				
		}

    }


?>