<?php
  require_once( '../run.php');
  session_start();

  if (!isset($_SESSION['userclient'])) 
  {
         header('location: login.php');

  }
?><!DOCTYPE html>
<html>
<title>My Account</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/acc1.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <link rel="stylesheet" type="text/css" href="../importer/css/bootstrap.min.css">
  <script src="../importer/js/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- font -->
  <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/loading.css">
  <link rel="stylesheet" href="css/cancel.css">
  <link rel="stylesheet" href="css/list.css">


  <!-- tabs -->
  <link rel="stylesheet" type="text/css" href="../importer/css/tabs.css">
  <script src="../importer/js/bootstrap.min.js" ></script>
<!-- table -->
  <link rel="stylesheet" type="text/css" href="css/table.css">
  <link rel="stylesheet" type="text/css" href="../importer/css/jquery.dataTables.min.css">
  <script type="text/javascript" src="../importer/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/change.js"></script>
<!-- materialize design -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<style>
  html{
    background-color: #fff !important;
  }

.modal-backdrop{
display: none;  

}
.modal-content {
  top: 50px;
  -webkit-animation-name: slideIn;
  -webkit-animation-duration: 0.6s;
  animation-name: slideIn;
  animation-duration: 0.6s

}

@-webkit-keyframes slideIn {
  from {top: 0; opacity: 0} 
  to {top: 50; opacity: 1}
}

@keyframes slideIn {
  from {top: 0; opacity: 0}
  to {top: 50;  opacity: 1}
}

@-webkit-keyframes fadeIn {
  from {opacity: 0} 
  to {opacity: 1}
}

@keyframes fadeIn {
  from {opacity: 0} 
  to {opacity: 1}
}
</style>
<body class="">

<!-- Navbar -->
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
                               <a href="process/logout.php" id="dropdown"><img src="img/user.png" width="30px" > Log out</a>
                              </li>';             
                           }
                          
                      ?>
                </ul>   
</div>


