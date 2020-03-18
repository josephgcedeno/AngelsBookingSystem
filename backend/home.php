<?php

  session_start();
  require_once('../run.php');
  if (!isset($_SESSION['user'])) {



  $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
                $_SERVER['REQUEST_URI']; 
  


   $_SESSION['req']=$link;
  
    header('location: ../backend/login.php');
  }

  $arrayColoumns=['id','client_fullname','client_fbname','client_email','client_phonenumber','client_status','client_expense','client_ordered','product_name','product_price','client_id','product_id','quantity','comments'];

  $_SESSION['cols']=['id','client_fullname','client_fbname', 'client_email','client_phonenumber','client_status','client_expense','client_ordered']; 


  
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="../importer/js/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="css/sidebar.css">
  <link rel="stylesheet" type="text/css" href="css/tabbed.css">
  <link rel="stylesheet" type="text/css" href="css/calendar.css">
  <link rel="stylesheet" type="text/css" href="css/loading.css">
  
  <link rel="stylesheet" type="text/css" href="css/checkboxdesign.css">
  <link rel="stylesheet" type="text/css" href="css/table.css">

<!-- badge -->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <!-- alert -->
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <!-- pop up modal -->
<link rel="stylesheet" type="text/css" href="css/pop.css">
  <!-- For Table -->
  <link rel="stylesheet" type="text/css" href="../importer/css/jquery.dataTables.min.css">
  <script type="text/javascript" src="../importer/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/change.js"></script>
  <!-- font and icon -->
  <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

</head> 
<body>

<aside>
  <a>
  <svg version="1.1" id="nav-btn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
    <path id="list-view-icon" d="M462,108.857H50V50h412V108.857z M462,167.714H50v58.857h412V167.714z M462,285.429H50v58.857h412
   V285.429z M462,403.143H50V462h412V403.143z"/>
  </svg>
</a>

  <h1  class="forh1" style=" font-family: 'Pacifico', cursive; font-size: 30px;">Angel's Cupcake</h1>
 
  <nav id="nav">
    <ul>
      <li id="parentDashboard"><a href="#." id=""><strong><i class="icon-dashboard"></i> Dashboard</strong></a></li>
        <div class="dasboard">
          <li><a href="#" id=""> Booking</a></li>
          
        </div>

      <li id="parentProductManagement"><a href="#."><strong><i class="icon-food"></i> Product </strong></a></li>
        <div class="productManagement">
          <li><a href="product.php" id=""> Product Management</a></li>
          
        </div>
      <li id="parentAccountManangement" ><a href="#." id="" ><strong><i class="icon-user"></i> Account </strong></a></li>
        <div class="accountManagement">
            <li><a href="account.php" id=""> Account Management</a></li>
            <li><a href="guide.php" id=""  > Help</a></li>
        </div>

      <li><a class="btn" href="process/logout.php" style="margin-top: 80px; background-color: #37474f; color: white;"><i class="icon-signout"></i> Logout</a></li>
    </ul>
  </nav>
 <br><br>

       
  <div class="vertical-line"></div>
  
</aside>
  


    
<!-- PARA SA TABLE -->

   
<article>
  <main>


 <?php
        if (isset($_SESSION['result'])) 
        { 
          alerts($_SESSION['result']);
          unset($_SESSION['result']);
        }


    ?>

 <div class="loading" style="position: absolute;"><img src="img/cupcake.gif"><h3 class="fonts">Angel's Cupcake</h3></div>
  <div class="centered">
        <div id="myModal1" class="col-md-12 modal">
                <!-- Modal content -->
                <div class="modal-content">
                  <div class="modal-header">
                    <span class="close">&times;</span>
                  </div>
                  <div class="modal-body">
                    
                  </div>
                  <div class="modal-footer"></div>
                </div>
          </div>
  </div>

  
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



      <span style="font-size:18px"><center><input type="text" style="margin-top: 10px; font-size: 20px; outline: none; color: white;" placeholder="Enter Year..." id="year"></center></span>
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
  


  
    
         

  </main>

</article>



<!-- PARA SA TAB.X -->
<article>
<main>
<!-- Button trigger modal -->
<?php
 
      $totalopen=
      $gfdb->resultRowAsArrayAll2("
      SELECT COUNT(*) as open
      FROM  
      pm_client c
      WHERE 
      c.client_status='open'
      ");
      $totalconfirm=
      $gfdb->resultRowAsArrayAll2("
      SELECT COUNT(*) as confirm
      FROM  
      pm_client c
      WHERE 
      c.client_status='confirm'
      ");
      $totalcancel=
      $gfdb->resultRowAsArrayAll2("
      SELECT COUNT(*) as cancel
      FROM  
      pm_client c
      WHERE 
      c.client_status='cancel'
      ");
      $totalreject=
      $gfdb->resultRowAsArrayAll2("
      SELECT COUNT(*) as reject
      FROM  
      pm_client c
      WHERE 
      c.client_status='reject'
      ");
      $totaldone=
      $gfdb->resultRowAsArrayAll2("
      SELECT COUNT(*) as done
      FROM  
      pm_client c
      WHERE 
      c.client_status='done'
      ");

?>

  <div class="tabs">
  <input id="tab1" type="radio" name="tabs" value="open" checked>
  <label for="tab1">Open Booking  <span class="w3-badge w3-red" style=" background-color:#0099CC !important"><?php echo $totalopen['open']; ?></span></label>
    
  <input id="tab2" type="radio" name="tabs" value="confirm">
  <label for="tab2">Confirmed Booking <span class="w3-badge w3-red" style=" background-color:#0099CC !important"><?php echo $totalconfirm['confirm']; ?></span></label>

  <input id="tab5" type="radio" name="tabs" value="cancel">
  <label for="tab5">Canceled Booking <span class="w3-badge w3-red" style=" background-color:#0099CC !important"><?php echo $totalcancel['cancel']; ?></span></label>

    
  <input id="tab3" type="radio" name="tabs" value="reject">
  <label for="tab3">Rejected Booking <span class="w3-badge w3-red" style=" background-color:#0099CC !important"><?php echo $totalreject['reject']; ?></span></label>
    
  <input id="tab4" type="radio" name="tabs" value="done">
  <label for="tab4">Successful Booking <span class="w3-badge w3-red" style=" background-color:#0099CC !important"><?php echo $totaldone['done']; ?></span></label>
  

      <div class="card">
          <div class="card-body">
          <section id="content1"></section>
          <section id="content2"></section>
          <section id="content3"></section>
          <section id="content4"></section>
          <section id="content5"></section>
     </div>
   </div>
   </div>




<!-- Modal -->
</main>
</article>



</body>
</html>


  <script src="js/sidebar.js"></script>
 <script type="text/javascript" src="js/tableQueriesBooking.js"></script>
<script type="text/javascript" src="js/dropdownmenu.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
