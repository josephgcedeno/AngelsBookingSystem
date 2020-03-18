<?php

  require_once('../run.php');
  session_start();
  if (!isset($_SESSION['user'])) {

    
  $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
                $_SERVER['REQUEST_URI']; 


   $_SESSION['req']=$link;
    header('location: ../backend/login.php');


   
  }


?>
<!DOCTYPE html>
<html>
<head>
  <title>Account Management</title>
  <link rel="stylesheet" type="text/css" href="../importer/css/bootstrap.min.css">
  <script src="../importer/js/functions.js" ></script>
  <script src="../importer/js/jqueryUI.js"></script>
  <script src="../importer/js/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="../importer/js/jqueryUI.js"></script>

  <link rel="stylesheet" type="text/css" href="css/sidebar.css">
  <link rel="stylesheet" type="text/css" href="css/sticktbtn.css">


<!--   <link rel="stylesheet" type="text/css" href="css/form.css"> -->

  <!-- alert -->

  <!-- pop up modal -->

  <!-- For Table -->
   
  <!-- font -->
  <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

  <!-- UPLOAD WITH PREV -->
  <link rel="stylesheet" type="text/css" href="css/upload.css">
  <!-- DIALOG -->

  <link rel="stylesheet" type="text/css" href="css/dialog.css">
</head> 
<body>

<aside>

  <a>
  <svg version="1.1" id="nav-btn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
    <path id="list-view-icon" d="M462,108.857H50V50h412V108.857z M462,167.714H50v58.857h412V167.714z M462,285.429H50v58.857h412
   V285.429z M462,403.143H50V462h412V403.143z"/>
  </svg>
</a>

  <h1 class="forh1" style=" font-family: 'Pacifico', cursive; font-size: 30px;">Angel's Cupcake</h1>
 
  <nav id="nav">
    <ul>
       <li id="parentDashboard"><a href="#." id=""><strong><i class="icon-dashboard"></i> Dashboard</strong></a></li>
        <div class="dasboard">
          <li><a href="home.php" id=""> Booking</a></li>
          
        </div>

      <li id="parentProductManagement"><a href="#."><strong><i class="icon-food"></i> Product </strong></a></li>
        <div class="productManagement">
          <li><a href="product.php" id=""> Product Management</a></li>
          
        </div>
      <li id="parentAccountManangement"><a href="#." id="" ><strong><i class="icon-user"></i> Account </strong></a></li>
         <div class="accountManagement">
            <li><a href="account.php" id=""> Account Management</a></li>
            <li><a href="#" id=""  > Help</a></li>
        </div>

      <li><a class="btn btn-primary" href="process/logout.php"  style="margin-top: 80px; background-color: #37474f; border: none;"><i class="icon-signout"></i> Logout</a></li>
    </ul>
  </nav>
 <br><br>

       
  <div class="vertical-line"></div>
  