<?php 
                $usernametoDisplay=explode('@', $_SESSION['userclient']);

                $result=$gfdb->resultRowAsArrayAll2("SELECT b.pm_account_id ,b.userclient_gender as gender, b.userclient_fullname,b.userclient_fbname, b.userclient_email ,b.userclient_address ,b.userclient_email , b.userclient_phonenumber ,c.username, c.password
                  FROM
                  pm_account c
                  INNER JOIN pm_account_clients b
                  ON c.id = b.pm_account_id
                  WHERE c.username LIKE '%$usernametoDisplay[0]%' AND c.type='client' ");
                 $idclient=$result['pm_account_id'];
                 $totalorder=$gfdb->resultRowAsArrayAll2("
                  SELECT count(pm_client_id) as total
                  FROM  
                  pm_client_transaction
                  WHERE pm_client_id=$idclient
                  ");
                  $totalpending=$gfdb->resultRowAsArrayAll2("
                  SELECT COUNT(*) as pending
                  FROM  
                  pm_client_transaction b
                  INNER JOIN pm_client c
                  ON c.id = b.pm_transaction_id
                  WHERE 
                  (b.pm_client_id=$idclient AND c.client_status = 'open') OR
                   (b.pm_client_id = $idclient AND  c.client_status = 'confirm' )
                  ");
                  $totalsuccess=$gfdb->resultRowAsArrayAll2("
                  SELECT COUNT(*) as success
                  FROM  
                  pm_client_transaction b
                  INNER JOIN pm_client c
                  ON c.id = b.pm_transaction_id
                  WHERE 
                  b.pm_client_id = $idclient
                  AND
                  c.client_status = 'done'
                  ");

                  $totalunfinish=$gfdb->resultRowAsArrayAll2("
                  SELECT COUNT(*) as unfinish
                  FROM  
                  pm_client_transaction b
                  INNER JOIN pm_client c
                  ON c.id = b.pm_transaction_id
                  WHERE 
                  (b.pm_client_id=$idclient AND c.client_status = 'cancel') OR
                   (b.pm_client_id = $idclient AND  c.client_status = 'reject' )
                  ");
                 ?>
<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px; margin-top: 20px;">    
  <!-- The Grid -->
  <div class="w3-row">

    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center" style="color: #e57373 !important;"><b><?php echo $usernametoDisplay[0] ?></b></h4>
         <p class="w3-center">
          <img class="w3-circle" style="height:106px;width:106px" alt="Avatar" <?php if($result['gender']=='M'){ echo' src="img/male.png" '; }else { echo 'src="img/female.png" ';} ?> width="250px" style="margin-bottom: 20px;">
         </p>
         <hr>
         <p><i class="fa fa-user fa-fw w3-margin-right w3-text-theme" style="color: #e57373 !important;"></i>Full name: <strong><?php echo $result['userclient_fullname']; ?></strong></p>
         <p><i class="fa fa-shopping-cart fa-fw w3-margin-right w3-text-theme" style="color: #e57373 !important;"></i> Total Orders: <strong><?php echo $totalorder['total']; ?></strong></p>
         <p><i class="fa fas fa-check fa-fw w3-margin-right w3-text-theme" style="color: #e57373 !important;"></i> Successful Orders: <strong><?php echo $totalsuccess['success']; ?></strong></p>
        </div>
      </div>
      <br>
    </div>
    <!-- End Left Column -->
    
    <!-- Middle Column -->
    <div class="w3-col m9">
    
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
      


                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#transac" >My Orders  <span class="w3-badge w3-red"><?php echo $totalpending['pending']; ?></span></a></li>
                    <li><a data-toggle="tab" href="#menu1">View Transaction History  <span class="w3-badge w3-red"><?php echo $totalsuccess['success']; ?></a></li>
                    <li><a data-toggle="tab" href="#canceledrejected">Canceled/Rejected <span class="w3-badge w3-red"><?php echo $totalunfinish['unfinish']; ?></a></li>
                    <li><a data-toggle="tab" href="#menu2">View Account Details</a></li>
                </ul>


                   <div class="tab-content">
                  <div id="transac" class="tab-pane fade in active">

                <div class="w3-modal" id="exampleModalLong"  >
                  <div class="modal-dialog" role="document">
                    <div class="modal-content" style="margin-top: -130px">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Orders</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                      </div>
                      <div class="modal-body">
                       

                      
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"  style="background-color: #e57373 !important;" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

              <br>
             
                     <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Booked On</th>
                        <th>Total Expense</th>
                        <th>Cancelation Code</th>
                        <th>Status</th>
                        <th>Date & Time Booked</th>
                        <th>Orders</th>
                    </tr>
                </thead>
                <tbody>
            
                   <?php

                     $tbodydisplay=$gfdb->resultFetchRow("
                    SELECT c.id, c.client_ordered,c.client_expense,c.client_code,c.orderedin,c.client_status
                    FROM 
                    pm_client_transaction b
                    INNER JOIN pm_client c
                    ON b.pm_transaction_id =c.id
                    WHERE (b.pm_client_id=$idclient AND c.client_status = 'open') OR
                   (b.pm_client_id = $idclient AND  c.client_status = 'confirm' )
                     ");
                    while ($row = mysqli_fetch_assoc($tbodydisplay))
                    {     
                      echo ' 
                          <tr>
                              <td>'.$row['id'].'</td>
                              <td>'.$row['client_ordered'].'</td>
                              <td>₱ '.moneyFormater($row['client_expense']).'</td>
                              <td>'.$row['client_code'].'</td>
                              <td>'.$row['client_status'].'</td>
                              <td>'.$row['orderedin'].'</td>
                              <td>
                              <button type="button" class="btn btn-primary btn-sm" style = "background-color: #e57373;" data-toggle="modal" data-target="#exampleModalLong" onclick="ordersPop(this)" id="'.$row['id'].'" value="open">
                             <i class="fa fa-shopping-cart"></i> Orders
                              </button>
                              </td>
                          </tr>';
                    }

            
                    
                   ?>
                </tbody>
            </table>

                  </div>   

                  <!-- end of first tab -->



                  <!-- second tab start-->


                  <div id="menu1" class="tab-pane fade">
             <br>
               
                     <table id="example1" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Booked On</th>
                        <th>Total Expense</th>
                        <th>Cancelation Code</th>
                        <th>Date & Time Booked</th>
                        <th>Orders</th>
                    </tr>
                </thead>
                <tbody>
            
                   <?php
                     $tbodydisplay=$gfdb->resultFetchRow("
                    SELECT c.id, c.client_ordered,c.client_expense,c.client_code,c.orderedin
                    FROM 
                    pm_client_transaction b
                    INNER JOIN pm_client c
                    ON b.pm_transaction_id =c.id
                    WHERE b.pm_client_id=$idclient AND c.client_status='done'
                     ");
                     
                    while ($row = mysqli_fetch_assoc($tbodydisplay))
                    {     
                      echo ' 
                          <tr>
                              <td>'.$row['id'].'</td>
                              <td>'.$row['client_ordered'].'</td>
                              <td>₱ '.moneyFormater($row['client_expense']).'</td>
                              <td>'.$row['client_code'].'</td>
                              <td>'.$row['orderedin'].'</td>
                              <td>
                              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" style="background-color: #e57373 !important;" data-target="#tabledone" onclick="ordersPop(this)" id="'.$row['id'].'" value="done">
                             <i class="fa fa-shopping-cart"></i> Orders
                              </button>
                              </td>
                          </tr>';
                    }

            
                    
                   ?>
                </tbody>
            </table>

   <div class="w3-modal" id="tabledone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content"  style="margin-top: -130px">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Orders</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                      
                                  
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" style="background-color: #e57373 !important;" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                          </div>



                  </div>

                  <!-- end second tab start-->



                  <!-- start third tab start-->


                  <div id="menu2" class="tab-pane fade"><br>
                   <div class="alert alert-danger" role="alert" id="alerts"  style="display: none; ">
                   <h4 style="font-size: 15px !important;"></h4>
                          <button type="button" class="close" style="margin-top: -30px;">×</button>
                   </div>

                   <div class="alert alert-success" role="alert" id="alerts1"  style="display: none;">
                   <h4 style="font-size: 15px !important;"></h4>
                          <button type="button" class="close" style="margin-top: -30px;">×</button>
                   </div>


                       <div class="row">
                        <div class="col s12">
                        
                          <input type="hidden" name="usersid" value=" <?php echo $idclient; ?>">

                          <div class="row">
                            <div class="input-field col s6">
                              <input id="fullname" name="fullname" type="text" class="validate" value="<?php echo $result['userclient_fullname'] ?>" disabled>
                              <label for="fullname">Full Name</label>
                            </div>
                            <div class="input-field col s6">
                              <input id="fbname" name="fbname" type="text" class="validate" value="<?php echo $result['userclient_fbname'] ?>" disabled> 
                              <label for="fbname">Facebook</label>
                            </div>
                          </div>



                          <div class="row">
                            <div class="input-field col s12">
                              <input  id="email" type="email" name="email" class="validate" value="<?php echo $result['userclient_email'] ?>" disabled>
                              <label for="email">Email</label>
                            </div>
                          </div>


                          <div class="row">
                            <div class="input-field col s8">
                              <input id="address" type="text" name="address"  class="validate"  value="<?php echo $result['userclient_address'] ?>" disabled>
                              <label for="address">Address</label>
                            </div>

                            <div class="input-field col s4" >
                              <select name="gender" id="selecting" disabled>
                                          <option value="" disabled selected>Choose your option</option>
                                          <option value="F"  <?php  if($result['gender']=='F'){ echo 'selected';} ?>>Female</option>
                                          <option value="M"  <?php  if($result['gender']=='M'){ echo 'selected';} ?>>Male</option>
                                        </select>
                                        <label>Gender</label>
                            </div>
                          </div>


                          <div class="row">
                            <div class="input-field col s12">
                              <input id="phoneno" type="text" name="phoneno" class="validate" 
                              value="<?php echo $result['userclient_phonenumber'] ?>" disabled>
                              <label for="phoneno">Phone no</label>
                            </div>
                          </div>

                          <div class="row">
                            <div class="input-field col s12">
                              <input id="username" type="text" name="username" class="validate"  value="<?php echo $result['username'] ?>" class="form-control" disabled>
                              <label for="username">Username</label>
                            </div>

                          </div>
                          <div class="row">
                            
                              <div class="input-field col s6">
                              <input id="password" type="password" name="ppassword" class="validate" value="<?php echo $result['password'] ?>" disabled>
                              <label for="password">Password</label>
                            </div>

                             <div class="input-field col s6" id="confirmpass" style="display: none;">
                              <input id="confirmppass" type="password" name="confirmppass" class="validate" value="<?php echo $result['password'] ?>" disabled>
                              <label for="confirmppass">Confirm Password</label>
                            </div>



                          </div>




                            <div class="row"> 
        
                                <div class="btnchanges pull-right" >
                                     <button class="btn btn-success" onclick="toedit()" style="background-color: #e57373 !important;"><i class="fa fa-edit"></i> Edit</button>
                                      
                                </div>
                            </div>
                       
                        </div>
                      </div>
        


                  </div>

                    <!-- end of third tab start-->

                     <!-- start of 4th tab -->







                  <div id="canceledrejected" class="tab-pane fade">

                               <div class="w3-modal" id="modalcancel"  >
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content" style="margin-top: -130px">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLongTitle">Orders</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                         
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" style="background-color: #e57373 !important;" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                <br>
                               
                                       <table id="unfinish" class="display" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th>Transaction ID</th>
                                          <th>Booked On</th>
                                          <th>Total Expense</th>
                                          <th>Cancelation Code</th>
                                          <th>Status</th>
                                          <th>Date & Time Booked</th>
                                          <th>Orders</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                              
                                     <?php

                                       $tbodydisplay=$gfdb->resultFetchRow("
                                      SELECT c.id, c.client_ordered,c.client_expense,c.client_code,c.orderedin,c.client_status
                                      FROM 
                                      pm_client_transaction b
                                      INNER JOIN pm_client c
                                      ON b.pm_transaction_id =c.id
                                      WHERE (b.pm_client_id=$idclient AND c.client_status = 'cancel') OR
                                     (b.pm_client_id = $idclient AND  c.client_status = 'reject' )
                                       ");
                                      while ($row = mysqli_fetch_assoc($tbodydisplay))
                                      {     
                                        echo ' 
                                            <tr>
                                                <td>'.$row['id'].'</td>
                                                <td>'.$row['client_ordered'].'</td>
                                                <td>₱ '.moneyFormater($row['client_expense']).'</td>
                                                <td>'.$row['client_code'].'</td>
                                                <td>'.$row['client_status'].'</td>
                                                <td>'.$row['orderedin'].'</td>
                                                <td>
                                                <button type="button" class="btn btn-primary btn-sm" style="background-color: #e57373 !important;" data-toggle="modal" data-target="#modalcancel" onclick="ordersPop(this)" id="'.$row['id'].'" value="cancel">
                                               <i class="fa fa-shopping-cart"></i> Orders
                                                </button>
                                                </td>
                                            </tr>';
                                      }

                              
                                      
                                     ?>
                                  </tbody>
                              </table>
                  </div>
                  <!-- end of 4th tab -->
                </div>


                




            </div>
          </div>
        </div>
      </div>
      
    
     

 
      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

 
<script>

    function ordersPop(elem)
    {

     
      $(document).ready(function() 
      {
          $(`.modal-header`).text('');
          $(`.modal-header`).text(' Please wait...');
          $('.modal-body').html(`<div class="text-center">
                          <div class="spinner-border" style="padding:40px; width: 5rem; height: 5rem;" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                        </div>`);


          let transacId=elem.id;
          let sqlcode;

          if (elem.value=='open') 
          {
              sqlcode=`
                  SELECT
                  b.product_name,b.product_price,r.quantity,r.comments
                  FROM  pm_client_bridge r
                  INNER JOIN pm_product b ON r.product_id=b.id
                  INNER JOIN pm_client c ON r.client_id = c.id 
                  WHERE (r.client_id = ${transacId} AND  c.client_status = 'open' ) OR
                  (r.client_id = ${transacId} AND  c.client_status = 'confirm' )
                   `;
          }
          else if(elem.value=='done')
          {
              sqlcode=`
                  SELECT
                  b.product_name,b.product_price,r.quantity,r.comments
                  FROM  pm_client_bridge r
                  INNER JOIN pm_product b ON r.product_id=b.id
                  INNER JOIN pm_client c ON r.client_id = c.id 
                  WHERE r.client_id = ${transacId} AND  c.client_status = 'done' 
                   `;
          }
          else
          {
                sqlcode=`
                  SELECT
                  b.product_name,b.product_price,r.quantity,r.comments
                  FROM  pm_client_bridge r
                  INNER JOIN pm_product b ON r.product_id=b.id
                  INNER JOIN pm_client c ON r.client_id = c.id 
                  WHERE (r.client_id = ${transacId} AND  c.client_status = 'cancel' ) OR
                  (r.client_id = ${transacId} AND  c.client_status = 'reject' )
                   `;
          }
          $.ajax(
          { 
                
                url: "process/jsonConverter.php",
                type: "POST",
                data: 
                {
                  sql: sqlcode           
                },
                cache: false,
                success: function(dataResult)
                { 
                    var data= dataResult.split("return$gfdbJSON$");
                    var dataSource=jQuery.parseJSON(data[1]);
               

                            var peste ='';
                            var total=0;
                              for(var i=0;i<dataSource.length;i++)
                              { var comment=dataSource[i]['comments'].split('$gfdb$');
                                let actualComment="";
                                for(var j=0;j<comment.length;j++)
                                {
                                  actualComment+=comment[j]+" ";
                                }

                                var multiply=parseInt(dataSource[i]['quantity'])*parseInt(dataSource[i]['product_price']);
                                   total+=multiply;
                                 peste+=`
                                      <tr>
                                        <td>${dataSource[i]['product_name']}</td>
                                        <td>${dataSource[i]['quantity']}</td>
                                        <td>${dataSource[i]['product_price']}</td>
                                        <td>${actualComment}</td>
                                        <td>${(multiply).toLocaleString('en-PH', {
                                     currency: 'PHP', style: 'currency'
                                    })}</td>
                                      </tr>
                                   `;
                                  
                              }

                              peste+=`
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>${(total).toLocaleString('en-PH', {
                                     currency: 'PHP', style: 'currency'
                                    })}</td>
                                      </tr>
                                   `;
                                    $(`.modal-header`).text('');
                                    $(`.modal-header`).text('Orders');
                                    $(`.modal-body`).html('')
                                    $('.modal-body').html(`
                                      <table class="table table-stripped table-hover" >
                                        <thead>
                                              <tr>
                                                  <th>Product</th>
                                                  <th>Quantity</th>
                                                  <th>Price</th>
                                                  <th>Comments</th>
                                                  <th>Total</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                          ${peste}
                                          </tbody>
                                       </table>

                                  `);

                }


                

          });
      });

    }
    $(document).ready(function() 
    {

          /*alert($(`.modal-body`).html());*/

                $('#example').DataTable();
                $('#example1').DataTable();
                $(`#unfinish`).DataTable();
 document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('select').formSelect();
  });

 
                  


    });
   function toedit()
   {


       
        $(`#confirmpass`).show();
        $(`input[name=fullname]`).prop('disabled',false);
        $(`input[name=fbname]`).prop('disabled',false);
        $(`input[name=email]`).prop('disabled',false);
        $(`input[name=address]`).prop('disabled',false);
        $(`input[name=phoneno]`).prop('disabled',false);
        $(`input[name=ppassword]`).prop('disabled',false);
        $(`input[name=confirmppass]`).prop('disabled',false);
             
        $('.btnchanges').html('');
        $('.btnchanges').append(`
           <button type="button" class="align-center btn btn-primary" 
           onclick="updateedit()" style="background-color: #e57373 !important;" id="btnn1" >
           <i class="fa fa-refresh" aria-hidden="true"></i>  Save</button>
            <button type="button" class="align-center btn btn-primary" onclick="canceledit()" style="background-color: #e57373 !important;" id="btnn2">
           <i class="fa fa-close" aria-hidden="true"></i> Cancel</button>
           `);

    
    }

    function updateedit()
    {
        
            let id =$('input[name=usersid]').val();
            let phoneno=$(`input[name=phoneno]`).val();
            let email=$(`input[name=email]`).val();
            let fullname=$(`input[name=fullname]`).val();
            let fbname=$(`input[name=fbname]`).val();
            let address=$(`input[name=address]`).val();
            let pass1=$(`input[name=ppassword]`).val();
            let pass2=$(`input[name=confirmppass]`).val();

           var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
                   let emailValid=false;
                   let phoneValid=false;


              if (!pattern.test(email)) 
              {
                 
                 $(`#alerts1`).hide();
                 $(`#alerts`).hide();
                 $(`#alerts h4`).text('')
                 $(`#alerts h4`).text('Wrong email!')
                 $(`#alerts`).show();
                 emailValid=false;
              }
              else
              {
               
                 emailValid=true;
              }
              let validNo1=phoneno[0]+phoneno[1];
              let validNo2=phoneno[0]+phoneno[1]+phoneno[2]+phoneno[3];
              if ((!$.isNumeric(phoneno) || ($.isNumeric(phoneno) && String(validNo1)!='09'  && String(validNo2)!='+639' ))  || 
                 ($.isNumeric(phoneno) && String(validNo1)=='09' && phoneno.length<11)  ||  
                 ($.isNumeric(phoneno) && String(validNo2)=='+639' && phoneno.length<13 ) || 
                 ($.isNumeric(phoneno) && validNo1=='09' &&  phoneno.length>11 )          || 
                 ($.isNumeric(phoneno) && validNo2=='+639' &&  phoneno.length>13)
                 )
              {
                 $(`#alerts1`).hide();
                 $(`#alerts`).hide();
                 $(`#alerts h4`).text('')
                 $(`#alerts h4`).text('Incorrect Phone number format!')
                 $(`#alerts`).show();
                  phoneValid=false;
              }
              else
              {
                  phoneValid=true;
              }
                        
              if (pass1!=pass2) 
              {
                 $(`#alerts1`).hide();
                 $(`#alerts`).hide();
                 $(`#alerts h4`).text('')
                 $(`#alerts h4`).text('Password did not match!')
                 $(`#alerts`).show();
              }
              if (pass1==pass2 && emailValid && phoneValid) 
              {
                 $(`#alerts1`).hide();
                 $(`#alerts`).hide();
                 $(`#alerts1 h4`).text('')
                 $(`#alerts1 h4`).text('Successfully Updated! Refreshing details...')
                 $(`#alerts1`).show();


                 $(`#btnn1`).prop('disabled',true);
                 $(`#btnn2`).prop('disabled',true);

                 

                $.ajax(
                {

                      url: "process/edit.php",
                      type: "POST",
                      data: 
                      {
                              idtoupdate:id,
                              phtoupdate:phoneno,
                              emtoupdate:email,
                              fntoupdate:fullname,
                              fbtoupdate :fbname,
                              adtoupdate:address,
                              patoupdate :pass1       
                      },
                      cache: false,
                      success: function(dataResult)
                      { 
                        setTimeout(function(){
                           
                                window.location.reload();
                                
                        }, 2000);

                      }


                });
              }


    }

    function canceledit()
    {   

            $(`input[name=btncontent]`).val('not'); 
            $('.btnchanges').html('');
            $('.btnchanges').append(`
                 <button class="btn btn-success" style="background-color: #e57373 !important;"  onclick="toedit()"><i class="fa fa-edit"></i> Edit</button>`);
            $(`#confirmpass`).hide();
            $(`input[name=fullname]`).prop('disabled',true);
            $(`input[name=fbname]`).prop('disabled',true);
            $(`input[name=email]`).prop('disabled',true);
            $(`input[name=address]`).prop('disabled',true);
            $(`input[name=phoneno]`).prop('disabled',true);
            $(`input[name=username]`).prop('disabled',true);
            $(`input[name=ppassword]`).prop('disabled',true);
            $(`input[name=confirmppass]`).prop('disabled',true);

    };
</script>

</body>
</html> 
