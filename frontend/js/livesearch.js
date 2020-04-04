     /*DYNAMIC PAGINATION*/
  
    loades(1);
    function loades(page)
    {
          
        $.ajax(
        {
          url: "process/paginate.php",
          method: "POST",
          data:
          {
            page:page
          },
          cache:false,
          success:function(data)
          {
            let display=data.split(`separatethis`);
            $(`#grid`).html(display[1]);
            $(`.forbtn`).html(` <center>${display[2]}</center>`);
             var s = document.createElement("script");
             s.src = "js/menu.js";
            $(`#grid`).append(s);
        
            
            if($('li.largeGrid a').hasClass('active'))
            { 
                  $('.smallGrid a').removeClass('active');
                  $('.product').addClass('large').each(function(){                                            
                  });                     
                  setTimeout(function(){
                      $('.info-large').show();    
                  }, 1);
                  setTimeout(function(){
                      $('.view_gallery').trigger("click");    
                  }, 35); 

            }

          }

        });
    }


      /*LIVE SEARCHING */
  $(document).ready(function()
  {
    $(document).on('click','.pagination_link', function()
    {   
        $(`#grid`).html(``);
        $(`#grid`).html(`
          <div class="text-center">
            <div class="spinner-border" style="width: 30rem; height: 30rem; margin:0px 400px 400px 400px;"  role="status">
              <span class="sr-only">Loading...</span>
            </div>

          </div>`);
        $(`button.pagination_link`).prop('disabled',true);
        setTimeout(()=>
        {
             loades($(this).attr("id"));
        },1000);
    })



     let data;
     let dataSource;
      $.ajax(
            {
               url: "process/jsonConverter.php",
               type: "POST",
               data: 
               {
                 sql: `SELECT
                       c.id,c.product_name,c.product_price,c.product_description,
                       b.pm_img1,b.pm_img 
                       FROM  pm_product c
                       INNER JOIN pm_product_img b ON c.id=b.pm_product_id `,
               },
               cache: false,
               success: function(data) 
               { 
                    data= data.split("return$gfdbJSON$");
                    dataSource=jQuery.parseJSON(data[1]);
               }
            });
      let counter=0;
      $('#search').keyup(function()
      {

        $(`.forbtn`).html('');
        $('#grid').html('');
            var searchField = $('#search').val();
            var expression = new RegExp(searchField, "i");
            var ss=true;
            $.each(dataSource,function(key,value)
            {  
                                if (value.product_name.search(expression)!= -1) 
                                {

                              
                                                        $('#grid').append(`

                                                          <div class="product" id="product${value.id}">
                                                                 <div class="info-large">
                                                          <h2>${value.product_name}</h2> 
                                                          <div class="price-big" id="pPrice${value.id}">₱ 
                                                             ${value.product_price} 
                                                          </div>
                                                        
                                                                          <strong>Quantity</strong><br> 
                                                                          <img src="img/minus.png" style="width: 15px;" onclick="decrement('bigcart-${value.id}')">
                                                                               <input type="text" class="product_quantity"  name="input" style="width: 30px; margin-left: 10px;  margin-right: 10px; text-align: center; " value="1" id="quantity1${value.id}" >
                                                                          <img src="img/plus.png" style="width: 15px;" onclick="increment('bigcart-${value.id}')">
                                                       
                                                                           <div class="comment" style="position:absolute; margin-top:-103px; margin-left:140px;">
                                                                                  <strong> Comment </strong><br>
                                                                                  <textarea type="text" cols="12" rows="4" placeholder="comment"  name="comments"
                                                                                       id="comment1${value.id}" ></textarea>
                                                                                  </div>

                                                          
                                                          <button class="add-cart-large" id="${value.id}" >Add To Cart</button>                          
                                                    </div> 
                                             
                     <div class="make3D">
                          <div class="product-front">
                              <div class="shadow"></div>
                              <img src="../pimage/${value.pm_img1}" alt=""/>
                              <div class="image_overlay"></div>
                              <div class="add_to_cart" id="${value.id}">Add to cart </div>
                              <div class="view_gallery">View gallery</div>
                              <div class="stats">         
                                  <div class="stats-container">
                                      <div class="row">
                                      <input type="password" name="idProduct"  hidden>
                                    
                                      <span class="col-md-12 product_price" >₱ ${value.product_price}</span><!-- PRODUCT PRICEE -->
                                  
                                      <span class="col-md-12 product_name"><h2>${value.product_name}</h2></span> <!-- cupcake name -->  
                                      <div class="col-md-12">
                                      <p>${value.product_description}</p></div> <!-- cupcake description 
                                      -->          

                                       <div class="product-options">
                                        <div class="row">
                                          <div class="col-md-6">
                                              <strong>Quantity</strong><br> 
                                              <img src="img/minus.png" style="width: 15px; cursor:pointer;" onclick="decrement('smallcart-${value.id}')" >
                                                  <input type="text" class="product_quantity"  name="input" style="width: 30px; margin-left: 10px;  margin-right: 10px; text-align: center; " value="1" 
                                                   id="quantity${value.id}" >
                                              <img src="img/plus.png" style="width: 15px; cursor:pointer;" onclick="increment('smallcart-${value.id}')" />
                                          </div>
                                          <div class="col-md-6">
                                              <strong> Comment </strong><br>
                                              <textarea type="text" cols="13" rows="2" placeholder="comment"  name="comments" 
                                                   id="comment${value.id}" ></textarea>
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
                                                                  <li><img src="../pimage/${value.pm_img1}" alt="" /></li>
                                                                  <li><img src="../pimage/${value.pm_img}" alt="" /></li>
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

            if ($('#grid').text()=='') 
            { 
                $('#grid').append(`<h4>Product not found!</h4>`);
            }
            if ($('#search').val()=='') 
            {
                  loades(1);
            }
            $('#grid').append('<script src="js/menu.js"></script> ');
      });
       

    });

