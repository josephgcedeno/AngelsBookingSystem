
function edit(id,pname,pprice,pdescription,pimg1,pimg2)
{
	$(document).ready(function()
	{
			
		

		/*<input type="hidden" id="desc${row.id}" class="form-control">
		<input type="hidden" id="img1${row.id}" class="form-control">
		<input type="hidden" id="img2${row.id}" class="form-control">	*/
		/*edit product name*/
		$(`#productColumn${id}`).html(`
			<input type="hidden" id="truename${id}"  value="${pname}">
		
			<input type="text" id="col4${id}" name="col4" class="form-control" value="${pname}">
		`);
		/*edit product price*/

		$(`#priceColumn${id}`).html(`
			<input type="hidden" id="trueamount${id}"  value="${pprice}">
			<input type="text" id="col5${id}" name="col5" class="form-control" value="${pprice}">
		`);



			/*edit FOR DESCRIPTION*/
			$(`#moreInfo1${id}`).html(`
				<textarea class="form-control" id="col1${id}"  name="col1" cols="30" rows="5"  >${pdescription}</textarea>`);

			/*edit FIRST IMAGE*/
			$(`#moreInfo2${id}`).html(`
	                  <div id='img_contain' "><img id="imageone${id}" align='middle' src="../pimage/${pimg1}" alt="your image" width="300px" title=''/></div> 
	                  <div class="input-group"> 
	                  <div class="custom-file"  align='middle'>
	                  <input type="file" id="inputGroupFile1ff${id}"  name="col2" class="imgInp custom-file-input" aria-describedby="inputGroupFileAddon02">
	                  <label class="custom-file1${id}-label" for="inputGroupFile1ff${id}"><img src="../pimage/icons/editpen.png" width="20px"></label>
	                  </div>
	                  </div>

			`);
			
			/*edit SECOND IMAGE*/
			$(`#moreInfo3${id}`).html(`
	                  <div id='img_contain' "><img id="imagetwo${id}" align='middle' src="../pimage/${pimg2}" alt="your image" width="300px" title=''/></div> 
	                  <div class="input-group"> 
	                  <div class="custom-file"  align='middle'>
	                  <input type="file" id="inputGroupFile2ff${id}"  name="col3" class="imgInp custom-file-input" aria-describedby="inputGroupFileAddon02">
	                  <label class="custom-file2${id}-label" for="inputGroupFile2ff${id}"><img src="../pimage/icons/editpen.png" width="20px"></label>
	                  </div>
	                  </div>

			`);

						
		$(`#submitBtn${id}`).html('');


		
			$(`#submitBtn${id}`).html(`
			<button type="button" class="btn-primary btn" onclick="submitUpdates(${id})"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button>
			<button type="button" class="btn-danger btn"  onclick="cancelEdit(${id},'${pname}','${pprice}','${pdescription}','${pimg1}','${pimg2}')"><i class="fa fa-close" aria-hidden="true"></i> Cancel</button>
			`);
			image1=pimg1;
			image2=pimg2;


	});
	

}


