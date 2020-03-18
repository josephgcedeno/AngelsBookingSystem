
let able=false;
function edit(id,username,password,que1,que2,que3,ans1,ans2,ans3)
{


	if(askpassword($(`input[name=passwordthatholds]`).val()) || able)
	{
			$(document).ready(function()
			{
					
			
				$(`#usernameColumn${id}`).html(`
					<input type="hidden" id="trueusername${id}"  value="${username}">
					<center>
					<label><span>Username</span></label>
					<input type="text" id="col4${id}" name="col4" class="form-control" value="${username}">
					</center>
				`);
				/*edit product price*/

				$(`#passwordColumn${id}`).html(`
					<input type="hidden" id="truepassword${id}"  value="${password}">
					<center>
					<label><span>Password</span></label>
					<input type="password" id="col5${id}" name="col5" class="form-control" value="${password}"><br>
					<label><span>Confirm Password</span></label>
					<input type="password" id="col6${id}" name="col6" class="form-control" value="${password}"><br>
					<button type="button" class="btn-outline-primary btn" onclick="togglePass2(${id})"><i class="fa fa-eye pull-right"></I> Show password</button>
					</center>
				`);

				$(`#togglePassowrd${id}`).hide();

/*
				
				$(`#togglePassowrd${id}`).attr('onClick', `togglePass2(${id})`);
*/		$(`#moreInfoQuestion1${id}`).html( `
			<select type="option" class="custom-select control-form" name="ques1${id}" id="ques1${id}"> 
		         <option value="0" selected>${que1}</option>
		         <option value="1">What is your oldest siblings middle name?</option>
		         <option value="2">What school did you attend for sixth grade?</option>
		         <option value="3">What is your oldest cousins first and last name?</option>
		         <option value="4">What was the name of your first stuffed animal?</option>
		    </select>`);
		$(`#moreInfoQuestion2${id}`).html(` 
			<select type="option" class="custom-select control-form" name="ques2${id}" id="ques2${id}">
		         <option value="0" selected>${que2}</option>
		         <option value="1">What was your dream job as a child?</option>
		         <option value="2">What is the street number of the house you grew up in?</option>
		         <option value="3">Who was your childhood hero?</option>
		         <option value="4">What was the first concert you attended?</option>
		    </select>`);

		$(`#moreInfoQuestion3${id}`).html(`
			<select type="option" class="custom-select control-form" name="ques3${id}" id="ques3${id}">
				 <option value="0" selected>${que3}</option>
				 <option value="1">What was your dream job as a child?</option>
				 <option value="2">What is the street number of the house you grew up in?</option>
				 <option value="3">Who was your childhood hero?</option>
				 <option value="4">What was the first concert you attended?</option>                       
		    </select>`);


					$(`#moreInfo1${id}`).html(`
						<input class="form-control" id="col1${id}"  name="col1" value="${ans1}">`);

					$(`#moreInfo2${id}`).html(`
			            <input class="form-control" id="col2${id}"  name="col2" value="${ans2}">
					`);
					$(`#moreInfo3${id}`).html(`
			            <input class="form-control" id="col3${id}"  name="col3${id}" value="${ans3}">
					`);
					
			
			$(`#col6${id}`).on('input',()=>
			{

				if ($(`#col5${id}`).val()==$(`#col6${id}`).val()) 
				{
						 $(`#col5${id}`).removeAttr("style");
              			 $(`#col6${id}`).removeAttr("style");

				}
				else
				{	
						$(`#col5${id}`).css({"border":"1px solid red","border-radius":"5px","outline-color": "red"});
						$(`#col6${id}`).css({"border":"1px solid red","border-radius":"5px","outline-color": "red"});
				}
			});
				
			$(`#col5${id}`).on('input',()=>
			{

				if ($(`#col5${id}`).val()==$(`#col6${id}`).val()) 
				{
						 $(`#col5${id}`).removeAttr("style");
              			 $(`#col6${id}`).removeAttr("style");

				}
				else
				{	
						$(`#col5${id}`).css({"border":"1px solid red","border-radius":"5px","outline-color": "red"});
						$(`#col6${id}`).css({"border":"1px solid red","border-radius":"5px","outline-color": "red"});
				}
			});

				
								
		    $(`#submitBtn${id}`).html('');

			$(`#submitBtn${id}`).html(`
			<button type="button" class="btn-primary btn" onclick="submitUpdates(${id})"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button>
			<button type="button" class="btn-danger btn" onclick="cancelEdit(${id},'${username}','${password}','${que1}','${que2}','${que3}','${ans1}','${ans2}','${ans3}')"><i class="fa fa-close" aria-hidden="true"></i> Cancel</button>
			`);
					

			});
	}

}

