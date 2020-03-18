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
  <script src="../importer/js/jqueryUI.js"></script>
  <script src="../importer/js/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="../importer/js/jqueryUI.js"></script>
  <script src="../importer/js/functions.js" ></script>
  

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
          <li><a href="product.php" id=""> Product Management</a></li>
          
        </div>
      <li id="parentAccountManangement"><a href="#." id="" ><strong><i class="icon-user"></i> Account </strong></a></li>
        <div class="accountManagement">
            <li><a href="#" id=""> Account Management</a></li>
            <li><a href="guide.php" id=""  > Help</a></li>
        </div>

      <li><a class="btn btn-primary" href="process/logout.php"  style="margin-top: 80px;"><i class="icon-signout"></i> Logout</a></li>
    </ul>
  </nav>
 <br><br>

       
  <div class="vertical-line"></div>
  
</aside>
  


    
<!-- PARA SA TABLE -->

   
<article>

  <main>




    <div class="text-center py-4">
      <button class="btn btn-outline-success btn-lg" id="toshowadd"> Add Account</button>
    </div>

     <?php
        if (isset($_SESSION['result'])) 
        { 

          alerts($_SESSION['result']);
          unset($_SESSION['result']);
        }


    ?>
   
         <form action="" method="POST" enctype="multipart/form-data" id="addproduct">
            <div class="card near-moon-gradient form-white">
                <div class="card-body">


                    <div class="user_form">
                         <div class="row">
                                <div class="col-md-12 md-form">
                                  <div class="form-group">
                                    <label>Username: </label>
                                    <input type="text" class="form-control" placeholder="Enter product name..." name="username" title="Username must be unique!">
                                  </div>
                                </div>


                                <div class="col-md-12 md-form">
                                    <div class="form-group">
                                      <label>Password: </label>
                                      <input type="password" class="form-control"   id="dapass" name="password" title="Password must be match!" >
                                    </div>
                                </div>

                                 <div class="col-md-12 md-form">
                                    <div class="form-group">
                                      <label>Confirm password: </label>
                                      <input type="password" class="form-control"  id="confirmdapass" title="Password must be match!" >
                                    </div>
                                </div>

                                  <div class="col-md-12 md-form">
                                      <div class="text-center py-4">
                                          <button type="button" class="btn btn-outline-primary btn-lg" id="nextbtn" disabled>Next</button>
                                      </div>
                                  </div>
                          </div>
                    </div>


                    <div class="security_form" style="display: none;">
                         <div class="row">
                          <div class="col-md-12 md-form">
                          <div class="alert alert-danger" role="alert" id="alerts"  style="display: none;">
                     <h4></h4>
                          <button type="button" class="close" style="margin-top: -30px;">×</button>
                   </div>
                 </div>
                                <div class="col-md-12 md-form">
                                  <div class="form-group">
                                    <label><strong>Select Security Question: </strong></label>
                                    <select type="option" class="custom-select control-form" id="ques1" name="ques1">
                                         <option value="0">What was your childhood nickname?</option>
                                         <option value="1">In what city did you meet your spouse/significant other?</option>
                                         <option value="2">What is the name of your favorite childhood friend?</option>
                                         <option value="3">What street did you live on in third grade?</option>
                                         <option value="4">What is your oldest sibling’s birthday month and year? (e.g., January 1900)</option>
                                        
                                   </select><br><br>
                                    <input type="text" class="form-control" placeholder="Enter your answer..." name="ans1">
                                  </div>
                                </div>


                                <div class="col-md-12 md-form">
                                    <div class="form-group">
                                      <label><strong>Select Security Question: </strong></label>
                                    <select type="option" class="custom-select control-form" id="ques2" name="ques1">
                                         <option value="0">What is the middle name of your youngest child?</option>
                                         <option value="1">What is your oldest siblings middle name?</option>
                                         <option value="2">What school did you attend for sixth grade?</option>
                                         <option value="3">What is your oldest cousins first and last name?</option>
                                         <option value="4">What was the name of your first stuffed animal?</option>
                                        
                                   </select><br><br>
                                      <input type="option" class="form-control"  placeholder="Enter your answer..." name="ans2">
                                    </div>
                                          
                                </div>

                                 <div class="col-md-12 md-form">
                                    <div class="form-group">
                                      <label><strong>Select Security Question: </strong></label>
                                    <select type="option" class="custom-select control-form" id="ques3" name="ques3">
                                         <option value="0">What time of the day were you born?</option>
                                         <option value="1">What was your dream job as a child?</option>
                                         <option value="2">What is the street number of the house you grew up in?</option>
                                         <option value="3">Who was your childhood hero?</option>
                                         <option value="4">What was the first concert you attended?</option>
                                        
                                   </select><br><br>
                                      <input type="option" class="form-control"  placeholder="Enter your answer..." name="ans3">
                                      </div>
                                </div>

                               






                                  <div class="col-md-12 md-form">
                                      <div class="text-center py-4">
                                          <button type="button" class="btn btn-outline-primary btn-lg" id="backbtn">Back</button>
                                          <button type="button" class="btn btn-outline-primary btn-lg" name="" id="inputtodb" >Done</button>
                                      </div>
                                  </div>
                          </div>
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
      <table id="example" class="table table-striped">
            <thead>
                <tr>
                    <th width="0.1px">Extra Information</th>
                    <th><i class="fa fa-user"></i> Username</th>
                    <th><i class="fa fa-lock"></i> Paasword</th>
                    <th style="text-align: center !important;"><button type="submit" name="deletebtnacc" 
                     <?php echo ' onclick="return askpassword(\''.$_SESSION['userpasssword'].'\' )" '?> class="btn btn-danger "  id="delAccount"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></th>
                   
                </tr>
            </thead>
            <tfoot>
              <tr>
                    <th>Extra Information</th>
                    <th><i class="fa fa-user"></i> Username</th>
                    <th><i class="fa fa-lock"></i> Paasword</th>
                    <th>Option</th>
                   
                
              </tr>
            </tfoot>
      
        </table>
        <input type="hidden" name="passwordthatholds" value="<?php echo $_SESSION['userpasssword']; ?>">
        <input type="hidden" name="usernamethatholds" value="<?php echo $_SESSION['user']; ?>">
       </div>
     </div>


    </form>



