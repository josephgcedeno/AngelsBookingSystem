
$(document).ready(function() {

		var prev=['open'];	


	  if($('input[type=radio][name=tabs]').val()=='open')
	  {

	  	$(`#content1`).html(`
	  		<script src="https://kit.fontawesome.com/bf8ae02d96.js"></script>
	  		<form method="POST" action="process/tableRequest.php" id="tableformreq">
         	 <table id="example" class="table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client Name</th>
                        <th>Contact Details</th>
		                <th>Ordered in</th>
		                  <th>Address</th>
                        <th>Orders</th>
                        <th>Options</th>
                    </tr>
                </thead>
               <tbody>

                	<tr>
                	 <td colspan="7">
                    	 <div class="text-center spinnerni">
                            <div class="spinner-grow" style=" padding:65px; width: 1rem; height: 1rem;" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                        </div>
                    </td>
                	</tr>
                </tbody>

                <tfoot>
                  <tr>
                        <th>ID</th>
                        <th>Client Name</th>
                        <th>Contact Details</th>
		                <th>Ordered in</th>
		                   <th>Address</th>
                        <th>Orders</th>
                        <th>Options</th>
                    
                  </tr>
                </tfoot>
          
            </table>
         </form>

            <div id="myModal" class="modal">
              <div class="modal-content">
                <div class="modal-header">
                  <center><h2>Orders & Comment</h2></center>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                </div>
            </div>`);

	  	$.ajax({
                    url: "process/jsonConverter.php",
                    type: "POST",
                    data: 
                    {
                      sql: `SELECT *  FROM pm_client WHERE client_status='open' `,
                  
                    
                    },
                    cache: false,
                    success: function(dataResult)
                    {		
                    	var data= dataResult.split("return$gfdbJSON$");
                        var dataSource=jQuery.parseJSON(data[1]);
                        tableContent(dataSource,'content1');
                    }
                });

	  	
	  	$(`#content1`).show();

	  }

	  $('input[type=radio][name=tabs]').change(function()
      { 	prev.push(this.value);
      	
      	 	if(prev.length>1)
      	 	{	
      	 		$(`#${getContent(prev[0])}`).html(``);
      	 		document.getElementById(`${getContent(prev[0])}`).style='';
      	 		prev.shift();
      	 	}
   			
			let appendthiscolumnoption='<th>Options</th>';
			let whichtab=getContent(this.value);
	    	if (getContent(this.value)=='content3' || getContent(this.value)=='content5') 
	    	{
	    		appendthiscolumnoption='';
	    	}
      	 $(`#${getContent(this.value)}`).html(` 

      	
		   <form method="POST" action="process/tableRequest.php" id="tableformreq">
		      <table id="example" class="table-bordered table-striped" style="width:100%">
		            <thead>
		                <tr>
		                    <th>ID</th>
		                    <th>Client Name</th>
		                    <th>Contact Details</th>
		                    <th>Ordered in</th>
		                     <th>Address</th>
		                    <th>Orders</th>
		                    ${appendthiscolumnoption}
		                   
		                </tr>
		            </thead>
		            <tbody>

                	<tr>
                	 <td colspan="7">
                    	 <div class="text-center spinnerni" >
                            <div class="spinner-grow" style=" padding:65px; width: 1rem; height: 1rem;" role="status">
                            <span class="sr-only">Loading...</span>
                          </div>
                        </div>
                    </td>
                	</tr>
                	</tbody>
		            <tfoot>
		              <tr>
		                    <th>ID</th>
		                    <th>Client Name</th>
		                    <th>Contact Details</th>
		                    <th>Ordered in</th>
		                     <th>Address</th>
		                    <th>Orders</th>
		                    ${appendthiscolumnoption}
		              </tr>
		            </tfoot>
		      
		        </table>
		     </form>

		        <div id="myModal" class="modal">
		          <div class="modal-content">
		            <div class="modal-header">
		              <center><h2>Orders & Comment</h2></center>
		            </div>
		            <div class="modal-body">
		            </div>
		            <div class="modal-footer">
		            </div>
		        </div>`
		        );	
      	 $(`#${getContent(this.value)}`).hide();
      	 $(`#${getContent(this.value)}`).slideToggle("very slow");


      	 $.ajax({
                    url: "process/jsonConverter.php",
                    type: "POST",
                    data: 
                    {
                      sql: `SELECT *  FROM pm_client WHERE client_status='${this.value}' `,
                  
                    
                    },
                    cache: false,
                    success: function(dataResult)
                    {		
                    	
                    	
                    	var data= dataResult.split("return$gfdbJSON$");
                        var dataSource=jQuery.parseJSON(data[1]);
                        tableContent(dataSource,whichtab);
                    		
					}
				});

		 });


} );