</aside>
  


    
<!-- PARA SA TABLE -->

   
<article>

  <main>



  <div class="container">
        <div class="row">
        	<div class="col col-md-12">
		          <ul class="head">
		          	<li><h1><b><img src="img/manual.png" width="50px"> GUIDE</b></h1></li>
		          	<li class="float-right"><a href="#manageacc">Manage Account</a></li>
		          	<li class="float-right"><a href="#manageproduct">Manage Product</a></li>
		          	<li class="float-right"><a href="#managebooking">Manage Booking</a></li>
		          </ul>

	        </div>
		          <hr>
			
					
				<!--Booking prooduct-->
				<div class="col col-md-12">
				<div class="guide" id="#managebooking">

			         <h4><b><img src="img/managebooking.png" width="50px"> Manage booking</b></h4>
			         <ul><strong>▶ Calendar Summary</strong>
			         	<li><b>-Purpose:</b> Summary of booked client.</li>
			         	<li>
			         		<b>-How to use Calendar:</b> 
			         		<ul>
			         			<li>1. Click which month/year want to view. </li>
			         			<li>2. Click the spefic day. </li>
			         			<li>3. It will <b>display</b>  the client details who booked that day. </li>
			         		</ul>
			         	</li>
			         </ul>

					  <ul><strong>▶ Open Booking</strong>
			          	<li><b>-Purpose:</b> Show list and number of clients who want to booked an order. You can also Search and Sort  Client.</li>
			         	<li>
			         		<b>-How to use Open Booking:</b> 
			         		<ul>
			         			<li>1. Navigate to open booking tab. </li>
			         			<li>2. Search/Navigate to a particular client. To display the order. click the "Ordres" button. It will display the products details (qty and total payment) and comments.</li>
			         			<li>3. Options. You can either <b>confirm/reject/cancel</b>  the clients request. Then it will be move to a particular tab which action you've choosen.</li>
			         			<li>4. The client will be informed thru email of which action you've taken.</li>
			         		</ul>
			         	</li>
			         </ul>


					 <ul><strong>▶ Confirm Booking</strong>
			          	<li><b>-Purpose</b>: Show list and number of clients who you've taken their order. You can also Search and Sort  Client.</li>
			         	<li>
			         		<b>-How to use Confirm Booking:</b> 
			         		<ul>
			         			<li>1. Navigate to confirm booking tab. </li>
			         			<li>2. Search/Navigate to a particular client. To display the order. click the "Ordres" button. It will display the products details (qty and total payment) and comments.</li>
			         			<li>3. Options. You can either <b>Cancel</b> their order or <b>Mark the order as finish</b> by clicking done button. Then it will be move to a particular tab which action you've choosen.</li>
			         			<li>4. The client will be informed thru email of which action you've taken.</li>
			         		</ul>
			         	</li>
			         </ul>


					 <ul><strong>▶ Cancel Booking</strong>
			          	<li><b>-Purpose:</b> Show list and number of clients who canceled / you've canceled order. You can also Search and Sort  Client.</li>
			         	<li>
			         		<b>-How to use Cancel Booking: </b>
			         		<ul>
			         			<li>1. Navigate to cancel booking tab. </li>
			         			<li>2. Search/Navigate to a particular client. To display the order. click the "Ordres" button. It will display the products details (qty and total payment) and comments.</li>
			         			
			         		</ul>
			         	</li>
			         </ul>


					   <ul><strong>▶ Reject Booking</strong>
			          	<li><b>-Purpose:</b> Show list and number of clients who you've rejected an order. You can also Search and Sort Client.</li>
			         	<li>
			         		<b>-How to use Reject Booking: </b>
			         		<ul>
			         			<li>1. Navigate to reject booking tab. </li>
			         			<li>2. Search/Navigate to a particular client. To display the order. click the "Ordres" button. It will display the products details (qty and total payment) and comments.</li>
			         			<li>3. Options. You can <b>Reconfirm</b> the client's order. Then it will be move to a Confirm tab.</li>
			         			<li>4. The client will be informed thru email of which action you've taken.</li>
			         		</ul>
			         	</li>
			         </ul>

			         <ul><strong>▶ Successful Booking</strong>
			          	<li><b>-Purpose:</b> Show list and number of clients who you've finish order. You can also Search and Sort  Client.</li>
			         	<li>
			         		<b>-How to use Successful Booking:</b> 
			         		<ul>
			         			<li>1. Navigate to successful booking tab. </li>
			         			<li>2. Search/Navigate to a particular client. To display the order. click the "Ordres" button. It will display the products details (qty and total payment) and comments.</li>
			         		</ul>
			         	</li>
			         </ul>
			

				</div>
			</div>

		
				<!--Manage prooduct-->
				<div class="col col-md-12">
				<div class="guide" id="manageproduct">
					<hr>
			         <h4><b><img src="img/manageproduct.png" width="50px"> Manage Product</b></h4><br>
			         <ul><strong>▶ Add Product Button</strong>
			         	<li><b>-Purpose:</b> Add products.</li>
			         	<li>
			         		<b>-How to use Add Product:</b> 
			         		<ul>
			         			<li>1. Click the button Add product. </li>
			         			<li>2. Enter details. (eg. Product name, price, description and upload image). </li>
			         			<li>3. Click Done button.</li>
			         			<li>4. It will display  <b>Successfully Add product</b>.</li>
			         		</ul>
			         	</li>
			         </ul>


			         <ul><strong>▶ Product table</strong>
			         	<li><b>-Purpose:</b> Show list of Product, Search , Sort, Update and Delete product.</li>
			         	<li>
			         		<b>-How to use Product table:</b> 
			         		<ul>
			         			<li><strong>• Sort and Search Product:</strong>
			         				<ul>
			         					<li>○ To sort. Just click the column which you want to sort.</li>
			         					<li>○ To Search. Just input something on the search bar.</li>
			         				</ul>
			         			</li>
			         			<li><strong>• Update Product:</strong>
			         				<ul>
			         					<li>1. Click the "+" on the first column of the table.</li>
			         					<li>2. Click the edit button.</li>
			         					<li>3. Enter details you want to update.</li>
			         					<li>4. Click the update button.</li>
			         					<li>5. It will pop up a dialogue saying <b>Successfully Updated / Product price must be numeric! / Product Name already Exist!</b>.</li>
			         				</ul>
			         			</li>
			         			<li><strong>• Delete Product:</strong>
			         				<ul>
			         					<li>1. Click the checkbox under the delete button column which product you want to delete.</li>
			         					<li>2. Click the Delete button.</li>
			         					<li>3. It will display <b>Successfully Delete!/Nothing to Delete!</b></li>
			         				</ul>
			         			</li>
			         		</ul>
			         	</li>
			         </ul>

			     </div>
			 </div>
			


				<!--Manage Account-->
					
				<div class="col col-md-12">
				<div class="guide" id="manageacc">
					<hr>
			         <h4><b><img src="img/accmgt.png" width="50px"> Manage Account</b></h4><br>


			         <ul><strong>▶ Add account Button</strong>
			         	<li><b>-Purpose:</b> Add account.</li>
			         	<li>
			         		<b>-How to Add Account:</b> 
			         		<ul>
			         			<li>1. Click the button Add account. </li>
			         			<li>2. Enter details. (eg. username, password and question and answer). </li>
			         			<li>3. Click Done button.</li>
			         			<li>4. It will display  <b>Successfully Add Account</b>.</li>
			         		</ul>
			         	</li>
			         </ul>


			          <ul><strong>▶ Account table</strong>
			         	<li><b>-Purpose:</b> Show list of Product, Search , Sort, Update and Delete product.</li>
			         	<li>
			         		<b>-How to use Product table:</b> 
			         		<ul>
			         			<li><strong>• Sort and Search Product:</strong>
			         				<ul>
			         					<li>○ To sort. Just click the column which you want to sort.</li>
			         					<li>○ To Search. Just input something on the search bar.</li>
			         				</ul>
			         			</li>
			         			<li><strong>• Update Account:</strong>
			         				<ul>
			         					<li>1. Click the "+" on the first column of the table.</li>
			         					<li>2. Click the edit button.</li>
			         					<li>3. Enter the password of the current logged in admin.</li>
			         					<li>4. Enter details you want to update.</li>
			         					<li>5. Click the update button.</li>
			         					<li>6. It will pop up a dialogue saying <b>Successfully Updated / Username already Exist! / Password did not match!</b>.</li>
			         				</ul>
			         			</li>
			         			<li><strong>• Delete Account:</strong>
			         				<ul>
			         					<li>1. Click the checkbox under the delete button column which product you want to delete.</li>
			         					<li>2. Click the Delete button.</li>
			         					<li>3. Enter password. Then click ok.</li>
			         					<li>4. It will display <b>Successfully Delete!/Nothing to Delete!</b></li>
			         				</ul>
			         			</li>
			         		</ul>
			         	</li>
			         </ul>
					 
					</div>
			     </div>
	        
    	</div>
    </div>



<button class="btn-primary btn" onclick="topFunction()" id="myBtn" title="Go to top">⧋ Top</button>

</main>
</article>


      

  </body>
  </html>


<script type="text/javascript" src="js/tableQueriesAccount.js"></script>
<script type="text/javascript" src="js/dropdownmenu.js"></script>



 <script>
//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>