function togglePass2(id)
{

	if ($(`#col5${id}`).attr('type')=='password') 
	{
		document.getElementById(`col5${id}`).type='text';
		document.getElementById(`col6${id}`).type='text';

		/*$(`#`).attr('type')='text';*/
	}
	else
	{	
		document.getElementById(`col5${id}`).type='password';
		document.getElementById(`col6${id}`).type='password';
	
	}
}

function submitUpdates(id)
{
	$(document).ready(function()
	{
		
						var newValForCol1=$(`#col1${id}`).val();
						var newValForCol2=$(`#inputGroupFile1ff${id}`).val();
						var newValForCol3=$(`#inputGroupFile2ff${id}`).val();
				
					



						var fd = new FormData();
						fd.append(`updateacc`,'set');
						fd.append(`origName`,$(`#usernameColumn${id}`).text())
						fd.append(`usernamethatholds`,$(`input[name=usernamethatholds]`).val());
						fd.append(`usernameToUpdate`,$(`#col4${id}`).val());
						fd.append(`passwordToUpdate`,$(`#col5${id}`).val());
						fd.append(`ques1ToUpdate`,$(`#ques1${id} option:selected`).text());
						fd.append(`ques2ToUpdate`,$(`#ques2${id} option:selected`).text());
						fd.append(`ques3ToUpdate`,$(`#ques3${id} option:selected`).text());
						fd.append(`ans1ToUpdate`,$(`#col1${id}`).val());
						fd.append(`ans2ToUpdate`,$(`#col2${id}`).val());
						fd.append(`ans3ToUpdate`,$(`#col3${id}`).val());
				        fd.append(`id`,id);


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

										if (disect[1]=='alreadyexist!' || $(`#col5${id}`).val()!=$(`#col6${id}`).val()) 
										{
												
												if ($(`#col5${id}`).val()!=$(`#col6${id}`).val()) 
												{
													$(`#modalForUpdatePrompt`).html(`

													 <div class="alert1 alert-danger" role="alert1">
											            <span class="close">&times;</span>
											            <strong>Password did not match!</strong>
											        
											            </div>
													`);
												}
												else
												{
													$(`#modalForUpdatePrompt`).html(`

													 <div class="alert1 alert-danger" role="alert1">
											            <span class="close">&times;</span>
											            <strong>Username already Exist!</strong>
											        
											            </div>
													`);
												}
												
										}
										else
										{



					
											$(`#username${id}`).val($(`#col4${id}`).val());
											$(`#password${id}`).val($(`#col5${id}`).val());
											$(`#question1s${id}`).val($(`#ques1${id} option:selected`).text());
											$(`#question2s${id}`).val($(`#ques2${id} option:selected`).text());
											$(`#question3s${id}`).val($(`#ques3${id} option:selected`).text());
											$(`#answer1s${id}`).val($(`#col1${id}`).val());
											$(`#answer2s${id}`).val($(`#col2${id}`).val());
											$(`#answer3s${id}`).val($(`#col3${id}`).val());
											$(`#check${id}`).val(id);
											$(`#trueusername${id}`).val($(`#col4${id}`).val());
											$(`#truepassword${id}`).val($(`#col5${id}`).val());
											$(`#submitBtn${id}`).html(``);
											$(`#submitBtn${id}`).html(`
											<button type="button" class="btn-primary btn" onclick="submitUpdates(${id})"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button>
										    <button type="button" class="btn-danger btn" onclick="cancelEdit(${id},'${$(`#col4${id}`).val()}','${$(`#col5${id}`).val()}','${$(`#ques1${id} option:selected`).text()}','${$(`#ques2${id} option:selected`).text()}','${$(`#ques3${id} option:selected`).text()}','${$(`#col1${id}`).val()}','${$(`#col2${id}`).val()}','${$(`#col3${id}`).val()}')"><i class="fa fa-close" aria-hidden="true"></i> Cancel</button>
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


function cancelEdit(id,username,password,que1,que2,que3,ans1,ans2,ans3)
{


	
		$(document).ready(function()
		{

			$(`#togglePassowrd${id}`).show();

			$(`#usernameColumn${id}`).text(` ${username}`);
			$(`#passwordColumn${id}`).text("*******");
			$(`#moreInfoQuestion1${id}`).text(que1);
			$(`#moreInfoQuestion2${id}`).text(que2);
			$(`#moreInfoQuestion3${id}`).text(que3);
			$(`#moreInfo1${id}`).text(ans1);
			$(`#moreInfo2${id}`).text(ans2);
			$(`#moreInfo3${id}`).text(ans3);
			$(`#submitBtn${id}`).html('');
			$(`#submitBtn${id}`).html(`<button type="button" class="btn-primary btn" onclick="edit(${id},'${username}','${password}','${que1}','${que2}','${que3}','${ans1}','${ans2}','${ans3}')"><i class="fa fa-edit"></i> Edit</button>`);
			$(`#togglePassowrd${id}`).removeAttr('onclick');
			$(`#togglePassowrd${id}`).attr('onClick', `togglePassowrd('${password}',${id})`);
	  	
		});

}

function togglePassowrd(password,id)
{
	
	if (askpassword($(`input[name=passwordthatholds]`).val()) || able) 
	{
		$(document).ready(()=>
		{

				let defaultDisplay=$(`#passwordColumn${id}`).text();
				let defaultResult='';
				let dummy='';
				for(var i=0;i<defaultDisplay.length;i++)
				{
					if (defaultDisplay[i]=='*') 
					{
						defaultResult+='*';
					}

					dummy+='*';
				}
				if (defaultResult==dummy) 
				{   
					
					$(`#passwordColumn${id}`).text(password);

				}
				else
				{
				
					
					$(`#passwordColumn${id}`).text(dummy);
				}

		});
	}
	
		
}



function format (d) {
    
	    return `
	    <table cellpadding="5" class="table-bordered table-striped" cellspacing="0" border="0"  width="100%">
	       
	         <thead>
		        <tr>
		            <th colspan="4"><center>Questions & Answers</center></th>
		        </tr>


	        </thead>
	        <tbody>
	        	<tr>
	        		<th id="moreInfoQuestion1${d.id}"><i>${d.pm_account_q1}</i></th>
		            <th id="moreInfoQuestion2${d.id}"><i>${d.pm_account_q2} </i></th>
		            <th id="moreInfoQuestion3${d.id}" colspan="2"><i>${d.pm_account_q3}</i></th>
		       	   
	        	</tr>
		        <tr>
		              <td id="moreInfo1${d.id}" style="font-style:italic;">"${d.pm_account_a1}"</td>
		              <td id="moreInfo2${d.id}" style="font-style:italic;">"${d.pm_account_a2}"</td>
		              <td id="moreInfo3${d.id}"style="font-style:italic;">"${d.pm_account_a3}"</td>
		             
		         </tr>
		         <tr>
		         	<th colspan="4">
			         	<center id="submitBtn${d.id}">
			             	 <button type="button" class="btn-outline-primary btn" onclick="edit(${d.id},'${d.username}','${d.password}','${d.pm_account_q1}','${d.pm_account_q2}','${d.pm_account_q3}','${d.pm_account_a1}','${d.pm_account_a2}','${d.pm_account_a3}')"><i class="fa fa-edit"></i> Edit</button>
			             </center> 
		             </th>
		         </tr>
		     </tbody>
	    </table>`;
        
}



 
$(document).ready(function() {
				 $.ajax({
                    url: "process/jsonConverter.php",
                    type: "POST",
                    data: 
                    {
                     sql: ` 
                     SELECT
					 c.id,c.username,c.password, b.pm_account_q1,b.pm_account_q2,b.pm_account_q3,
					 b.pm_account_a1,b.pm_account_a2,b.pm_account_a3
					 FROM  pm_account c
					 INNER JOIN pm_account_qna b 
					 ON c.id=b.pm_account_id
					 WHERE c.type='admin'
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
					                return `<input type="hidden" id="username${row.id}">
									 		<input type="hidden" id="password${row.id}">
									 		<input type="hidden" id="question1s${row.id}">
									 		<input type="hidden" id="question2s${row.id}">
									 		<input type="hidden" id="question3s${row.id}">
					                		<input type="hidden" id="answer1s${row.id}">
									 		<input type="hidden" id="answer2s${row.id}">
									 		<input type="hidden" id="answer3s${row.id}">
									 		<input type="hidden" id="check${row.id}">`;
					           		}
					            },
					            {

					            	"render":
					                function(data,type,row)
						            {
		      
						            	return `

						            	<h5 id="usernameColumn${row.id}" style="font-size:20px;"> ${row.username}</h5>`
						            }  
						        },
					            {
					            	"orderable":   false,
					            	"render":
					                function(data,type,row)
						            {
						
						            	return `
						            			<i id="passwordColumn${row.id}" style="font-size: 20px;">*******</i>
						            			<i class="fa fa-eye pull-right" id="togglePassowrd${row.id}" style="cursor:pointer" onclick="togglePassowrd('${row.password}',${row.id})"></i>`;
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
									$(`#togglePassowrd${dataId.id}`).show();
					            	$(`#usernameColumn${dataId.id}`).text(" "+$(`#trueusername${dataId.id}`).val());
					            	$(`#passwordColumn${dataId.id}`).text("*******");
									$(`#togglePassowrd${dataId.id}`).attr('onClick', `togglePassowrd('${dataId.password}',${dataId.id})`);
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
					           		$(`#productColumn${dataId.id}`).text(" "+$(`#username${dataId.id}`).val());
					            	$(`#passwordColumn${dataId.id}`).text(" "+$(`#password${dataId.id}`).val());
					            	$(`#moreInfoQuestion1${dataId.id}`).text($(`#question1s${dataId.id}`).val());
					            	$(`#moreInfoQuestion2${dataId.id}`).text($(`#question2s${dataId.id}`).val());
									$(`#moreInfoQuestion3${dataId.id}`).text($(`#question3s${dataId.id}`).val());
					            	$(`#moreInfo1${dataId.id}`).text($(`#answer1s${dataId.id}`).val());
					            	$(`#moreInfo2${dataId.id}`).text($(`#answer2s${dataId.id}`).val());
									$(`#moreInfo3${dataId.id}`).text($(`#answer3s${dataId.id}`).val());
									$(`#submitBtn${dataId.id}`).html('');
									$(`#submitBtn${dataId.id}`).html(`
										<button type="button" class="btn-primary btn" onclick="edit(${dataId.id},'${$(`#username${dataId.id}`).val()}','${$(`#password${dataId.id}`).val()}','${$(`#question1s${dataId.id}`).val()}','${$(`#question2s${dataId.id}`).val()}','${$(`#question3s${dataId.id}`).val()}','${$(`#answer1s${dataId.id}`).val()}','${$(`#answer2s${dataId.id}`).val()}','${$(`#answer3s${dataId.id}`).val()}')"><i class="fa fa-edit"></i> Edit</button>
										`);

					           }
							}
					        		
					        	
					    });


                    }
                });

		 $(`form`).submit(function(event)
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
				
		   
				
		   
		 }); 

   

 

} );


