<?php

  session_start();
  require_once('../run.php');
  if (!isset($_SESSION['user'])) {
    header('location: ../login/login.php');
  }

  $arrayColoumns=['id','client_fullname','client_fbname','client_email','client_phonenumber','client_status','client_expense','client_ordered','client_expectedD','product_name','product_price','client_id','product_id','quantity','comments'];
  $gfdb->makeDataFromDatabaseToJasonFormat(
"SELECT
c.id,c.client_fullname,c.client_fbname,c.client_email,c.client_phonenumber,c.client_status,c.client_expense,c.client_ordered,c.client_expectedD ,
b.product_name,b.product_price, r.client_id,r.product_id,r.quantity,r.comments
FROM  pm_client_bridge r
INNER JOIN pm_product b ON r.product_id=b.id
INNER JOIN pm_client c ON r.client_id = c.id ",$arrayColoumns,15,"../backend/js/productsNComment.json"
        ); // FOR THE ORDERS OPTION

  $_SESSION['cols']=['id','client_fullname','client_fbname', 'client_email','client_phonenumber','client_status','client_expense','client_ordered','client_expectedD']; 

  $gfdb->makeDataFromDatabaseToJasonFormatForTable("SELECT *  FROM pm_client WHERE client_status='open' ",  $_SESSION['cols'], 9, "../backend/js/value.json");

  $gfdb->makeDataFromDatabaseToJasonFormat("SELECT *  FROM pm_client WHERE client_status='confirm' ",  $_SESSION['cols'], 9, "../backend/js/calendar.json");



  
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="css/sidebar.css">
  <link rel="stylesheet" type="text/css" href="css/tabbed.css">
  <link rel="stylesheet" type="text/css" href="css/calendar.css">
  
  <link rel="stylesheet" type="text/css" href="css/checkboxdesign.css">
  <link rel="stylesheet" type="text/css" href="css/table.css">



  <!-- alert -->
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- pop up modal -->
<link rel="stylesheet" type="text/css" href="css/pop.css">
  <!-- For Table -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/change.js"></script>


</head> 
<body>

<aside>
  <a>
  <svg version="1.1" id="nav-btn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
    <path id="list-view-icon" d="M462,108.857H50V50h412V108.857z M462,167.714H50v58.857h412V167.714z M462,285.429H50v58.857h412
   V285.429z M462,403.143H50V462h412V403.143z"/>
  </svg>
</a>

  <h1>Angel's Cupcake</h1>
     
  <span id="dashboard" class="col-sm-4" style="cursor: pointer; position:  color: white">Dashboard</span> 
  <nav id="nav1">
    <ul>
      <li><a href="#" id=""></a></li>
      <li><a href="#" id="" >Customer Options</a></li>
      <li><a href="#" id="" >Contacts</a></li>
    </ul>
  </nav>

 
  <span id="products" class="col-sm-4" style="cursor: pointer; color: white; ">Cupcake</span>  
    <nav id="nav2">
    <ul>
      <li><a href="#" id=""></a></li>
      <li><a href="#" id="">Customer Options</a></li>
      <li><a href="#" id="">Contacts</a></li>
    </ul>
  </nav> 

 <span id="options"class="col-sm-4"  style="cursor: pointer; color: white; ">Options</span>  

    <nav id="nav3">
    <ul>
      <li><a href="#" id=""></a></li>
      <li><a href="#" id="">Customer Options</a></li>
      <li><a href="#" id="">Contacts</a></li>
    </ul>
  </nav> 

  

 <br><br>

        <li><a href="process/logout.php">Logout</a></li>
  <div class="vertical-line"></div>
  
</aside>
  


    
<!-- PARA SA TABLE -->

   
<article>

  <main>


 <?php
        if (isset($_SESSION['result'])) 
        { 
          alerts($_SESSION['result']);
        }


    ?>



<div class="month">      
  <ul>
    <li class="prev" >&#10094;</li>
    <li class="next" >&#10095;</li>
    <li>
     <strong><select class="custom-select control-form" style="width: 20%; font-size: 20px; font-style:bold; margin-top: 10px  background-color: #82caff;"  id="selected"></strong>
                           <option value="0">Jan</option>
                           <option value="1">Feb</option>
                           <option value="2">March</option>
                           <option value="3">April</option>
                           <option value="4">May</option>
                           <option value="5">June</option>
                           <option value="6">July</option>
                           <option value="7">August</option>
                           <option value="8">Sept</option>
                           <option value="9">Oct</option>
                           <option value="10">Nov</option>
                           <option value="11">Dec</option>
              </select><br>



      <span style="font-size:18px"><center><input type="text" style="margin-top: 10px; font-size: 20px; outline: none" placeholder="Enter Year..." id="year"></center></span>
    </li>
  </ul>
</div>

<ul class="weekdays">
  <li id="su" value="0">Su</li> 
  <li id="mo" value="1">Mo</li>
  <li id="tu" value="2">Tu</li>
  <li id="we" value="3">We</li>
  <li id="th" value="4">Th</li>
  <li id="fr" value="5">Fr</li>
  <li id="sa" value="6">Sa</li>
</ul>

<ul class="days" id="days">  
 
</ul>
  
      <div id="myModal" class="modal">
                <div class="modal-content">
                  <div class="modal-header">
                    <center><h2>Orders & Comment</h2></center>
                  </div>
                  <div class="modal-body">
                  </div>
                  <div class="modal-footer">
                  </div>
      </div>

  </main>

</article>



<!-- PARA SA TAB.X -->
<article>
<main>


  
  <input id="tab1" type="radio" name="tabs" value="open" checked>
  <label for="tab1">Open Booking</label>
    
  <input id="tab2" type="radio" name="tabs" value="confirm">
  <label for="tab2">Confirm Booking</label>
    
  <input id="tab3" type="radio" name="tabs" value="reject">
  <label for="tab3">Rejected Booking</label>
    
  <input id="tab4" type="radio" name="tabs" value="done">
  <label for="tab4">Successful Booking</label>
    
  <section id="content1">

    
   <form method="POST" action="process/tableRequest.php">
      <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client Name</th>
                    <th>Contact Details</th>
                    <th>Ordered in - Expected on</th>
                    <th>Orders</th>
                    <th>Open Booking</th>
                   
                </tr>
            </thead>
            <tfoot>
              <tr>
                    <th>ID</th>
                    <th>Client Name</th>
                    <th>Contact Details</th>
                    <th>Ordered in - Expected on</th>
                    <th>Orders</th>
                    <th>Open Booking</th>
                
              </tr>
            </tfoot>
      
        </table>
     </form>

        <div id="myModal" class="modal">
          <div class="modal-content">
            <div class="modal-header">
              <center><h2>Orders & Comment</h2></center>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
            </div>
        </div>

  </section>



    
  <section id="content2"></section>
  <section id="content3"></section>
  <section id="content4"></section>
    
</main>
</article>



</body>
</html>


  <script type="text/javascript" src="js/calendar.js"></script>


 
  <script src="js/sidebar.js"></script>



  <script type="text/javascript">



  /*   $(document).ready(function()
   {
      $(`#nav1`).hide();
      $(`#nav2`).hide();
      $(`#nav3`).hide();
        $('#dashboard').on('click',function()
        {
            $(`#nav1`).toggle();
        
        });

        $('#products').on('click',function()
        {
            $(`#nav2`).toggle();
        
        });
        $('#options').on('click',function()
        {
            $(`#nav3`).toggle();
        
        });
    });*/
  </script>
    <script type="text/javascript" src="js/tableQueries.js"></script>