function submitUpdates(id)
{
	$(document).ready(function()
	{

						var newValForCol1=$(`#col1${id}`).val();
						var newValForCol2=$(`#inputGroupFile1ff${id}`).val();
						var newValForCol3=$(`#inputGroupFile2ff${id}`).val();
						var newValForCol4=$(`#col4${id}`).val();
						var newValForCol5=$(`#col5${id}`).val();
						var fd = new FormData();
				        var files = $(`#inputGroupFile1ff${id}`)[0].files[0];
				        var files1 =$(`#inputGroupFile2ff${id}`)[0].files[0];
				        
				        if (files==null) 
				        {
				        	fd.append(`origimg1`,image1);
				        }
				        else
				        {
				        	fd.append(`image1`,files);

				        }

				        if (files1==null) 
				        {
				        	fd.append(`origimg2`,image2);

				        }
				        else
				        {
				       		fd.append(`image2`,files1);

				        }

				        fd.append(`description`,newValForCol1);
				        fd.append(`productName`,newValForCol4);
				        fd.append(`productPrice`,newValForCol5);
				        fd.append(`id`,id);

				        /*THIS WILL SEND REQUEST TO PHP FILE TO MOVE IMAGES*/
				        $.ajax(
				        {
				            url: 'process/moveimage.php',
				            type: 'post',
				            data:fd,
				            contentType: false,
				            processData: false
				        });

					    req= $.ajax(
						{
									url:'process/insert.php',
									type:'POST',
									data:fd,
				            		contentType: false,
				            		processData: false,
									success : function(response)
									{	
										let disect=response.split("returnthis")

										if (disect[1]=='alreadyexist!' || !$.isNumeric(newValForCol5)) 
										{

											if (!$.isNumeric(newValForCol5)) 
											{
												$(`#modalForUpdatePrompt`).html(`

												 <div class="alert1 alert-danger" role="alert1">
										            <span class="close">&times;</span>
										            <strong>Product price must be numeric!</strong>
										        
										            </div>
												`);
											}
											else
											{
												$(`#modalForUpdatePrompt`).html(`

													 <div class="alert1 alert-danger" role="alert1">
											            <span class="close">&times;</span>
											            <strong>Product Name already Exist!</strong>
											        
											            </div>
													`);
											}
										}
										else
										{
				  
											let disect1=disect[1].split("$GF@");
											$(`#pro${id}`).val(newValForCol4);
											$(`#pri${id}`).val(newValForCol5);
											$(`#desc${id}`).val(newValForCol1);
											$(`#img1${id}`).val(disect1[0]);
											$(`#img2${id}`).val(disect1[1]);
											$(`#check${id}`).val(id);
											$(`#truename${id}`).val(newValForCol4);
											$(`#trueamount${id}`).val(newValForCol5);
											$(`#submitBtn${id}`).html(``);
											$(`#submitBtn${id}`).html(`
											<button type="button" class="btn-primary btn" onclick="submitUpdates(${id})"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button>
										    <button type="button" class="btn-danger btn"  onclick="cancelEdit(${id},'${newValForCol4}','${newValForCol5}','${newValForCol1}','${disect1[0]}','${disect1[1]}')"><i class="fa fa-close" aria-hidden="true"></i> Cancel</button>
											`);
											
											check=id;
											$(`#modalForUpdatePrompt`).html(`

												  <div class="alert1 alert-success" role="alert1">
										            <span class="close">&times;</span>
										            <strong>Successfully Updated!</strong>
										        
										            </div>
												`);

										}
										var modal = document.getElementById("modalForUpdatePrompt");
										var span = document.getElementsByClassName("close")[0];

										modal.style.display = "block";
										$(`.close`).on('click',function()
										{

											modal.style.display = "none";

										});

										window.onclick = function(event) 
										{
										  if (event.target == modal) {
										    modal.style.display = "none";
										  }
										}

											
									}
						});

				
	});

}


function cancelEdit(id,pname,pprice,pdescription,pimg1,pimg2)
{


	
		$(document).ready(function()
		{

			$(`#productColumn${id}`).text(` ${pname}`);
			$(`#priceColumn${id}`).text(` ${pprice}`);
			$(`#moreInfo1${id}`).text(pdescription);
			$(`#moreInfo2${id}`).html(`<img src="../pimage/${pimg1}" width="300px" style="border-raduis:10px;">`);
			$(`#moreInfo3${id}`).html(`<img src="../pimage/${pimg2}" width="300px" style="border-raduis:10px;">`);
			$(`#submitBtn${id}`).html('');
			$(`#submitBtn${id}`).html(`<button type="button" class="btn-primary btn" onclick="edit(${id},'${pname}','${pprice}','${pdescription}','${pimg1}','${pimg2}')"><i class="fa fa-edit"></i>  Edit</button>`);
			
	  	
		});

}
function format (d) {
    
	    return `
	    <table cellpadding="5" class="table-bordered table-striped" cellspacing="0" border="0" style="padding-left:50px; width:100%;" id="tabledrop" >
	        <tr>
	            <th>Product Description</th>
	            <th>Product Image 1</th>
	            <th>Product Image 2</th>
	            <th>Option</th>
	        </tr>
	        <tr>
	              <td id="moreInfo1${d.id}" style="font-style:italic; text-align: center;">"${d.product_description}"</td>
	              <td id="moreInfo2${d.id}"><img src="../pimage/${d.pm_img1}" width="300px" style="border-raduis:10px;"></td>
	              <td id="moreInfo3${d.id}"><img src="../pimage/${d.pm_img}" width="300px" style="border-raduis:10px;"></td>
	              <td id="submitBtn${d.id}">
	             	 <button type="button" class="btn-primary btn" style = "margin-top: 80px; margin-left: 50px;"  onclick="edit(${d.id},'${d.product_name}','${d.product_price}','${d.product_description}','${d.pm_img1}','${d.pm_img}')"><i class="fa fa-edit"></i>  Edit</button>
	              </td>
	         </tr>
	    </table>`;
        
}






