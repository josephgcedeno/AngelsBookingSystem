<?php

  session_start();
?>
<!DOCTYPE html>
<html>


<head>
  <title>How to Order</title>
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
  <link rel="stylesheet" href="css/help.css">
  <link rel="stylesheet" href="css/cancel.css">
  <link rel="stylesheet" href="css/list.css">

</head>
<body>


 <div id="header"> 
                <ul>
                    <li><a href="index.php">Cupcakes</a></li>
                    <li><a href="cancelorder.php">Cancel Order</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="#" class="active">How to Order</a></li> 
                    <li class="float-right">
                      <?php if(isset($_SESSION['userclient']))
                           { 
                               $usernametoDisplay=explode('@', $_SESSION['userclient']);
                               echo' 
                               <a href="#" id="dropdown"><img src="img/user.png" width="30px" > '.$usernametoDisplay[0].'</a>
                                    <div class="menus" style="display:none; padding: 20px; border-radius:5px;  background-color: #e57373; font-size:30px; position:absolute">
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
        <div class="col s12"><span class="flow-text">
          <h1><b>HOW TO ORDER</b></h1>
          <div class="divider"></div>
          <div class="steps">
          <p style="font-size: 1.17em; margin-top: 40px; margin-bottom: 20px;"><b>USING AN ACCOUNT</b></p>
          <p>1. If you have an account already, click <b>Login</b> in the menu bar and sign in.</p>
          <p style="font-size: 15px; margin-left: 20px;">• If you don't have an account yet, <a href="signup.php"><em>click here.</em></a></p>
          <p>2. After logging in, click <b>Cupcakes</b> in the menu bar to see the lists of items available.</p>
          <p>3. Click <b>Add to Cart</b> if you have found your desired product.</p>
          <p>4. Check <b>My Cart</b> to see the lists of your orders and click <b>Checkout</b>.</p>
          <p>5. Choose a book date and then proceed.</p>
          <p>6. You will be redirected to your online receipt.</p>

          <p class="notes"><em style="color: #e57373;">Notes:<br></em>You will receive a message in your email with your cancelation code and our contact details.<br>You can't cancel an order once it's confirmed.<br>An email will also be sent once your order is either confirmed, rejected, canceled, or done.</p>

          <div class="divider" style="margin-top: 50px;"></div>

          <p style="font-size: 1.17em; margin-top: 50px; margin-bottom: 20px;"><b>AS A GUEST</b></p>
          <p>1. Click <b>Cupcakes</b> in the menu bar to see the lists of items available.</p>
          <p>2. Click <b>Add to Cart</b> if you have found your desired product.</p>
          <p>3. Check <b>My Cart</b> to see the lists of your orders and click <b>Checkout</b>.</p>
          <p>4. Choose <b>Continue as guest</b>, if you don't want to create an account.</p>
          <p>5. Fill up the form and then proceed.</p>
          <p>6. You will be redirected to your online receipt.</p>

          <p class="notes"><em style="color: #e57373;">Notes:<br></em>You will receive a message in your email with your cancelation code and our contact details.<br>You can't cancel an order once it's confirmed.<br>An email will also be sent once your order is either confirmed, rejected, canceled, or done.</p>

          <h6><em>For more inquiries, visit our<a href="about.php"><b> About</b></a> page.</em></h6>
          </div>
        </span></div>
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