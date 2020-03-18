<?php

	session_start();
	require_once('../run.php');


?>
<!DOCTYPE html>
<html>
<head>
	<title>Cancel Order</title>
	<link rel="stylesheet" type="text/css" href="css/loading.css">
	<link rel="stylesheet" type="text/css" href="../importer/css/bootstrap.min.css">
  	<script src="../importer/js/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
   	<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  	  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/cancel.css">
	<link rel="stylesheet" href="css/cancel.css">
  	<link rel="stylesheet" href="css/list.css">
</head>
<body>


 <div id="header"> 
                <ul>
               
                    <li><a href="index.php">Cupcakes</a></li>
                    <li><a href="#" class="active">Cancel Order</a></li>
                    <li><a href="about.php" >About</a></li>    
                    <li><a href="help.php">How to Order</a></li>
                    <li class="float-right">
                      <?php if(isset($_SESSION['userclient']))
                           { 
                                $usernametoDisplay=explode('@', $_SESSION['userclient']);
	                             echo' 
	                             <a href="#" id="dropdown"><img src="img/user.png" width="30px" > '.$usernametoDisplay[0].'</a>
                                  <div class="menus" style="display:none; padding: 20px; border-radius:5px;  background-color: #e57373;  font-size:30px; position:absolute">
                                    <a href="account.php" style="color: white;">Profile</a><br>
                                      <a href="process/logout.php" style="color: white;">Logout</a>
                                  </div>
                              </li>';             
                           }
                           else
                           {
                              echo' 
                              <a href="#" id="dropdown"><img src="img/user.png" width="30px" > Login</a>
                                  <div class="menus" style="display:none; padding: 20px; border-radius:5px;  background-color: #e57373;  font-size:30px; position:absolute">
                                    <a href="login.php" style="color: white;">Sign in</a><br>
                                    <a href="signup.php" style="color: white;">Sign Up</a>
                                  </div>
                              </li>
                              ';  
                           }
                      ?>
                                                      
                </ul>   

            </div>
	<div class="container">
		        <div class="container hideafter">
					<div class="row">
						<div class="col s12">
							<div class="alert alert-danger" role="alert" id="alerts"  style="display: none; margin-top: 30px;">
					             <h5></h5>
					                    <button type="button" class="close" style="margin-top: -35px;">×</button>
					             </div>

				             <div class="alert alert-success" role="alert" id="alerts1"  style="display: none;">
				             <h5></h5>
				                    <button type="button" class="close" style="margin-top: -35px;">×</button>
				             </div>
							<h1><b>CANCEL ORDER</b></h1>
							<div class="divider"></div>
							<h5 style="margin-top: 30px;">You're about to cancel your order.</h5><p><strong style="color: #e57373">Note:</strong> You can only cancel if your order has not been confirmed, see<a href="about.php" style="color: #e57373"><em> details</em></a> for more info.</p>
							<div class="info" style="margin-top: 50px;">
							<div class="input-field col s6">
					          <input id="last_name" type="text" class="validate" name="username" required>
					          <label for="last_name">Full Name</label>
					        </div>
					        <div class="input-field col s6">
					          <input id="cancelthis" type="text" class="validate" name="cancelcode" required>
					          <label for="cancelthis">Cancelation Code</label>
					        </div>
					        </div>
					        <button class="waves-effect waves-light btn" id= "button" style="color: white !important; margin-top: 50px; background-color: #e57373"><i class="material-icons left">check</i>Confirm</button>
						</div>

							<!-- <div class="col-md-6">
								<div class="form-group">
										<label><strong>Your Full Name</strong></label>
										<input type="text" placeholder="Enter full name..." name="username" class="form-control" required>
								</div>

							</div>
							<div class="col-md-6">
								<div class="form-group">
										<label><strong>Your Cancelation Code</strong></label>
										<input type="text" placeholder="Enter cancelation code..." class="form-control" name="cancelcode" required>
									
								</div>
							</div>
					
							<div class="text-center py-4">
								<button type="button" id="button"  class="btn btn-primary" style="margin-left: 20px;">Confirm</button>
							</div> -->

					</div>
				</div>
	</div>
	<div class="container">
		
			<div class="loading" ><img src="img/cupcake.gif"><h3 class="fonts">Angel's Cupcake</h3></div>
				
	</div>


</body>
</html>


<script type="text/javascript">
	function alertCancel()
	{
		
		  return confirm("Do you really want to cancel your order?");
	  	
	}

	
	$(document).ready(function()
	{


		
			$(`#button`).on('click',function()
			{

             //  $("#button").attr("disabled", "disabled");
             	if (alertCancel()) 
             	{

				          var valueUsername=$('input[name=username]').val();
				          var valueCodeCancelation=$('input[name=cancelcode]').val();
				          if (valueUsername=='' || valueCodeCancelation=='') 
				          {
                             $(`#alerts1`).hide();
                           	 $(`#alerts`).hide();
				          	 $(`#alerts h5`).text('')
                             $(`#alerts h5`).text('Fields cannot be empty!')
                             $(`#alerts`).show();
				          }
				          else
				          {

				          	$(`.loading`).fadeIn(500);
				          	$(`.hideafter`).hide();
						          $.ajax(
						          {

						          	url: "process/cancel.php",
				                    type: "POST",
				                    data: 
				                    {
				                      username:valueUsername,
				                      cancelationcode:valueCodeCancelation

				                    },
				                    cache: false,
				                    success: function(dataResult)
				                    {
				          				$(`.loading`).hide();
				          				$(`.hideafter`).fadeIn('slow');

				                    	var result=dataResult.split("separted");
				                    	switch(result[1])
				                    	{
				                    		case 'canceled':
                           							 $(`#alerts1`).hide();
                           							 $(`#alerts`).hide();
				                    				 $(`#alerts1 h5`).text('')
						                             $(`#alerts1 h5`).text('Successfully cancel')
						                             $(`#alerts1`).show();
											    break;
											case 'confirm':
										
                           							  $(`#alerts1`).hide();
                           							 $(`#alerts`).hide();
													 $(`#alerts h5`).text('')
						                             $(`#alerts h5`).text('Cannot cancel, book already on process. Contact manager. ')
						                             $(`#alerts`).show();
											    break;
											case 'cancel':
											
                           						 $(`#alerts1`).hide();
                           							 $(`#alerts`).hide();
												 $(`#alerts h5`).text('')
						                         $(`#alerts h5`).text('Order already Canceled!')
						                         $(`#alerts`).show();
											    break;
											case 'reject':
											
                           						 $(`#alerts1`).hide();
                           							 $(`#alerts`).hide();
												 $(`#alerts h5`).text('')
						                         $(`#alerts h5`).text('Order already Rejected!')
						                         $(`#alerts`).show();
											    break;
											case 'notfound':
										
                           						 $(`#alerts`).hide();
											     $(`#alerts h5`).text('')
						                         $(`#alerts h5`).text(`Client not found!`)
						                         $(`#alerts`).show();
											    break;
										    case 'wrongkey':
                           					     $(`#alerts`).hide();
											     $(`#alerts h5`).text('')
						                         $(`#alerts h5`).text(`Incorrect Cancelation code!`)
						                         $(`#alerts`).show();
											    break;
										
				                    	}

						          	}
						          });


						  }
				 }
			});

			$(`#dropdown`).on('click',()=>
		    { 
		        $(`.menus`).slideToggle('fast');
		    });
			$(`.close`).on('click',()=>
			{

				$(`#alerts`).hide();
				$(`#alerts1`).hide();

			});
	});

	


</script>