function tableContent(dataSource,whichtab)
{

	$(document).ready(function()
	{

                    		if (dataSource.length==0) 
                    		{	
                    			var	table1=$(`#example`).DataTable({
									        data:dataSource,
									        "order": [[1, 'asc']]
									    });
                    		}
                    		else if (whichtab == 'content3' || whichtab == 'content5') 
                    		{
                    			var	table=$(`#example`).DataTable({
									        data:dataSource,
									        "columns": [
									            {
									                "render":
									                function(data,type,row)
										            {
										      				return `
										            	<div class="table_info" aria-hidden="true"><span>${row.id}</span></div>`;
										            }  
									            },
									            {

									            	"render":
									                function(data,type,row)
										            {
										            	return `<i class="fas fa-user" style="font-size: 20px;"> <span style="font-weight: normal;"> ${row.client_fullname}</i>`;
										            }  
										        },
									            {	
									            	"orderable":      false,
									            	"render":
									                function(data,type,row)
										            {
															return `
															<i class="fab fa-facebook-square" aria-hidden="true"> <span>Facebook Account: ${row.client_fbname}</span></i><br><br>
															<i class="fas fa-envelope" aria-hidden="true"> <span style="font-weight: normal;">Email: ${row.client_email}</span></i><br><br>
															<i class="fas fa-phone" aria-hidden="true"> <span style="font-weight: normal;">Phone Number: ${row.client_phonenumber}</span></i>`;
												    }  
										        },

										        {	
									            
									            	"render":
									                function(data,type,row)
										            {
															return `<i class="fa fa-calendar" aria-hidden="true"> <span style="font-weight: normal;">${row.client_ordered}</span></i>`;

												    }  
										        },
										        {
										        	"orderable":      false,
									            	"render":
									                function(data,type,row)
										            {
										            	return `<i class="fa fa-location-arrow" aria-hidden="true" style="font-size: 15px;"> <span style="font-weight: normal;">${row.client_address}</span></i>`;
										            }  
										        },

									            {
									            	"className":      'orders',	
									            	"orderable":      false,
									            	"render":
									                function(data,type,row)
										            {
												            	return `
												            	<button type="button" class="btn btn-primary"  value="orders"><i class="fa fa-shopping-cart"></i> Orders</button`;
										          }  
										        }

									        ],
									        "order": [[1, 'asc']]
									    });	
                    		}

                    		else {
								var	table=$(`#example`).DataTable({
									        data:dataSource,
									        "columns": [
									            {
									                "render":
									                function(data,type,row)
										            {
										      				return `
										            	<div class="table_info" aria-hidden="true"><span>${row.id}</span></div>`;
										            }  
									            },
									            {

									            	"render":
									                function(data,type,row)
										            {
										            	return `<i class="fas fa-user" style="font-size: 20px;"> <span style="font-weight: normal;"> ${row.client_fullname}</i>`;
										            }  
										        },
									            {	
									            	"orderable":      false,
									            	"render":
									                function(data,type,row)
										            {
															return `
															<i class="fab fa-facebook-square" aria-hidden="true"> <span>Facebook Account: ${row.client_fbname}</span></i><br><br>
															<i class="fas fa-envelope" aria-hidden="true"> <span style="font-weight: normal;">Email: ${row.client_email}</span></i><br><br>
															<i class="fas fa-phone" aria-hidden="true"> <span style="font-weight: normal;">Phone Number: ${row.client_phonenumber}</span></i>`;
												    }  
										        },

										        {	
									            
									            	"render":
									                function(data,type,row)
										            {
															return `<i class="fa fa-calendar" aria-hidden="true"> <span style="font-weight: normal;">${row.client_ordered}</span></i>`;

												    }  
										        },
										        {
										        	"orderable":      false,
									            	"render":
									                function(data,type,row)
										            {
										            	return `<i class="fa fa-location-arrow" aria-hidden="true" style="font-size: 15px;"> <span style="font-weight: normal;">${row.client_address}</span></i>`;
										            }  
										        },

									            {
									            	"className":      'orders',	
									            	"orderable":      false,
									            	"render":
									                function(data,type,row)
										            {
												            	return `
												            	<button type="button" class="btn btn-primary"  value="orders"><i class="fa fa-shopping-cart"></i> Orders</button
															`;
										          }  
										        },
									            { 

									              "className":      'getIdToProcess',
									              "orderable":      false,
									              "render":
									              function(data,type,row)
									              {
									              	if (row.client_status=='open') 
										      		{
										      			return `<input type="submit" class="btn btn-primary" value="Confirm" name="open">
										      					<input type="submit" class="btn btn-warning" value="Cancel" name="cancel">
									              			    <input type="submit" class="btn btn-danger" value="Reject" name="reject">	`;
										      		}
										      		else if (row.client_status=='confirm') 
										      		{
										      			return `<input type="submit" class="btn btn-primary" value="Done" name="done">
									              			    <input type="submit" class="btn btn-warning" value="Cancel" name="cancel">
									              			   `;
										      		}
										      		else if (row.client_status=='reject') 
										      		{
										      			return `
									              			    <input type="submit" class="btn btn-primary" value="Re-confirm" name="open">
									              			   `;
										      		
										      		}
										      		
									              }
									           
									            }
									        ],
									        "order": [[1, 'asc']]
									    });	

							}

		$(`#example`).on('click', `td.getIdToProcess`, function () 
									    {		

										        var tr = $(this).closest('tr');
										        var row = table.row( tr );
											    var dataId=row.data().id;
											    var inners=$(`td.getIdToProcess`).append(`
											    		<input type="hidden" name="emailtosend" value="${row.data().client_email}">
												    	<input type="hidden" value="${dataId}" name="clientid">`);	
																
									    });
									    $(`#example`).on('click', `td.open`, function () 
									    {		

										        var tr = $(this).closest('tr');
										        var row = table.row( tr );
											    var dataId=row.data().id;

											    var inners=$(`td.open`).append(`
											    	<input type="hidden" name="emailtosend" value="${row.data().client_email}">
												    	<input type="hidden" value="${dataId}" name="clientid">`);	
																
									    });


										$(`#example`).on('click',`td.orders`, function ()
										{	
											  var tr = $(this).closest('tr');
										      var row = table.row( tr );
											  var dataId=row.data().id;
											  var modal = document.getElementById("myModal");
											  var span = document.getElementsByClassName("close")[0];   
												
											  $('.modal-header').html(`<i class="fa fa-shopping-cart" style="margin-right:10px;"</i> Please wait...</p>`);
											  	$('.modal-body').html(`
 									        	<div class="text-center" style="padding:65px;">
												  <div class="spinner-border" style="padding:65px; width: 5rem; height: 5rem;" role="status">
													  <span class="sr-only">Loading...</span>
													</div>
												</div>
 									        	`);

											  $.ajax({
											        url: "process/jsonConverter.php",
								                    type: "POST",
								                    data: 
								                    {
								                      sql: `SELECT
															c.id,c.client_fullname,c.client_fbname,c.client_email,c.client_phonenumber,c.client_status,c.client_expense,c.client_ordered ,
															b.product_name,b.product_price, r.client_id,r.product_id,r.quantity,r.comments
															FROM  pm_client_bridge r
															INNER JOIN pm_product b ON r.product_id=b.id
															INNER JOIN pm_client c ON r.client_id = c.id  `,
								                    
								                    },
								                    cache: false,
								                    success: function(dataResult)
								                    {		
								                    	

								                    	var data= dataResult.split("return$gfdbJSON$");
								                        var dataSource=jQuery.parseJSON(data[1]);
											       		var items = [];
											       	 $.each(dataSource, function(key, val) {

											       	 		if (val.id==dataId) 
											       	 		{	
											       	 				items.push(val)
											       	 		}
											            //items.push('<li id="' + key + '">' + val + '</li>');    
											          });
											     	var peste ='';
											     	var total=0;
											     	var name;
											       	for(var i=0;i<items.length;i++)
											       	{	var comment=items[i]['comments'].split('$gfdb$');
											       		let actualComment="";
											       		for(var j=0;j<comment.length;j++)
											       		{
											       			actualComment+=comment[j]+" ";
											       		}

											       		var multiply=parseInt(items[i]['quantity'])*parseInt(items[i]['product_price']);
											       			 total+=multiply;
											       		 peste+=`
												       		  	<tr>
												       		  		<td>${items[i]['product_name']}</td>
												       		  		<td>${items[i]['quantity']}</td>
												       		  		<td>${items[i]['product_price']}</td>
												       		  		<td>${actualComment}</td>
												       		  		<td>${(multiply).toLocaleString('en-PH', {
																		 currency: 'PHP', style: 'currency'
																		})}</td>
												       		  		
												       		  	</tr>
											       		   `;
											       		   name=items[i]['client_fullname']
											       	}
											   		$(`.loading`).hide();
											  		$('.modal-header').html(``);
											       	$('.modal-header').html(`<i class="fa fa-shopping-cart" style="margin-right:10px;"</i> ${name}<p>Orders and Comments</p>`);
											       			peste+=`<tr>
												       		  		<td></td>
												       		  		<td></td>
												       		  		<td></td>
												       		  		<td></td>
												       		  		<td>${(multiply).toLocaleString('en-PH', {
																		 currency: 'PHP', style: 'currency'
																		})}</td>
												       		  	</tr>`;

												       		  		$('.modal-body').html(``);
														       	$('.modal-body').html(`
														       		<table class="table table-stripped" style="margin-top: 15px;">
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
											  modal.style.display = "block";
											  
											  window.onclick = function(event) 
											  {
											  if (event.target == modal) 
											    {
											    	 $('.modal-header').html(``);
									                 $('.modal-body').html(``);
											  	 	 modal.style.display = "none";
											    }
											  }
										});



									$(`.spinner-border`).hide();					


		
			 					
			 $(`#tableformreq`).submit(function(event)
			 {
			
			   		 $(`.month`).hide();
			   		 $(`.weekdays`).hide();
			   		 $(`.days`).hide();
			   		 $(`.tabs`).hide();
			 		 $('body').css({'background-color':'white'});
			 		 $(`.loading`).html('');
		 		     $('.loading').html(`
 								        	<div class="text-center" style="padding:65px;">
											  <div class="spinner-border" style="padding:100%; width: 5rem; height: 5rem;" role="status">
												  <span class="sr-only">Loading...</span>
												</div>
											</div>
 								        	`);
			   		 $(`.loading`).show();
					
			   
			 }); 

	});
}


	
			



$(document).ready(()=>
{

  
});

function getContent(content)
{
	var contentno;
	switch(content)
    {
		case 'open':
				contentno='content1';
	   			break;
	 	case 'confirm':
	 			contentno='content2';
	 			break;
	    case 'cancel':
	    		contentno='content3';
	   		 	break;
	   	case 'reject':
	   			contentno='content4';
	 			break;
	    case 'done':
	    		contentno='content5';
	   		 	break;
   }
   return contentno;

}











