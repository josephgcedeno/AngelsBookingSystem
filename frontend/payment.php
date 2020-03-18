<?php
    
        require_once('../run.php');
        session_start();
       
   
        if (!isset($_POST['sendItems'])) 
        {
          header('location: index.php');
        }

        if (isset($_POST['sendItems'])) 
        {
          $productIds=$_POST['idProduct'];
          $productQuan=$_POST['quanProduct'];
          $proComment=$_POST['proComment'];
          $args = dissectAndGroupIntoIdNQuantity($productIds,$productQuan);
          $_SESSION['comment']=dissectAndGroupIntoIdNComment($productIds,$proComment);



?>

<!DOCTYPE html>
<html>
<head>
  <title>Payment</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../importer/css/bootstrap.min.css">
      <script src="../importer/js/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- font -->
  <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="css/loading.css">
  <link rel="stylesheet" href="css/payment.css">

</head>
<body>
  <main class="page payment-page">
    <section class="payment-form dark">

     
      
<!-- action="process/insertClientData.php" -->
      <div class="container">
        <form method="POST" action="payment.php">

          <div class="aftersubmission">
              <div class="align-middle" style="margin-top: 30px;">
                    <div class="col-md-12"><h3 id="generatedCode"></h3>
                      <h3 style="margin-top: 50px;">Thank your for ordering!</h3>
                      <h5>We are processing your order right now.</h5>
                    </div>
              </div>
          </div>
          <div class="products" style="margin-top: 20px !important;">
                <h3 class="title">Checkout</h3>
<?php 


    $productTotal=0;
    $counter=0; //this will count how many product bought for jQuery purposes 
    foreach ($args as $row) //accessing multi dimension array
    { 
        $resultsToDisect=explode('$gf@', $gfdb->getResultProductNameNProductTotalPrice('pm_product',$row['id'],$row['quantity']));
 
         echo' <div class="item" id="items'.$counter.'">
                  <input type="hidden" name="quantityFromBoughted[]" value="'.$row['quantity'].'" >
                  <input type="hidden" name="idFromBoughted[]" value="'.$row['id'].'">
                  <span class="price">₱'.moneyFormater($resultsToDisect[1]) .'</span>
                  <p class="item-name">'.$resultsToDisect[0].'</p>
                  <p class="item-description">'.$resultsToDisect[2].'</p>
                  <p class="item-description">Price: '.$resultsToDisect[3].' </p>
                  <p class="item-description">Qty: '.$row['quantity'].' </p>
                </div>';
        $productTotal+=$resultsToDisect[1];      
        $counter++;
    }
    foreach ($_SESSION['comment'] as $row) //accessing multi dimension array
    { 
        
         echo'<input type="hidden" name="idValueForComments[]" value="'.$row['id'].'" >
              <input type="hidden" id="commenting" name="commentValueForComments[]" value="'.$row['comment'].'">';
    }

 

        echo'

         <div class="total">Total<span class="price">₱ '.moneyFormater($productTotal).'</span></div>
          <input type="hidden" name="totalPriceToPay" value="'.$productTotal.'" id="totalPayment">
          <input type="hidden" value="'.$counter.'" id="countcontent">
          </div>';
  } ?> <center><p id="show" style="color: blue; cursor: pointer;"><u>See all</u></p></center> 
          <hr>
           <div id="mop">
             
               


             <?php
 // if naka login na daan si client
       if (isset($_SESSION['userclient'])) 
       {  
         $clientusername=$_SESSION['userclient'];
          $results=$gfdb->resultRowAsArrayAll2(
            "
            SELECT b.password as 'password'
            FROM pm_account b 
            INNER JOIN pm_account_clients c 
            ON c.pm_account_id=b.id
            WHERE 
            (b.username='$clientusername'  AND b.type='client') OR
            (c.userclient_email='$clientusername' AND b.type='client')
            ");
         echo'  
          <input type="hidden" name="purcaseasusername" value='.$clientusername.'>
          <input type="hidden" name="purcaseaspassword" value='.$results['password'].'>
          <div class="form-group col-sm-12">
                <label for="cvc">Book Date</label>
              <input  type="date" class="form-control" name="prucaseasuserdate" value="'.date('Y-m-d').'"  min="'. date('Y-m-d').' required>
          </div>


           <center><h5 style="margin-top: 30px !important; margin-bottom: 20px !important; ">You are already logged in. You can simply proceed</h5></center>
          <center id = "mode">
            <input  type="hidden" id="activeaccloggedin" value="set">
            <button style = " width: 100%; background-color:#e57373;" type="button"  id="btnsubmituser" class="btn btn-primary rounded mb-4" >Proceed</button><br>
            <a href="" style = "width: 100%; background-color:#e57373;" class="btn  btn-primary rounded mb-4" href="index.php"><i class="fa fa-user"></i>Back</a>
         
          </center>';
       }
       else
       {
            echo'   
                 <center><h5 style="margin-top: 30px !important; margin-bottom: 20px !important; ">To continue, please select one mode below.</h5></center>

               <center id = "mode">
            <a href="" style = " width: 100%; background-color:#e57373;  " class="btn  btn-primary rounded mb-4" data-toggle="modal" data-target="#modalRegisterForm"><i class="fa fa-sign-in-alt"></i>Login</a><br>
            <a href="" style = "width: 100%; background-color:#e57373; " class="btn  btn-primary rounded mb-4" data-toggle="modal" data-target="#modalForGuest"><i class="fa fa-user"></i>Continue as guest</a>
              <a href="" style = "width: 100%; background-color:#e57373;  " class="btn  btn-primary rounded mb-4" href="index.php"><i class="fa fa-user"></i>Back</a>
          </center>';
      
  
       ?>
            <div class="modal fade" id="modalForGuest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div id="thisforguest">

                                  <div class="card-details" style="">
                    <h3 class="title">Payment Details</h3>
                     <div class="alert alert-danger" role="alert" id="alerts" style="display: none">
                       <strong></strong>
                            <button type="button" class="close"  style="margin-top: -10px !important;">×</button>
                     </div>
                    <div class="row">
                      
                      <div class="form-group col-sm-7">
                        <label for="card-holder">Full Name</label>
                        <input type="text" class="form-control" placeholder="Full Name" aria-label="Full Name" aria-describedby="basic-addon1" name="fullName" required>
                      </div>
                      <div class="form-group col-sm-5">
                        <label for="">Facebook Name</label>
                        <input  type="text" class="form-control" placeholder="Facebook Name" aria-label="Facebook Name" aria-describedby="basic-addon1" name="fbacc" required>
                      </div>
                      <div class="form-group col-sm-12">
                        <label for="card-number">Email</label>
                        <input type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" name="emailadd" required>
                      </div>
                      <div class="form-group col-sm-12">
                        <label for="card-number">Address</label>
                        <input type="text" class="form-control" placeholder="Address" aria-label="Address" aria-describedby="basic-addon1" name="address" required>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="cvc">Phone Number</label>
                        <input  type="text" class="form-control" placeholder="Phone Number" aria-label="Phone Number" aria-describedby="basic-addon1" name="phonenumber" required>
                      </div>
                        
                        <div class="form-group col-sm-6">
                        <label for="cvc">Book Date</label>
                      <input  type="date" class="form-control" name="date1" value="<?php echo  date('Y-m-d'); ?>"  min="<?php echo  date('Y-m-d'); ?>" required>
                      </div>

                      <div class="form-group col-sm-12">
                        <button type="button" class="btn btn-primary btn-block" id="btnsubmitguest">Proceed</button>
                      </div>
                    </div>
                  </div>

                        
                      </div>
                    </div>
                  </div>
           </div>

          <!-- login as account -->
          <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                            <div id="thisforsignin">
                                      <div class="card-details" style="">
                                          <h3 class="title">Payment Details</h3>
                                           <div class="alert alert-danger" role="alert" id="alertsuser" style="display: none">
                                             <strong></strong>
                                                  <button type="button" class="close"  style="margin-top: -10px !important;">×</button>
                                           </div>
                                          <div class="row">
                                            
                                            <div class="form-group col-sm-12">
                                              <label for="card-holder">Username</label>
                                              <input type="text" class="form-control" placeholder="Username" aria-label="Full Name" aria-describedby="basic-addon1" name="purcaseasusername" required>
                                            </div>
                                            <div class="form-group col-sm-12">
                                              <label for="">Password</label>
                                              <input  type="Password" class="form-control" placeholder="Password" aria-label="Facebook Name" aria-describedby="basic-addon1" name="purcaseaspassword" required>
                                            </div>
                                              
                                              <div class="form-group col-sm-12">
                                              <label for="cvc">Book Date</label>
                                            <input  type="date" class="form-control" name="prucaseasuserdate" value="<?php echo  date('Y-m-d'); ?>"  min="<?php echo  date('Y-m-d'); ?>" required>
                                            </div>

                                            <div class="form-group col-sm-12">
                                              <button type="button" class="btn btn-primary btn-block" id="btnsubmituser" >Proceed</button>
                                              <center style = "margin-top: 15px !important;">
                                              <label for="direct">No account?</label>
                                              <a href="signup.php" target="_blank" id="direct"> Click here to Sign up</a>
                                            </center>
                                            </div>
                                          </div>
                                        </div>
                            </div>

                            <div id="thisforsignup" style="display: none">

                                      <div class="modal-header text-center" >
                                      <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body mx-3">
                                      <div class="md-form mb-5">
                                         <i class="fa fa-user"></i>
                                        <input type="text" id="orangeForm-name" class="form-control validate">
                                        <label data-error="wrong" data-success="right" for="orangeForm-name">Username</label>
                                      </div>
                                      <div class="md-form mb-5">
                                        <i class="fa fa-lock"></i>
                                        <input type="email" id="orangeForm-email" class="form-control validate">
                                        <label data-error="wrong" data-success="right" for="orangeForm-email">Password</label>
                                      </div>
                                      <div class="modal-footer d-flex justify-content-center">
                                      <button type="button" class="btn btn-primary">Sign in</button>
                                    </div>
                                    </div>
                              
                            </div>

                 </div>
            </div>
          </div>
       <!-- end -->
     <?php }?>

          </div>

         </form>

          <!-- THIS SECTION WILL  BE SEEN AFTER SENDING THE FORM-->
  <!--   <div class="col-xl-12 loadingScreen" >
      <div class="circle1"></div>
      <div class="circle2"></div>
      <div class="circle3"></div>
      <div class="circle4"></div>
    </div>   -->

      </div>
<div class="container">
 <div class="loading"><img src="img/cupcake.gif"><h3 class="fonts">Angel's Cupcake</h3></div>
</div>
    </section>
  </main>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

<script type="text/javascript">


   
          function proceedNow()
          {
               return answer=confirm('Do you really want to proceed? ');
          }

          $(document).ready(function()
          {     

                  $(`#btnsubmituser`).on('click',()=>
                  { 
                            if ($(`input[name=purcaseasusername]`).val()=='' || $(`input[name=purcaseaspassword]`).val()=='' ) 
                            {  
                                    $(`#alertsuser`).hide();       
                                    $(`#alertsuser strong`).text('')
                                    $(`#alertsuser strong`).text('Fields cannot be empty!')
                                    $(`#alertsuser`).show();
                            }
                            else if (proceedNow()) 
                            {     
                              $(`form`).hide();
                              $('#mop').hide();
                              $(".modal-backdrop").hide();
                              $(`.loading`).fadeIn("very slow");
                              var comments=$("input[name='commentValueForComments[]']").map(function(){return $(this).val();}).get();
                              var quantity=$("input[name='quantityFromBoughted[]']").map(function(){return $(this).val();}).get();
                              var ids=$("input[name='idFromBoughted[]']").map(function(){return $(this).val();}).get();


                                $(`#btnsubmituser`).prop(`disabled`,true); 
                           /*     var fd = new FormData();
                                fd.append(`asuser`,'set');
                                fd.append(`username`,$(`input[name=purcaseasusername]`).val());
                                fd.append(`Password`,$(`input[name=purcaseaspassword]`).val());
                                fd.append(`date`,$(`input[name=prucaseasuserdate]`).val());
                                fd.append(`totalPriceToPay`,$('input[name=totalPriceToPay]').val());
                                fd.append(`productID`,ids);
                                fd.append(`productQuantity`,quantity);
                                fd.append(`productComments`,comments);
*/
                                $.ajax(
                                {
                                    url: "process/validate.php",
                                    type: "POST",
                                    data: 
                                    {
                                      asuser:`set`,
                                      username:$(`input[name=purcaseasusername]`).val(),
                                      Password:$(`input[name=purcaseaspassword]`).val(),
                                      date:$(`input[name=prucaseasuserdate]`).val(),
                                      totalPriceToPay:$('input[name=totalPriceToPay]').val(),
                                      productID:ids,
                                      productQuantity:quantity,
                                      productComments:comments

                                    },
                                     cache:false,
                                    success:(data)=>
                                    {
                                             var content=data.split("separtethis"); 
                                             if (content[1]=='accnotfound') 
                                             {
                                                      $(`#alertsuser`).hide();       
                                                      $(`#alertsuser strong`).text('')
                                                      $(`#alertsuser strong`).text('Incorrect Input!')
                                                      $(`#alertsuser`).show();
                                                      $(`#btnsubmituser`).prop(`disabled`,false); 
                                             }
                                             else
                                             { 

                                                          $.ajax(
                                                          {
                                                             url: "process/sendToAdmin.php",
                                                             type: "POST",
                                                             data:
                                                             {
                                                              sent:true
                                                             }
                                                          });     
                                                   //$(`.loadingScreen`).show();
                                                
                                      
                                                        // After waiting for five seconds, submit the form.
                                                         $(`.loading`).fadeOut('very slow');
                                                         $(`.aftersubmission`).fadeOut();
                                                      
                                                           $(`#generatedCode`).html(`
                                                        <div class="col-md-12 alert alert-success" id="alertcontent">
                                                           <strong>Cancelation code:</strong> ${content[1]}
                                                           
                                                          <button class="close" data-dismiss="alert">×</button>
                                                        </div>

                                                            `);
                                                           $(`form`).slideToggle();
                                                           $(`hr`).hide();
                                                           $(`.aftersubmission`).slideToggle();
                                                           $(``)

                                             }
                                              
                                    

                                    }

                                });

                            }


                  });


                   var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
                   let emailValid=false;
                   let phoneValid=false;

                    $(`input[name=emailadd]`).on('input',()=>
                    {

                        if (!pattern.test($(`input[name=emailadd]`).val())) 
                        {
                           $('input[name=emailadd]').css({"border":"1px solid red","border-radius":"5px","outline-color": "red"});  
                           emailValid=false;
                        }
                        else
                        {
                          $('input[name=emailadd]').removeAttr("style"); 
                          emailValid=true;
                        }

                    });
                    $(`input[name=phonenumber]`).on('input',()=>
                    {     

                          let phnumber=$(`input[name=phonenumber]`).val();
                          let validNo1=phnumber[0]+phnumber[1];
                          let validNo2=phnumber[0]+phnumber[1]+phnumber[2]+phnumber[3];
                          if ((!$.isNumeric($(`input[name=phonenumber]`).val()) || ($.isNumeric($(`input[name=phonenumber]`).val()) && String(validNo1)!='09'  && String(validNo2)!='+639' ))  || 
                             ($.isNumeric($(`input[name=phonenumber]`).val()) && String(validNo1)=='09' && $(`input[name=phonenumber]`).val().length<11)  ||  
                             ($.isNumeric($(`input[name=phonenumber]`).val()) && String(validNo2)=='+639' && $(`input[name=phonenumber]`).val().length<13 ) || 
                             ($.isNumeric($(`input[name=phonenumber]`).val()) && validNo1=='09' &&  $(`input[name=phonenumber]`).val().length>11 )          || 
                             ($.isNumeric($(`input[name=phonenumber]`).val()) && validNo2=='+639' &&  $(`input[name=phonenumber]`).val().length>13)
                             )
                          {
                             $('input[name=phonenumber]').css({"border":"1px solid red","border-radius":"5px","outline-color": "red"});  
                              phoneValid=false;
                          }
                          else
                          {
                              $('input[name=phonenumber]').removeAttr("style"); 
                              phoneValid=true;
                          }
                            
                       
                    });
                   
               

                       $(`#btnsubmitguest`).on('click',function()
                       {


                            if (proceedNow()) 
                            {
                                             
                                              var valuesIdArray = $("input[name='idFromBoughted[]']").map(function(){return $(this).val();}).get();//get value from array named
                                              var valuesQuantityArray = $("input[name='quantityFromBoughted[]']").map(function(){return $(this).val();}).get();//get value from array named
                                              

                                              var valueComments=$("input[name='commentValueForComments[]']").map(function(){return $(this).val();}).get(); 
                                              var valueIdComment=$("input[name='idValueForComments[]']").map(function(){return $(this).val();}).get(); 
                                              var valueName=$('input[name=fullName]').val();
                                              var valueFbAcc=$('input[name=fbacc]').val();
                                              var valueEmailAcc=$('input[name=emailadd]').val();
                                              var valueAddress=$('input[name=address]').val();
                                              var valuePhoneNumber=$('input[name=phonenumber]').val();
                                              var valuePriceToPay=$('input[name=totalPriceToPay]').val();
                                              var valueDate=$('input[name=date1]').val();
                                              



                                                var empty = false;
                                               $('#thisforguest input[type="text"]').each(function()
                                               {

                                                   if($(this).val()=='')
                                                   {
                                                      empty =true;
                                                      return empty;
                                                   }
                                               });

                                             

                                              if (empty) 
                                              {
                                                $(`#alerts strong`).text('')
                                                $(`#alerts strong`).text('Fields cannot be empty!')
                                                $(`#alerts`).show();
                                                //alert('Input cannot be empty!')
                                                 
                                              }
                                              else if (!phoneValid || !emailValid) 
                                              {
                                                $(`#alerts strong`).text('')
                                                $(`#alerts strong`).text('Invalid Input!')
                                                $(`#alerts`).show();
                                              }
                                              else if(phoneValid && emailValid)
                                              { 
                                                   $('#mop').hide();
                                                   $(".modal-backdrop").hide();
                                                   $("#btnsubmit").attr("disabled", "disabled");
                                                   $(`.loading`).fadeIn("very slow");
                                                   $(`form`).hide();
                                                
                                                   $.ajax(
                                                   {
                                                        url: "process/insertClientData.php",
                                                        type: "POST",
                                                        data: 
                                                        {
                                                          fullName: valueName,
                                                          fbacc: valueFbAcc,
                                                          emailadd: valueEmailAcc,
                                                          address:valueAddress,
                                                          phonenumber: valuePhoneNumber,
                                                          totalPriceToPay: valuePriceToPay,
                                                          date1: valueDate,
                                                          productID : valuesIdArray,
                                                          productQuantity : valuesQuantityArray,
                                                          productComments : valueComments

                                                        },
                                                        cache: false,
                                                        success: function(dataResult)
                                                        {


                                                              $.ajax(
                                                              {
                                                                 url: "process/sendToAdmin.php",
                                                                 type: "POST",
                                                                 data:
                                                                 {
                                                                  sent:true
                                                                 }
                                                              });  
                                                             var content=dataResult.split("separtethis"); 
                                                        
                                                              // After waiting for five seconds, submit the form.
                                                        
                                                               $(`.loading`).fadeOut('very slow');
                                                               $(`.aftersubmission`).fadeOut();
                                                               $(`#generatedCode`).html(`
                                                              <div class="col-md-12 alert alert-success" id="alertcontent">
                                                                 <strong>Cancelation code:</strong> ${content[1]}
                                                                <button class="close" data-dismiss="alert">×</button>
                                                              </div>
                                                                  `);
                                                               $(`form`).slideToggle();
                                                               $('.card-details').hide();
                                                               $(`hr`).hide();
                                                               $(`.aftersubmission`).slideToggle();


                                                     
                                                         
                                                          
                                                       }
                                                    });
                                                  }
                                }
                              });







                $('#show').hide();
                var contents=$('#countcontent').val();
                if (contents>3) 
                {
                  $('#show').slideToggle();

                  for(var i=contents;i>2;i--)
                  {
                      $(`#items${i}`).hide();
                  }

            

                  $('#show').on('click',function()
                  {
                      if ($('#show').text()=='hide') 
                      { 
                          $('#show').text('show all');
                          for(var i=contents;i>2;i--)
                          {

                              $(`#items${i}`).hide("slow");
                          }
                      }
                      else
                      {
                          $('#show').text('hide')
                           for(var i=0;i<contents;i++)
                           {
                                $(`#items${i}`).show("slow");
                           }
                      }
                  });
                  

                } 
                $(`.close`).on('click',function()
                {
                    $(`#alerts`).hide(); //ALERT HIDER
                     $(`#alertsuser`).hide();

                })


              });
</script>