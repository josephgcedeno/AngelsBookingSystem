<?php

	require_once('connectdb.php');
	require_once('validate.php');



	function moneyFormater($value)
	{	
		$value=strrev(strval($value));
		$counter=0;
		$dummy='';
		$indexes= strlen($value);
		for ($i=0; $i <$indexes ; $i++) 
		{
			$dummy.=$value[$i];
			if ($counter==2 ) 
			{
					$dummy.=',';
					$counter=-1;
			}
				$counter++;
			
		
		}

		if ($dummy[strlen($dummy)-1]==',') 
		{
			$dummy[strlen($dummy)-1]=' ';
		}
		return strval(strrev($dummy));
	}
	function queryArranger($data)
	{	

		$assignColumn="";
		$assignRow="";
		$counterValue=0;

		foreach ($data as $column => $value) 
		{
			$assignColumn.="`".$column."`";
			$assignRow.="'".$value."'";
			if ($counterValue+1!=count($data))
			{
				$assignColumn.=",";
				$assignRow.=",";
				$counterValue++;
			}
		
		}
		
		return $assignRow.'/'.$assignColumn;
	}

	function queryArrangerForUpdate($data)
	{	

		$assignLeft="";
		$counterValue=0;

		foreach ($data as $column => $value) 
		{	
			$assignLeft.="`".$column."`";
			$assignLeft.=" = '".$value."'";	
			if ($counterValue+1!=count($data)) {
				$assignLeft.=",";
				$counterValue++;
			}
		
		}
		
		return $assignLeft;
	}
	

	function maxDate($arr,$selected,$dbname)
	{	

		$withDBConnection= new connectdb('root','','pm');
		$dates=[];

		for ($i=0; $i <count($arr) ; $i++) 
		{ 
			$check[$i]="SELECT $selected FROM $dbname WHERE id=$arr[$i]";
			$result[$i]= mysqli_query($withDBConnection->db,$check[$i]);
			$row = mysqli_fetch_assoc($result[$i]);
			$dates[$i]= $row[$selected];
		}


		return max($dates);
	}

	function dateAnalyzer($book,$maxDate)
	{
		$dateValidate= new validate();
		$time=$book;
		$timeOfBaked=$maxDate;
		$explodeDateBook=explode('-', $time);
		$toSaveInDB=dateValidatorAndEstimator(
			$explodeDateBook[0],
			$explodeDateBook[1],
			$explodeDateBook[2],
			$timeOfBaked
		);
		
		$explodeRecieveDate=explode('-', $toSaveInDB);
		$updatedYear=$explodeRecieveDate[0];
		$updateMonth=$explodeRecieveDate[1];
		$updateDay=$explodeRecieveDate[2];

		switch ($updateMonth) 
		{
				case '12':
					echo 'Your order will be recieve in December '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;
				case '11':
					echo 'Your order will be recieve in November '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;	
				case '10':
					echo 'Your order will be recieve in October '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;
				case '09':
					echo 'Your order will be recieve in September '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;
				case '08':
					echo 'Your order will be recieve in August '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					# code...
					break;	
				case '07':
					echo 'Your order will be recieve in July '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;
				case '06':
					echo 'Your order will be recieve in June '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;
				case '05':
					echo 'Your order will be recieve in May '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;	
				case '04':
					echo 'Your order will be recieve in April '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;
				case '03':
					echo 'Your order will be recieve in March '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;
				case '02':
					echo 'Your order will be recieve in Febuary '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;	
				case '01':
					echo 'Your order will be recieve in January '.$updateDay.', '.$updatedYear.' Thank you For Ordering. ';
					break;
				default:
					echo 'Unknown Error';
					break;
		};
		return $toSaveInDB;
			
	}

	function dateValidatorAndEstimator($updatedYear,$updateMonth,$updateDay,$timeOfBaked)
	{
  		$toSaveInDB;
  		if ($updateMonth=='01' || $updateMonth=='03' || 
  			$updateMonth=='05' || $updateMonth=='07' ||
  			$updateMonth=='08' || $updateMonth=='10' || 
  			$updateMonth=='12') 
			{
				if (($updateDay+$timeOfBaked)>31) 
				{
					if ($updateMonth==12 ) {
						$updateMonth=1;
						$updatedYear=1+$updatedYear;
					}
					else{
						$updatedYear=$updatedYear;
						$updateMonth=$updateMonth+1;
					}
					$toSaveInDB=$updatedYear.'-'.$updateMonth.'-'.(($updateDay+$timeOfBaked)-31);
					return $toSaveInDB;
			

				}
				else 
				{				
					$toSaveInDB=$updatedYear.'-'.$updateMonth.'-'.($updateDay+$timeOfBaked);
					return $toSaveInDB;
				}
			
			
	}
	else if ($updateMonth=='04' || $updateMonth=='06' || 
			 $updateMonth=='09' || $updateMonth=='11' ) 
	{
		if (($updateDay+$timeOfBaked)>30) 
		{
			$updatedYear=$updatedYear;
			$updateMonth=$updateMonth+1;
			$toSaveInDB=$updatedYear.'-'.$updateMonth.'-'.(($updateDay+$timeOfBaked)-30);
			return $toSaveInDB;
		}	
		else 
		{
		
		$toSaveInDB=$updatedYear.'-'.$updateMonth.'-'.($updateDay+$timeOfBaked);
		return $toSaveInDB;
			
		}	
	
	}
	else if ($updateMonth=='2' ) 
	{
	
		$actualDay;
		if ($updatedYear%4==0 || $updatedYear%100==0 && $updatedYear%400==0)
		{
			if (($updateDay+$timeOfBaked)>29) 
			{
				$updatedYear=$updatedYear;
				$updateMonth=$updateMonth+1;
				$actualDay=(($updateDay+$timeOfBaked)-29);
				$toSaveInDB=$updatedYear.'-'.$updateMonth.'-'.$actualDay;
				return $toSaveInDB;

				
			}
			else
			{	$updatedYear=$updatedYear;
				$updateMonth=$updateMonth;
				$actualDay=(($updateDay+$timeOfBaked));
				$toSaveInDB=$updatedYear.'-'.$updateMonth.'-'.$actualDay;
				return $toSaveInDB;
				
			}
				
		}
		else if ($updatedYear%4!=0 || $updatedYear%100!=0 && $updatedYear%400!=0) 
		{
			if ( ($updateDay+$timeOfBaked)>28) 
			{
				$updatedYear=$updatedYear;
				$updateMonth=$updateMonth+1;
				$actualDay=(($updateDay+$timeOfBaked)-28);
				$toSaveInDB=$updatedYear.'-'.$updateMonth.'-'.$actualDay;
				return $toSaveInDB;
	
			}
			else
			{	
				$updatedYear=$updatedYear;
				$updateMonth=$updateMonth;
				$actualDay=(($updateDay+$timeOfBaked));
				$toSaveInDB=$updatedYear.'-'.$updateMonth.'-'.$actualDay;
				return $toSaveInDB;
	
			}
		}
		
		
	}

  	}
  	function recoverPasswordSuccessfUlly($accountPassword)
  	{
  	
  		echo '<div class="alert alert-success">
  					<img src="img/check.png" style="position:absolute; width: 40%; margin-left:-66px;">
  				<h4>Username: '.$accountPassword[1].'</h4>
  				<h4>Password: '.$accountPassword[2].'</h4>
  				<center><a href="login.php">login here</a></center>
  			</div>';
  	}

  	function actionAfterLogin($action)
  	{
  			
  			
		  switch($action)
			  	{	
			  		case 'wrong credentials': 
				  				 echo '<div class="alert alert-danger">'.$action.'</div>';
				  				 break;

				  	case 'Username not found!':
				  				 echo '<div class="alert alert-danger">'.$action.'</div>';
				  				 break;
				  	case 'Username not found!':
				  				 echo '<div class="alert alert-danger">'.$action.'</div>';
				  				 break;

				  	case 'Answer does not match!':
				  				 echo '<div class="alert alert-danger">'.$action.'</div>';
				  				 break;
			  	}


  	}

  	function alerts($result)
  	{
  		$newResult=explode("-", $result);
  		switch ($newResult[0]) {
  			case 'success':
  				echo '<div class="alert alert-success" role="alert" >
                    '.$newResult[1].'
                    <button class="close" data-dismiss="alert">
                                  ×
                    </button>
                  </div>' ;
  				break;
  			case 'danger':	
  				echo '<div class="alert alert-danger" role="alert">
					   '.$newResult[1].'
                    <button class="close" data-dismiss="alert">
                                  ×
                    </button>
					</div>';
					break;
			case 'reject':	
  				echo '<div class="alert alert-warning" role="alert">
					   '.$newResult[1].'
                    <button class="close" data-dismiss="alert">
                                  ×
                    </button>
					</div>';
					break;		
  			
  			default:
  				# code...
  				break;
  		}
  		  
  	}


  	function addIndexOfArray($labels)
    { 
            $total=0;
            for ($i=0; $i < count($labels); $i++) 
            { 
                $total+=$labels[$i];
            }
       
            return $total;
    }
    function addIndexOfArrayConcat($labels)
    { 
            $total='';
            for ($i=0; $i < count($labels); $i++) 
            { 
                $total.='Comment#'.$i.'='.$labels[$i].' ';
            }
       
            return $total;
    }
    function dissectAndGroupIntoIdNComment($productIds, $proComment)
    {
    	for ($i=0; $i < count( $productIds); $i++) 
        {
                $args[$i]=array(
                 "id"=>$productIds[$i],
                 "comment"=>$proComment[$i]
                  );
        } 
    	$tmp = array();
        foreach($args as $arg)
        {	
        	$tmp[$arg['id']][] = $arg['comment'] ;
        }
       
 		$output=[];
        foreach($tmp as $type => $labels)
        {		
        	
           $output[] = array(
                'id' => $type,
                'comment' => addIndexOfArrayConcat($labels)
            );
        }
             return $output;
    }	

     function dissectAndGroupIntoIdNQuantity( $productIds, $productQuan)
     {
            for ($i=0; $i < count( $productIds); $i++) 
            {
                $args[$i]=array(
                 "id"=>$productIds[$i],
                 "quantity"=>$productQuan[$i]
                  );
            } 
            $tmp = array();
            foreach($args as $arg)
            {	
            	$tmp[$arg['id']][] = $arg['quantity'];
            }
           
     		$output=[];
            foreach($tmp as $type => $labels)
            {		
            	
               $output[] = array(
                    'id' => $type,
                    'quantity' => addIndexOfArray($labels)
                );
            }
            return $output;

     }


?>


