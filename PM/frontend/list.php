 <?php

        require_once('../run.php');
        session_start();
        /*$arrayColoumns=['id','product_name','product_price','product_day','product_description','product_images'];
        $gfdb->makeDataFromDatabaseToJasonFormat(
          "SELECT *  FROM pm_product",$arrayColoumns,6,"../frontend/js/product.json"
        );*/

 ?>

  <!DOCTYPE html>
    <html>
    <head>
      <title>List of products</title>
      <link rel='stylesheet' type='text/css' href='css/css.css' >
      <link rel="stylesheet" type="text/css" href="css/list.css">
       <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
 
    <script src="js/jquery.min.js"></script>

     <script src="js/livesearch.js"></script>
    </head>
    <body>
    <div id="wrapper">


      
            



            <div id="header"> 
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">BRANDS</a></li>
                    <li><a href="">DESIGNERS</a></li>
                    <li><a href="">CONTACT</a></li>                                              
                </ul>   
            </div>

            <div id="sidebar">
             
              <form method="POST" action="payment.php">
        
                  <div class="cart-icon-top"></div>

                    <div class="cart-icon-bottom"></div>
                     <h3>CART</h3>
                <div id="cart">
                  <span class="empty">No items in cart.</span>       
                </div>
                    <div id="checkout">
                      <input type="submit" name="sendItems" value="Checkout">
                    </div>
              </form>
              </div>

          

        <div id="grid-selector"> 
              <input type="text" placeholder="Search product..." class="form-control" style="width: 30% !important;  position: absolute;" id="search">

               <div id="grid-menu">
                   View:
                   <ul>                
                       <li class="largeGrid"><a href="" id="sm"></a></li>
                       <li class="smallGrid"><a class="active" href="" id="lg"></a></li>
                   </ul>

               </div>
        </div><br>
        
         
       <div id="grid">
          <?php   

         $values=$gfdb->selectAllFromTable('pm_product'); 
          $pictures=[];
    
         while ( $row = mysqli_fetch_array($values)) 
         {  
            $pictures=explode('$GF@',$row['product_images']);
            echo '<div class="product" id="product'.$row['id'].'">
                          <div class="info-large">
                          <h2>'.$row['product_name'].'</h2> 
                          <div class="price-big" id="pPrice'.$row['id'].'">
                             '.$row['product_price'].'
                         </div>
                        <div class="product-options">
                            <strong>Estimated Date</strong>
                            <span>'.$row['product_day'].' Days</span> <!-- dynamic input of date -->
                            <strong>Quantity</strong><br> 
                            <img src="img/minus.png" style="width: 15px;" 
                            onclick="decrement(\'bigcart-'.$row['id'].'\')">
                                 <input type="text" class="product_quantity"  name="input" style="width: 30px; margin-left: 10px;  margin-right: 10px; text-align: center;" value="1" 
                                 id="quantity1'.$row['id'].'" >
                            <img src="img/plus.png" style="width: 15px;" onclick="increment(\'bigcart-'.$row['id'].'\')">
                                 <div class="comment" style="position:absolute; margin-top:-103px; margin-left:140px;">
                                          <strong> Comment </strong><br>
                                          <textarea type="text" cols="12" rows="4" placeholder="comment"  name="comments"
                                               id="comment1'.$row['id'].'" ></textarea>
                                          </div>
                       </div> 
                        <button class="add-cart-large" id="'.$row['id'].'" >Add To Cart
                        </button>                          
                   </div> 
                    <div class="make3D">
                          <div class="product-front">
                              <div class="shadow"></div>
                              <img src="../pimage/'.$pictures[0].'" alt=""/>
                              <div class="image_overlay"></div>
                              <div class="add_to_cart" id="'.$row['id'].'">Add to cart </div>
                              <div class="view_gallery">View gallery</div>
                              <div class="stats">         
                                  <div class="stats-container">
                                      <input type="password" name="idProduct"  hidden>
                                      <span class="product_price" >P'.$row['product_price'].'</span><!-- PRODUCT PRICEE -->
                                      <span class="product_name"><h2>'.$row['product_name'].'</h2></span> <!-- cupcake name -->  
                                      <p>'.$row['product_description'].'</p> <!-- cupcake description -->                                            
                                       <div class="product-options">
                                          <strong>Estimated Date</strong>
                                          <span>'.$row['product_day'].' Days</span> <!-- dynamic input of date -->
                                          <strong>Quantity</strong><br> 
                                          <img src="img/minus.png" style="width: 15px;" onclick="decrement(\'smallcart-'.$row['id'].'\')" >
                                               <input type="text" class="product_quantity"  name="input" style="width: 30px; margin-left: 10px;  margin-right: 10px; text-align: center; " value="1" 
                                               id="quantity'.$row['id'].'" >
                                          <img src="img/plus.png" style="width: 15px;" onclick="increment(\'smallcart-'.$row['id'].'\')" />

                                          <div class="comment" style="position:absolute; margin-top:-105px; margin-left:140px;">
                                          <strong> Comment </strong><br>
                                          <textarea type="text" cols="12" rows="4" placeholder="comment"  name="comments" 
                                               id="comment'.$row['id'].'" ></textarea>
                                          </div>


                                      </div>                           
                                  </div>                         
                              </div>
                      </div>
                      <div class="product-back">
                          <div class="shadow"></div>
                          <div class="carousel">
                              <ul class="carousel-container">
                                  <li><img src="../pimage/'.$pictures[0].'" alt="" /></li>
                                  <li><img src="../pimage/'.$pictures[1].'" alt="" /></li>
                              </ul>
                              <div class="arrows-perspective">
                                  <div class="carouselPrev">
                                      <div class="y"></div>
                                      <div class="x"></div>
                                  </div>
                                  <div class="carouselNext">
                                      <div class="y"></div>
                                      <div class="x"></div>
                                  </div>
                              </div>
                          </div>
                          <div class="flip-back">
                              <div class="cy"></div>
                              <div class="cx"></div>
                          </div>
                      </div>    
                  </div>  
                                </div>';
         }
         ?>






       </div>




    </div>




 
  

    </body>
    </html>

    <script src="js/menu.js"></script> 
      
    <!--<script type="text/javascript" src="js/products.js"></script>  -->