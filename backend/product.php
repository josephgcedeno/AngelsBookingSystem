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
  <title>Product Management</title>

  <!-- tooltip -->
  <link rel="stylesheet" href="/resources/demos/style.css">

<!-- tooltip -->
  <link rel="stylesheet" type="text/css" href="../importer/css/bootstrap.min.css">
  <script src="../importer/js/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/sidebar.css">
<!--   <link rel="stylesheet" type="text/css" href="css/form.css"> -->
  <link rel="stylesheet" type="text/css" href="css/table.css">
  <!-- alert -->
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- pop up modal -->
  <link rel="stylesheet" type="text/css" href="css/pop.css">
  <!-- For Table -->
  <link rel="stylesheet" type="text/css" href="../importer/css/jquery.dataTables.min.css">
  <script type="text/javascript" src="../importer/js/jquery.dataTables.min.js"></script>

  <script type="text/javascript" src="js/sidebar.js"></script>
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
          <li><a href="#" id=""> Product Management</a></li>
          
        </div>
      <li id="parentAccountManangement"><a href="#." id="" ><strong><i class="icon-user"></i> Account </strong></a></li>
         <div class="accountManagement">
            <li><a href="account.php" id=""> Account Management</a></li>
            <li><a href="guide.php" id=""  > Help</a></li>
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




    <div class="text-center py-4">
      <button class="btn btn-outline-success btn-lg" id="toshowadd"> Add Product</button>
    </div>

     <?php
        if (isset($_SESSION['result'])) 
        { 

          alerts($_SESSION['result']);
          unset($_SESSION['result']);
        }


    ?>
   
			   <form action="process/insert.php" method="POST" enctype="multipart/form-data" id="addproduct">
                      <div class="card near-moon-gradient form-white">
                <div class="card-body">
                   <div class="row">


                        <div class="col-md-8 md-form">
                          <div class="form-group">
                            <label>Insert product name: </label>
                            <input type="text" class="form-control" placeholder="Enter product name..." name="pname">
                          </div>
                        </div>


                        <div class="col-md-4 md-form">
                            <div class="form-group">
                              <label>Insert product price: </label>
                              <input type="text" class="form-control"  placeholder="Enter product price..." name="pprice" title="Input must be Numeric!">
                            </div>
                        </div>


                        <div class="col-md-12 md-form">
                            <div class="form-group">
                              <label>Description: </label>
                              <textarea type="text" class="form-control" placeholder="Description..." name="pdescription" cols="10" rows="10"></textarea> 
                            </div>
                         </div>

                    
                    
                     <div class="col-md-6 mb-4">
                        <div class="md-form">
                            <span>Upload Image</span>
                            <div id='img_contain'>
                              <img id="image01" align='middle' width="200px" src="../pimage/icons/preview.png" alt="your image" title=''/>
                            </div> 
                            <div class="input-group"> 
                               <div class="custom-file">
                                  <input type="file" id="inputGroupFile01" name="images" class="imgInp custom-file-input" aria-describedby="inputGroupFileAddon01">
                                  
                                   <button type="button" class="btn-outline-primary btn">
                                    <label class="custom-file1-label" for="inputGroupFile01"><strong>
                                            <i class="fa fa-upload"></i> Upload
                                          </strong></label> 
                                    </button>

                               </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                       <div class="md-form">
                        
                              <span>Upload Image</span><br>
                              <div id='img_contain'><img id="image02" align='middle' width="200px" src="../pimage/icons/preview.png" alt="your image" title=''/></div> 
                              <div class="input-group"> 
                              <div class="custom-file">
                                <input type="file" id="inputGroupFile02" name="images2" class="imgInp custom-file-input" aria-describedby="inputGroupFileAddon02">
                               
                                  <button type="button" class="btn-outline-primary btn">
                                     <label class="custom-file2-label" for="inputGroupFile02"> 
                                          
                                          <strong>
                                            <i class="fa fa-upload"></i> Upload
                                          </strong>
                                     </label>
                                   </button>
                              </div>
                              </div>
                      </div>
                    </div>
                     </div> 

                  <div class="text-center py-4">
                <button class="btn btn-outline-primary btn-lg" name="addP" id="proceedbtn" disabled>Done</button>
                  </div>


                    </div>
          </div>

              </form>
        
    
    				
			

		<form action="process/delete.php" method="POST" id="showproduct">
         <div class="card">
              <div class="card-body">

    <div id="modalForUpdatePrompt" class="modal">

          <!-- Modal content -->
          <div class="alert1 alert-success" role="alert1">
            <span class="close">&times;</span>
            Successfully Updated!
        
            </div>

      </div>
			<table id="example" class="table table-striped" >
		        <thead>
		            <tr>
		                <th width="0.1px">Extra Information</th>
		                <th><i class="fa fa-shopping-cart"></i> Product Name</th>
		                <th>₱ Product Price</th>
		                <th style="text-align: center !important;"><button type="submit" name="deletebtn" onclick="return confirm('Do you realy want to delete this product/s?')" class="btn btn-danger "  id="delAccount"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></th>
		               
		            </tr>
		        </thead>

            <tbody>

                  <tr>
                   <td colspan="4">
                       <div class="text-center spinnerni" >
                            <div class="spinner-border" style=" padding:65px; width: 1rem; height: 1rem;" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                        </div>
                    </td>
                  </tr>
                </tbody>
		        <tfoot>
		        	<tr>
		        		    <th>Extra Information</th>
		                <th><i class="fa fa-shopping-cart"></i> Product Name</th>
		                <th>Product Price</th>
		                <th>Option</th>
		               
		        		
		        	</tr>
		        </tfoot>
      
   		 	</table>

       </div>
     </div>


		</form>



</main>
</article>


			

	</body>
	</html>

  <script type="text/javascript" src="js/tableQueriesProducts.js"></script>
	  <script type="text/javascript" src="js/upload.js"></script>
<script type="text/javascript" src="js/dropdownmenu.js"></script>

 <script type="text/javascript">
   
  $(document).ready(()=>
  {
    $(`input[name=pprice]`).on('input',()=>
    { 
      if(!$.isNumeric($(`input[name=pprice]`).val()))
      {
            $(`input[name=pprice]`).css({"border":"1px solid red","border-radius":"5px","outline-color": "red"});
            $(`#proceedbtn`).prop('disabled',true);  
            $(`input[name=pprice]`).tooltip();

      }
      else
      {
            $(`input[name=pprice]`).removeAttr("style");
              $(`#proceedbtn`).prop('disabled',false); 
      }

    });

    $(`#toshowadd`).on('click',()=>
    {   
      
        if ($(`#toshowadd`).text()==' Add Product') 
        {
           $(`#toshowadd`).text('Show Product');
           $(`#showproduct`).hide();
           $(`#addproduct`).fadeIn("");
        }
        else
        {
           $(`#toshowadd`).text(' Add Product');
           $(`#addproduct`).hide();
           $(`#showproduct`).fadeIn("");
        }
        
     

    });


  });
  /*$.isNumeric( "-10" )*/


 </script>