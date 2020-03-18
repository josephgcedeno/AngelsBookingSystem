<?php

		
	require_once( '../../run.php');
	session_start();
	$recordpage=9;
	$page;
	$output='';
	if (isset($_POST['page']) ) 
	{
		$page=$_POST['page'];
	}
	else
	{
		$page=1;
	}
	$start_from=($page-1)*$recordpage;
		echo 'separatethis';
		$results=$gfdb->selectRestrictFromTable("   
				           SELECT
                   c.id,c.product_name,c.product_price,c.product_description,
                   b.pm_img1,b.pm_img 
                   FROM  pm_product c
                   INNER JOIN pm_product_img b 
                   ON c.id=b.pm_product_id
                   ORDER BY c.id
                   DESC
                   LIMIT $start_from, $recordpage");
  	$ss='';
		while ( $row = mysqli_fetch_array($results)) 
     {  
                    
                     $ss.= '<div class="product" id="product'.$row['id'].'">
                                                       <div class="info-large">
                                                       <h2>'.$row['product_name'].'</h2> 
                                                       <div class="price-big" id="pPrice'.$row['id'].'">₱ 
                                                          '.$row['product_price'].'
                                                      </div>
                                                  
                                       
                                                         <strong>Quantity</strong><br> 
                                                         <img src="img/minus.png" style="width: 15px; cursor:pointer;" 
                                                         onclick="decrement(\'bigcart-'.$row['id'].'\')">
                                                              <input type="text" class="product_quantity"  name="input" style="width: 30px; margin-left: 10px;  margin-right: 10px; text-align: center;" value="1" 
                                                              id="quantity1'.$row['id'].'" >
                                                         <img src="img/plus.png" style="width: 15px; cursor:pointer;" onclick="increment(\'bigcart-'.$row['id'].'\')">
                                                              <div class="comment" style="position:absolute; margin-top:-103px; margin-left:140px;">
                                                                       <strong> Comment </strong><br>
                                                                       <textarea type="text" cols="12" rows="4" placeholder="comment"  name="comments"
                                                                            id="comment1'.$row['id'].'" ></textarea>
                                                                       </div>
                                                
                                                     <button class="add-cart-large" id="'.$row['id'].'" >Add To Cart
                                                     </button>                          
                                                </div> 
                                                 <div class="make3D">
                                                       <div class="product-front">
                                                           <div class="shadow"></div>
                                                           <img src="../pimage/'.$row['pm_img1'].'" alt=""/>
                                                           <div class="image_overlay"></div>
                                                           <div class="add_to_cart" id="'.$row['id'].'">Add to cart </div>
                                                           <div class="view_gallery">View gallery</div>
                                                           <div class="stats">         
                                                               <div class="stats-container">
                                                                   <div class="row">
                                                                   <input type="password" name="idProduct"  hidden>
                                                                 
                                                                   <span class="col-md-12 product_price" >₱'.$row['product_price'].'</span>
                                                               
                                                                   <span class="col-md-12 product_name"><h2>'.$row['product_name'].'</h2></span> 
                                                                   <div class="col-md-12">
                                                                   <p>'.$row['product_description'].'</p></div> 
                                       
                                                                    <div class="product-options">
                                                                     <div class="row">
                                                                       <div class="col-md-6">
                                                                           <strong>Quantity</strong><br> 
                                                                           <img src="img/minus.png" style="width: 15px; cursor:pointer;" onclick="decrement(\'smallcart-'.$row['id'].'\')" >
                                                                               <input type="text" class="product_quantity"  name="input" style="width: 30px; margin-left: 10px;  margin-right: 10px; text-align: center; " value="1" 
                                                                                id="quantity'.$row['id'].'" >
                                                                           <img src="img/plus.png" style="width: 15px; cursor:pointer;" onclick="increment(\'smallcart-'.$row['id'].'\')" />
                                                                       </div>
                                                                       <div class="col-md-6">
                                                                           <strong> Comment </strong><br>
                                                                           <textarea type="text" cols="13" rows="2" placeholder="comment"  name="comments" 
                                                                                id="comment'.$row['id'].'" ></textarea>
                                                                       </div>
                                                                       </div>
                                                                   </div>
                                       
                                                                   </div>                           
                                                               </div>                         
                                                           </div>
                                                   </div>
                                                   <div class="product-back">
                                                       <div class="shadow"></div>
                                                       <div class="carousel">
                                                           <ul class="carousel-container">
                                                               <li><img src="../pimage/'.$row['pm_img1'].'" alt="" /></li>
                                                               <li><img src="../pimage/'.$row['pm_img'].'" alt="" /></li>
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
                                                             </div>
                                                             ';
        }

        
        $totalrecord=mysqli_num_rows($gfdb->selectRestrictFromTable("SELECT  id FROM  pm_product"));
        $totalpages=ceil($totalrecord/$recordpage);
        $ss.='separatethis';
        for ($i=1; $i<=$totalpages ; $i++) 
        { 
          if ($i==$page) 
          {
             $ss.='<button type="button" class="pagination_link btn btn-primary active" id="'.$i.'">'.($i).'</button>';
          }
          else
          {
            $ss.='<button type="button" class="pagination_link btn btn-primary" id="'.$i.'">'.($i).'</button>';
          }
        }
		echo $ss;
?>