<?php
  require_once('../run.php');
	session_start();

  if (isset($_SESSION['userclient'])) 
  {
      header('location: account.php');
      $_SESSION['counter']=1;
  }


?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign in</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../importer/css/bootstrap.min.css">
  <script src="../importer/js/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- font -->
  <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/loading.css">
  <link rel="stylesheet" href="css/cancel.css">
  <link rel="stylesheet" href="css/list.css">
</head>
<body>

   <div id="header"> 
                <ul>
                    <li><a href="index.php">Cupcakes</a></li>
                    <li><a href="cancelorder.php">Cancel Order</a></li>
                    <li><a href="about.php" >About</a></li>
                    <li><a href="help.php">How to Order</a></li>   
                    <li class="float-right">
                      <?php if(isset($_SESSION['userclient']))
                           { 
                               echo' 
                               <a href="#" id="dropdown"><img src="img/user.png" width="30px" > '.$_SESSION['userclient'].'</a>
                                      <div class="menus" style="display:none; padding: 20px; border-radius:5px;  background-color: #e57373;  font-size:30px; position:absolute">
                                    <a href="edit.php" style="color: white;">Profile</a><br>
                                    <a href="process/logout.php" style="color: white;">Log out</a>
                                  </div>
                              </li>';             
                           }
                           else
                           {
                              echo' 
                              <a href="#" id="dropdown"><img src="img/user.png" width="30px" > Login</a>
                                    <div class="menus" style="display:none; padding: 20px; border-radius:5px;  background-color: #e57373;  font-size:30px; position:absolute">
                                    <a href="login.php" class="active" style="color: white;">Sign in</a><br>
                                    <a href="signup.php" style="color: white;">Sign Up</a>
                                  </div>
                              </li>
                              ';  
                           }
                      ?>
                                                      
                </ul>   

            </div>

<!-- Default form register -->
<form action="process/validate.php" method="POST">
  <div class="container">
    <div class="row">
      <div class="col s12"><span class="flow-text">
        <h1 style="color: #e57373"><b>SIGN IN</b></h1>

        <div class="divider"></div><br>
         <?php
                if (isset($_SESSION['respond'])) 
                { 
                  alerts($_SESSION['respond']);
                  unset($_SESSION['respond']);
                }

            ?>
        <h4 style="margin-top: 50px;"><b> Hello!</b></h4>
        <p style="font-size: 18px;">Login with your personal info.</p>
        <div class="input-field col s6" style="margin-top: 30px;">
          <i class="material-icons prefix" style="color: #e57373">person</i>
          <input id="email" type="text" class="validate" name="username" value="<?php if(isset($_COOKIE['usernameclient'])) { echo $_COOKIE['usernameclient']; } ?>" required>
          <label for="email">Email or Username<label>
        </div>
        <div class="input-field col s6" style="margin-top: 30px;">
          <i class="material-icons prefix" style="color: #e57373">lock</i>
          <input type="password" id="defaultRegisterFormEmail" name="password" value="<?php if(isset($_COOKIE['passwordclient'])) { echo $_COOKIE['passwordclient']; } ?>" class="validate" required>
          <label for="defaultRegisterFormEmail">Password</label>
        </div>
        <p>
          <label>
            <input type="checkbox" id="remember-me" name="remember" <?php if(isset($_COOKIE["usernameclient"])) { ?> checked <?php } ?> />
            <span>Remember Me?</span>
          </label>
        </p>
        <button type="submit" class="waves-effect waves-light btn col s12 white-text" style="background-color: #e57373;"  name="signin">Log In</button>
        <p style="font-size: 14px; margin-top: 100px;">No account? <a href="signup.php" style="color: #4db6ac;">Sign up</a> here!</p>
      </span></div>
    </div>
    </div>
  </div>
 

           </div>
</form>

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