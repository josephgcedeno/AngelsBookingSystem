      
  $(document).ready(function()
    {

      $('#search').keyup(function()
      {



        $('#grid').html('');
            var searchField = $('#search').val();
            var expression = new RegExp(searchField, "i");
          $.getJSON('js/product.json',function(data)
          { 
                $.each(data,function(key,value)
                {  
                  if (value.product_name.search(expression)!= -1) 
                  {

                    var pictures=(value.product_images).split("$GF@");
              $('#grid').append(`

                <div class="product" id="product${value.id}">
                       <div class="info-large">
                <h2>${value.product_name}</h2> 
                <div class="price-big" id="pPrice${value.id}">
                   ${value.product_price} 
                </div>
               <div class="product-options">
                                <strong>Estimated Date</strong>
                                <span>${value.product_day} Days</span> <!-- dynamic input of date -->
                                <strong>Quantity</strong><br> 
                                <img src="img/minus.png" style="width: 15px;" onclick="decrement('bigcart-${value.id}')">
                                     <input type="text" class="product_quantity"  name="input" style="width: 30px; margin-left: 10px;  margin-right: 10px; text-align: center; " value="1" id="quantity1${value.id}" >
                                <img src="img/plus.png" style="width: 15px;" onclick="increment('bigcart-${value.id}')">
             
                                 <div class="comment" style="position:absolute; margin-top:-103px; margin-left:140px;">
                                        <strong> Comment </strong><br>
                                        <textarea type="text" cols="12" rows="4" placeholder="comment"  name="comments"
                                             id="comment1${value.id}" ></textarea>
                                        </div>

                </div> 
                <button class="add-cart-large" id="${value.id}" >Add To Cart</button>                          
          </div> 
          <div class="make3D">
                <div class="product-front">
                    <div class="shadow"></div>
                    <img src="../pimage/${pictures[0]}" alt=""/>
                    <div class="image_overlay"></div>
                    <div class="add_to_cart" id="${value.id}">Add to cart </div>
                    <div class="view_gallery">View gallery</div>
                    <div class="stats">         
                        <div class="stats-container">
                            <input type="password" name="idProduct"  hidden>
                            <span class="product_price" >P${value.product_price}</span><!-- PRODUCT PRICEE -->
                            <span class="product_name"><h2>${value.product_name}</h2></span> <!-- cupcake name -->  
                            <p>${value.product_description}</p> <!-- cupcake description -->                                            
                             <div class="product-options">
                                <strong>Estimated Date</strong>
                                <span>${value.product_price} Days</span> <!-- dynamic input of date -->
                                <strong>Quantity</strong><br> 
                                <img src="img/minus.png" style="width: 15px;" onclick="decrement('smallcart-${value.id}')">
                                     <input type="text" class="product_quantity"  name="input" style="width: 30px; margin-left: 10px;  margin-right: 10px; text-align: center; " value="1" id="quantity${value.id}" >
                                <img src="img/plus.png" style="width: 15px;" onclick="increment('smallcart-${value.id}')">
                              
                                          <div class="comment" style="position:absolute; margin-top:-105px; margin-left:140px;">
                                          <strong> Comment </strong><br>
                                          <textarea type="text" cols="12" rows="4" placeholder="comment"  name="comments" 
                                               id="comment${value.id}" ></textarea>
                                          </div>


                            </div>  

                        </div>                         
                    </div>
            </div>
            <div class="product-back">
                <div class="shadow"></div>
                <div class="carousel">
                    <ul class="carousel-container">
                        <li><img src="../pimage/${pictures[0]}" alt="" /></li>
                        <li><img src="../pimage/${pictures[1]}" alt="" /></li>
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
                       `);

                  }



                });

      	$('#grid').append(' <script src="js/menu.js"></script> ');
          }); 

      });
       

    });