</main>
</article>


      

  </body>
  </html>


<script type="text/javascript" src="js/tableQueriesAccount.js"></script>
<script type="text/javascript" src="js/dropdownmenu.js"></script>

 <script type="text/javascript">
   
  $(document).ready(()=>
  {
    $(`#nextbtn`).prop('disabled', true);
    let username;
          $.ajax(
          {
            url:'process/jsonConverter.php',
            type:`POST`,
            data: 
            {
             sql: `SELECT username  FROM pm_account WHERE type='admin'`,
        
          
            },
            cache: false,
            success:(data)=>
            {
              var data= data.split("return$gfdbJSON$");
            
              username=jQuery.parseJSON(data[1]);
            }

        });


    $(`input[name=username]`).on('change',()=>
    {
            $(`#nextbtn`).prop('disabled', true);

        $.each(username, function(key, val) 
        {

              if (val.username == $(`input[name=username]`).val()) 
              {
                   $(`input[name=username]`).css({"border":"1px solid red","border-radius":"5px","outline-color": "red"});

              }
              else
              {
                   $(`input[name=username]`).removeAttr("style");
              }
         
           
        });

        if ($(`input[name=username]`).attr('style')==null && $(`#confirmdapass`).val()!='' && $(`#dapass`).val()!='' && $(`#confirmdapass`).val()==$(`#dapass`).val())
        {

            $(`#nextbtn`).prop('disabled', false);
                  $(`input[name=username]`).removeAttr("style");

        }
        else
        {
          
            $(`#nextbtn`).prop('disabled', true);

        }

    });
              

     $(`#dapass`).on('input',()=>
      {

            if ( $(`#confirmdapass`).val()!='' && $(`#dapass`).val()!='' && $(`#confirmdapass`).val()==$(`#dapass`).val()) 
            {
                
                  $(`#confirmdapass`).removeAttr("style");
                  $(`#dapass`).removeAttr("style");
                  if ($(`input[name=username]`).attr('style')==null) 
                  {
                     $(`#nextbtn`).prop('disabled', false);
                  }
                  else
                  {
                     $(`#nextbtn`).prop('disabled', true);

                  }
            }
            else
            { 
                $(`#confirmdapass`).css({"border":"1px solid red","border-radius":"5px","outline-color": "red"});
                $(`#dapass`).css({"border":"1px solid red","border-radius":"5px","outline-color": "red"});
                    $(`#nextbtn`).prop('disabled', true);
                

            }
      });

      $(`#confirmdapass`).on('input',()=>
      {

            if ( $(`#confirmdapass`).val()!='' && $(`#dapass`).val()!='' && $(`#confirmdapass`).val()==$(`#dapass`).val()) 
            {
                
                  $(`#confirmdapass`).removeAttr("style");
                  $(`#dapass`).removeAttr("style");
                  if ($(`input[name=username]`).attr('style')==null) 
                  {
                     $(`#nextbtn`).prop('disabled', false);
                  }
                  else
                  {
                     $(`#nextbtn`).prop('disabled', true);

                  }
            }
            else
            { 
                $(`#confirmdapass`).css({"border":"1px solid red","border-radius":"5px","outline-color": "red"});
                $(`#dapass`).css({"border":"1px solid red","border-radius":"5px","outline-color": "red"});
                 $(`#nextbtn`).prop('disabled', true);
               
            }
      });
        

      $(`#inputtodb`).on('click',()=>
      {
        
           /* var fd = new FormData();
            fd.append(`addacc`,'set');
            fd.append(`username`,$(`input[name=username]`).val());
            fd.append(`password`,$(`#dapass`).val());
            fd.append(`ques1`,$(`#ques1 option:selected`).text());
            fd.append(`ques2`,$(`#ques2 option:selected`).text());
            fd.append(`ques3`,$(`#ques3 option:selected`).text()); 
            fd.append(`ans1`,$(`input[name=ans1]`).val());
            fd.append(`ans2`,$(`input[name=ans2]`).val());
            fd.append(`ans3`,$(`input[name=ans3]`).val());*/
            if ($(`input[name=ans1]`).val()=='' ||
                $(`input[name=ans2]`).val()=='' || 
                $(`input[name=ans3]`).val()=='') 
            {
                  $(`#alerts`).hide();
                  $(`#alerts h4`).text('');
                  $(`#alerts h4`).text('Fields cannot be empty!');
                  $(`#alerts`).show();
            }
            else
            {

      
             $(`#toshowadd`).hide();
             $(`#addproduct`).hide();
             $(`#showproduct`).hide();
             $('body').append(`
                            <div class="text-center" style="padding:65px;">
                        <div class="spinner-border" style="padding:120px; width: 5rem; height: 5rem;" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                      </div>
                            `);
          
       
        
       
   
              $.ajax(
              {
                    url: "process/insert.php",
                    type: "POST",
                    data: 
                    {

                      addacc:'set',
                      username:$(`input[name=username]`).val(),
                      password:$(`#dapass`).val(),
                      ques1:$(`#ques1 option:selected`).text(),
                      ques2:$(`#ques2 option:selected`).text(),
                      ques3:$(`#ques3 option:selected`).text(),
                      ans1:$(`input[name=ans1]`).val(),
                      ans2:$(`input[name=ans2]`).val(),
                      ans3:$(`input[name=ans3]`).val()
                    },
                    success:function(data)
                    {
                      $(`#alerts`).hide();
                      var result=data.split("returnthis");
                      if (result[1]=='addedsuccessfully') 
                      {

                        location.reload();  
                       
                      }
                      else
                      {
                      alert('ss')
                      }
                        //

                    }

              });
            }


      
        
        
        
        //;
      });

/*For top sale product query

SELECT b.product_name,sum(quantity) as "total quantity", c.product_id
FROM pm_client_bridge c
INNER JOIN pm_product b
ON c.product_id=b.id
GROUP BY (product_id)
ORDER BY sum(quantity) DESC OFFSET 5
*/










    $(`#toshowadd`).on('click',()=>
    {   
      
        if ($(`#toshowadd`).text()==' Add Account') 
        {
           $(`#toshowadd`).text('Show Account');
           $(`#showproduct`).hide();
           $(`#addproduct`).fadeIn("");
        }
        else
        {
           $(`#toshowadd`).text(' Add Account');
           $(`#addproduct`).hide();
           $(`#showproduct`).fadeIn("");
        }
        
    });


      //left

      $("#backbtn").click(function(){
           $(`.security_form`).hide();
           $(`.user_form`).show("slide", { direction: "right" }, 500);
        });


      //right
     $(`#nextbtn`).on('click',()=>
     {

           $(`.user_form`).hide();

           $(`.security_form`).show("slide", { direction: "left" }, 500);
         /* $().animate({
                width: boxWidth
            });
          */
            

     });


  });


 </script>