 <?php
        require_once('../run.php');
        session_start();
 ?>

  <!DOCTYPE html>
    <html>
    <head>
      <title>List of products</title>
      <link rel="stylesheet" type="text/css" href="../importer/css/bootstrap.min.css">
      <script src="../importer/js/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
      <link rel='stylesheet' type='text/css' href='css/css.css' >
      <link rel="stylesheet" type="text/css" href="css/list.css">
      <link rel="stylesheet" type="text/css" href="css/loading.css">
      

     <!-- carousel -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
           <script type="text/javascript" src="js/loadproduct.js"></script>       
 
     <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style type="text/css">
  @media only screen and (min-width : 1200px) {
  .carousel-caption
  {
    top: 2%;
  }
}
@media only screen and (min-width : 640px) {
  .carousel-caption
  {
    top: 50%;
    
  }
  .product.large{
   width:639px;
    margin-bottom:25px;
    -webkit-transition: all 500ms ease-in-out;
       -moz-transition: all 500ms ease-in-out;
      -ms-transition: all 500ms ease-in-out;
       -o-transition: all 500ms ease-in-out;
          transition: all 500ms ease-in-out;
  }
}
@media only screen and (min-width : 480px) {
  .carousel-caption
  {
    top: 37%;
  }
}
.alert{
  background-color: #e57373 !important;
  color: white;
}
body.modal-open {
  overflow: scroll !important;
  overflow-x: hidden !important;

}
*{
}
body{
   overflow-x: hidden !important;
  width: 100%;
}

</style>
    </head>
    <body>

            <div id="header"> 
                 <ul>
                    <li><a href="#" class="active">Cupcakes</a></li>
                    <li><a href="cancelorder.php" >Cancel Order</a></li>
                    <li><a href="about.php" >About</a></li>    
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

<div class="container" style="z-index: 0;">
<div class="row">
                 
                                                    <!--     <div id="sidebar">
                                                     
                                                      </div> -->
              
                                  


                        <div class="col-md-12">
                          
                         <center><h1><?php if (isset($_SESSION['respond'])){alerts($_SESSION['respond']);
                                unset($_SESSION['respond']);
                              }else{alerts('success- Top Orders!!! ');} ?></h1></center>
                        </div>                                    

                <div id="myCarousel" class="carousel slide" data-ride="carousel" style="width: 200% !important; border-radius: 5px; box-shadow:0 25px 16px  rgba(0,0,0,0.2),0 20px 20px 0 rgba(0,0,0,0.19)">
                  <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active">sdasd</li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                    <li data-target="#myCarousel" data-slide-to="4"></li>
                  </ol>

              <?php 
              $topproducts=$gfdb->resultFetchRow("
              SELECT b.product_name,sum(quantity) as 'total quantity', e.pm_img , b.product_description, b.product_name, b.product_price
              FROM pm_client_bridge c
              INNER JOIN pm_product b
              ON c.product_id=b.id
              INNER JOIN pm_product_img e
              ON b.id=e.pm_product_id
              GROUP BY (product_id) 
              ORDER BY sum(quantity) DESC LIMIT 5");
              ?>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                    
              <?php
                  $counter=0;
                  while ($row = mysqli_fetch_assoc($topproducts)) 
                  {
                    if ($counter==0) 
                    {
                         echo' <div class="item active">
                          <img src="../pimage/'.$row['pm_img'].'"  style="width:100%;">
                          <div class="carousel-caption" style="font-size:20px;">
                            <h1>'.$row['product_name'].'</h1>
                            <p>'.$row['product_description'].'</p>
                            <b>Total sold: <strong>'.$row['total quantity'].'</strong></b><br>
                            <b>For only <strong>₱'.  number_format($row['product_price']).'!!!</strong></b>

                          </div>

                        </div>';
                    }
                    else
                    { 
                        echo '
                        <div class="item">
                         <img src="../pimage/'.$row['pm_img'].'"  style="width:100%;">
                          <div class="carousel-caption" style="font-size:20px; ">
                            <h1>'.$row['product_name'].'</h1>
                            <p>'.$row['product_description'].'</p>
                            <b>Total sold: <strong>'.$row['total quantity'].'</strong></b><br>
                            <b>For only <strong>₱'.  number_format($row['product_price']).'!!!</strong></b>

                          </div>
                         </div>';
                    } 
                     $counter++;
                  }

                 ?> 


                  </div>

                  <!-- Left and right controls -->
                  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>


                    <div class="col-md-12">
                     
                      
                       <div id="grid-selector" class="col-md-8">
                         <input type="text" placeholder="Search product..." class="form-control" id="search">
                       </div>
                        <div class="col-md-4">
                        
                     <div id="grid-selector"> 
                                     <div id="grid-menu">
                                         View:
                                         <ul>                
                                             <li class="largeGrid"><a href="" id="sm"></a></li>
                                             <li class="smallGrid"><a class="active" href="" id="lg"></a></li>
                                         </ul>
                                     </div>
                       </div>

                      </div>
                  </div>

                       
                                              <div class="col-md-12">

                              <div id="grid">  
                                   <div class="text-center">
           
                                      <div class="spinner-border" style="width: 30rem; height: 30rem; margin:0px 400px 400px 400px;"  role="status">
                                        <span class="sr-only">Loading...</span>
                                      </div>

                                    </div>
                              </div> 

                                  <div class="forbtn" role="group">
                                  </div>
                          </div>

                       

            <form method="POST" action="payment.php">
                        <!-- MAO NI ANG ICON NGA CART MAG MOVE.X-->
                       
                         <h3>
                            <button type="button" class=" btn btn-primary forh3" data-toggle="modal" data-target="#basicExampleModal" >
                             <img src="img/111.png" width="30px"><center><b>My Cart</b></center>
                            </button>
                         </h3>
                         <br><br>
                                  <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                  aria-hidden="true">
                                  <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                       <center> <h2 class="modal-title" id="exampleModalLabel">Cupcakes</h2></center>
  
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>


                                      </div>
                                      <div class="modal-body">
                                        <div id="cart"><center><img src="img/empty.png"></center></div>
                                      </div>
                                      <div class="modal-footer">
                                       
                                         <div  id="checkout" >
                                        <input class="float-right" type="submit" id="checkoutbtn" style="" name="sendItems" value="Checkout">
                                      </div>
                                      
                                       
                                      </div>
                                    </div>
                                  </div>
                                </div>
                  </form>
                                            
    </div>
    </div>


    </body>
    </html>

    <script src="js/livesearch.js"></script>
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
      
