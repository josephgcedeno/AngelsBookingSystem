<?php
  require_once('../run.php');
	session_start();

  if (isset($_SESSION['userclient'])) 
  {
      header('location: index.php');
      $_SESSION['counter']=1;
      
  }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign up</title>
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
                               <a href="#" id="dropdown" ><img src="img/user.png" width="30px" > '.$_SESSION['userclient'].'</a>
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
                                    <a href="login.php" style="color: white;">Sign in</a><br>
                                    <a href="signup.php" class="active" style="color: white;">Sign Up</a>
                                  </div>
                              </li>
                              ';  
                           }
                      ?>
                                                      
                </ul>   

            </div>
<!-- 







 -->
<!-- Default form register -->
<form action="process/insertClientData.php" method="POST">
  <div class="container">
    <div class="row">
      <div class="col s12"><span class="flow-text">
        <h1 style="color: #e57373"><b>SIGN UP</b></h1>
        <div class="divider"></div><br>
            <?php
                if (isset($_SESSION['respond'])) 
                { 
                  alerts($_SESSION['respond']);
                  unset($_SESSION['respond']);
                }
            ?>
        <h4 style="margin-top: 50px;"><b> Hello!</b></h4>
        <p style="font-size: 18px;">Enter your personal details and start your journey with us!</p>
    
        <div class="input-field col s12" style="margin-top: 30px;">
          <i class="material-icons prefix" style="color: #e57373">person</i>
          <input id="username" type="text" name="username" class="validate" required>
          <label for="username">Username<label>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix" style="color: #e57373">lock</i>
          <input id="password" type="password" name="password" class="validate" required>
          <label for="password">Password</label>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix" style="color: #e57373">check</i>
          <input id="confirm_password" type="password" name="copassword" class="validate" required>
          <label for="confirm_password">Confirm Password</label>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix" style="color: #e57373">person</i>
          <input id="full_name" type="text" name="fullname" class="validate" required>
          <label for="full_name">Full Name</label>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix" style="color: #e57373">people</i>
          <select name="gender">
            <option value="" disabled selected>Choose your option</option>
            <option value="F">Female</option>
            <option value="M">Male</option>
          </select>
          <label>Gender</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix" style="color: #e57373">place</i>
          <input id="address" type="text" name="address" class="validate" required>
          <label for="address">Address</label>
        </div>
        <div class="input-field col s12" style="margin-top: 30px;">
          <i class="material-icons prefix" style="color: #e57373">phone</i>
          <input id="phone" type="text" name="phoneno" class="validate" required>
          <label for="phone">Phone Number<label>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix" style="color: #e57373">account_box</i>
          <input id="fb_name" type="text" name="fbacc" class="validate" required>
          <label for="fb_name">Facebook Name</label>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix" style="color: #e57373">email</i>
          <input id="email" type="email" name="email" class="validate" required>
          <label for="email">Email</label>
        </div>
        <button class="waves-effect waves-light btn col s12 white-text" type="submit" name="signup" style="background-color: #e57373; margin-top: 30px;">Sign Up</button>
      </span></div>
    </div>
    </div>

    <!-- <div class="signup-box">
      <div class="col-md-12">
        

            <p class="h4 mb-4">Sign up</p>
         
           <input type="text" name="username" class="form-control mb-4" placeholder="Username" required>
            <input type="password" id="defaultRegisterFormEmail" name="password" class="form-control mb-4" placeholder="Password" required>


            <input type="password" id="defaultRegisterFormEmail" name="copassword" class="form-control mb-4" placeholder="Confirm password" required>
            <div class="form-row mb-4">
                <div class="col">
                   
                    <input type="text" id="defaultRegisterFormFirstName" name="fullname" class="form-control" placeholder="Full Name" required>
                </div>
                <div class="col">

                    <input type="text" id="defaultRegisterFormLastName" name="fbacc" class="form-control" placeholder="Facebook Name" required>
                </div>
            </div> -->

            <!-- E-mail -->
            <!-- <input type="email" id="defaultRegisterFormEmail" name="email" class="form-control mb-4" placeholder="E-mail" required>


            <input type="text" id="defaultRegisterFormEmail" name="address" class="form-control mb-4" placeholder="Address" required>
            <div class="form-row mb-4">
              <div class="col">
                  <input type="text" id="defaultRegisterFormEmail" name="phoneno" class="form-control mb-4" placeholder="Phone number" required>
              </div>
              <div class="col">
                   <select type="option" class="custom-select  mb-4 " id="ques1" name="gender">
                                         <option value="F">Female</option>
                                         <option value="M">Male</option>
                  </select>
                
              </div>
           </div> -->
            <!-- Sign up button -->
            <!-- <button class="btn btn-info my-4 btn-block" id="btnsubmit" type="submit" name="signup">Sign in</button>

           </div>       



           </div> -->
</form>
</body>
</html>

 <script type="text/javascript">
      $(document).ready(()=>
      {




           $(`input[name=phoneno]`).on('input',()=>
            {     

                  let phnumber=$(`input[name=phoneno]`).val();
                  let validNo1=phnumber[0]+phnumber[1];
                  let validNo2=phnumber[0]+phnumber[1]+phnumber[2]+phnumber[3];
                  if ((!$.isNumeric($(`input[name=phoneno]`).val()) || ($.isNumeric($(`input[name=phoneno]`).val()) && String(validNo1)!='09'  && String(validNo2)!='+639' ))  || 
                     ($.isNumeric($(`input[name=phoneno]`).val()) && String(validNo1)=='09' && $(`input[name=phoneno]`).val().length<11)  ||  
                     ($.isNumeric($(`input[name=phoneno]`).val()) && String(validNo2)=='+639' && $(`input[name=phoneno]`).val().length<13 ) || 
                     ($.isNumeric($(`input[name=phoneno]`).val()) && validNo1=='09' &&  $(`input[name=phoneno]`).val().length>11 )          || 
                     ($.isNumeric($(`input[name=phoneno]`).val()) && validNo2=='+639' &&  $(`input[name=phoneno]`).val().length>13)
                     )
                  {
                     $('input[name=phoneno]').css({"border":"1px solid red","border-radius":"5px","outline-color": "red"});  
                      $(`#btnsubmit`).prop('disabled',true);
                  }
                  else
                  {
                      $(`#btnsubmit`).prop('disabled',false);
                      $('input[name=phoneno]').removeAttr("style"); 
                     
                  }
                    
               
            });

          $(`#dropdown`).on('click',()=>
          { 
              $(`.menus`).slideToggle('fast');
          });
          $(`.close`).on('click',function()
          {
              $(`.alert`).hide(); //ALERT HIDER

          })



      });

      document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('select').formSelect();
  });



    </script>