$(document).ready(function() 
{
				 $.ajax({
                    url: "process/jsonConverter.php",
                    type: "POST",
                    data: 
                    {
                      sql: ` SELECT
          					 c.id,c.product_name,c.product_price,c.product_description,
         					 b.pm_img1,b.pm_img 
         					 FROM  pm_product_img b 
          					 INNER JOIN pm_product c
          					 ON b.pm_product_id=c.id
                             `
                    },
                    success: function(dataResult)
                    {
		                    		var data= dataResult.split("return$gfdbJSON$");
		                    		var dataResult1=jQuery.parseJSON(data[1]);
		                    		var table = $('#example').DataTable({
							        data: dataResult1,
							        "columns": 
							        [
							            {
							                "className":      'details-control',
							                "orderable":      false,
							                "render":
							                function(data,type,row)
								            {
							                return `<input type="hidden" id="pro${row.id}">
											 		<input type="hidden" id="pri${row.id}">
							                		<input type="hidden" id="desc${row.id}">
											 		<input type="hidden" id="img1${row.id}" value="${row.pm_img1}" name="image1[]">
											 		<input type="hidden" id="img2${row.id}" value="${row.pm_img}" name="image2[]">
											 		<input type="hidden" id="check${row.id}">`;
							           		}
							            },
							            {
							            	"render":
							                function(data,type,row)
								            {
				      
								            	return `
								            	<h5 class = "align-middle" id="productColumn${row.id}"" style="font-size:20px;"> ${row.product_name}</h5>`
								            }  
								        },
							            {

							            	"render":
							                function(data,type,row)
								            {	
								      
								            				let price=(parseInt(row.product_price)).toLocaleString('en-PH', {
																				 currency: 'PHP', style: 'currency'
																				});
								            	return ` <div id="priceColumn${row.id}"><h5>${price}</h5></div>`
								            }  
								        },
							           	{ 
							              "orderable":      false,
							              "render": 
								            function(data,type,row)
									            {
									      
									            	return `
									            		<div class="text-center py-4">
									            			
															<input type="checkbox"   name="deleted[]" value="${row.id}" id="del${row.id}"> 
														</div>					            					
									            		`;
									            } 
							            }
							        ],
							        "order": [[1, 'asc']]
							    });

							  
							    $('#example tbody').on('click', 'td.details-control', function () 
							    {
							        var tr = $(this).closest('tr');
							        var row = table.row( tr );
										var dataId=row.data();
							   
					

							        if ( row.child.isShown() ) 
							        {
							            // This row is already open - close it
							            if ($(`#col4${dataId.id}`).val()!=null) 
							            {
							            	$(`#productColumn${dataId.id}`).text(" "+$(`#truename${dataId.id}`).val());
							            	$(`#priceColumn${dataId.id}`).text(" "+$(`#trueamount${dataId.id}`).val());
							            }

							            row.child.hide();
							            tr.removeClass('shown');
							        }
							        else 
							        {	
											
								      row.child( format(row.data())).show();
								      tr.addClass('shown');
								       if ($(`#check${dataId.id}`).val()==dataId.id) 
							           {	
							           		$(`#productColumn${dataId.id}`).text(" "+$(`#pro${dataId.id}`).val());
							            	$(`#priceColumn${dataId.id}`).text(" "+$(`#pri${dataId.id}`).val());
							            	$(`#moreInfo1${dataId.id}`).text($(`#desc${dataId.id}`).val());
											$(`#moreInfo2${dataId.id}`).html(`<img src="../pimage/${$(`#img1${dataId.id}`).val()}" width="300px" style="border-raduis:10px;">`);
											$(`#moreInfo3${dataId.id}`).html(`<img src="../pimage/${$(`#img2${dataId.id}`).val()}" width="300px" style="border-raduis:10px;">`);
											$(`#submitBtn${dataId.id}`).html('');
											$(`#submitBtn${dataId.id}`).html(`<button type="button" class="btn-primary btn" onclick="edit(${dataId.id},'${$(`#pro${dataId.id}`).val()}','${$(`#pri${dataId.id}`).val()}','${$(`#desc${dataId.id}`).val()}','${$(`#img1${dataId.id}`).val()}','${$(`#img2${dataId.id}`).val()}')"><i class="fa fa-edit"></i> Edit</button>`);
							           }
									}
							        		
							    });
 
                    }
                });
 		     $(`form`).submit(function(event)
			 {
			
			   		 $(`#showproduct`).hide();
			   		 $(`#addproduct`).hide();
			   		 $(`#toshowadd`).hide();
		 		     $('body').append(`
 								        	<div class="text-center" style="padding:65px;">
											  <div class="spinner-border" style="padding:120px; width: 5rem; height: 5rem;" role="status">
												  <span class="sr-only">Loading...</span>
												</div>
											</div>
 								        	`);
					
			   
					
			   
			 }); 

   

 

} );


