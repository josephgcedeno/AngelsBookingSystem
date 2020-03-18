<?php

  session_start();
?>
<!DOCTYPE html>
<html>


<head>
	<title>About Us</title>
	  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../importer/css/bootstrap.min.css">
  <script src="../importer/js/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- font -->
  <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="https://kit.fontawesome.com/bf8ae02d96.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/loading.css">
  <link rel="stylesheet" href="css/about.css">
  <link rel="stylesheet" href="css/cancel.css">
  <link rel="stylesheet" href="css/list.css">

</head>
<body>


 <div id="header"> 
                <ul>
                    <li><a href="index.php">Cupcakes</a></li>
                    <li><a href="cancelorder.php">Cancel Order</a></li>
                    <li><a href="#" class="active">About</a></li>
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
        <div class="row">
          <div class="col s12">
            <h1 class="title flow-text"><b>HELLO!</b></h1>
            <p class="story">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <i class="fab fa-facebook-square"><span><a href=""> <b>Angel's Cupcake</b></a></span></i>
            <br>
            <i class="fas fa-envelope"> <span>angelscupcake6@gmail.com</span></i>
            <br>
            <i class="fas fa-phone"> <span>+639330522174</span></i>
            <br>
            <i class="fas fa-map-marker-alt"> <span>Panabo, Davao City, Philippines</span></i>
          </div>
          <div class="col s1 offset-s1">
            <div class="card" style="margin-top: 50px;">
              <div class="card-image">
                <img src="img/avatar.jpg">
              </div>
              <div class="card-content">
                <h5>Irene Seekins</h5>
                <p>Owner</p>
              </div>
            </div>
          </div>
        </div>
    </div>

</body>
</html>
<script type="text/javascript">
  
  $(document).ready(()=>
  {

 


    $(`#dropdown`).on('click',()=>
    { 
        $(`.menus`).slideToggle('fast');
    });
    $(`.close`).on('click',function()
    {
        $(`.alert`).hide(); //ALERT HIDER

    })


  });
</script>