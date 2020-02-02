$(document).ready(function() {


	

	var	table=$(`#example`).DataTable( {
        "ajax": "js/value.json",
        "columns": [
            {
                "render":
                function(data,type,row)
	            {
	      				return `
	            	<i class="fa fa-id-card" aria-hidden="true"> ${row.id}</i>`
	            	
	            }  
            },
            {

            	"render":
                function(data,type,row)
	            {
	            	return `<i class="fa fa-user" aria-hidden="true" style="font-size: 20px;"> ${row.client_fullname}</i>`;
	            }  
	        },
            {	
            	"orderable":      false,
            	"render":
                function(data,type,row)
	            {
						return `<i class="fa fa-facebook" aria-hidden="true"> facebook: ${row.client_fbname}</i><br><br>
						<i class="fa fa-envelope" aria-hidden="true"> email: ${row.client_email}</i><br><br>
						<i class="fa fa-phone" aria-hidden="true"> phone: ${row.client_phonenumber}</i>`;
			    }  
	        },
	        {	
            
            	"render":
                function(data,type,row)
	            {
						return `<i class="fa fa-calendar" aria-hidden="true"> ${row.client_ordered} - ${row.client_expectedD}</i>`;
			    }  
	        },
            {
            	"className":      'orders',	
            	"orderable":      false,
            	"render":
                function(data,type,row)
	            {
			            	return `
			            	<input type="button" class="btn btn-primary"  id="myBtn" value="orders">
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
	      			return `<input type="submit" class="btn btn-primary" value="confirm" name="open">
              			    <input type="submit" class="btn btn-danger" value="reject" name="reject">	`;
	      		}
	      		else if (row.client_status=='confirm') 
	      		{
	      			return `<input type="submit" class="btn btn-primary" value="Done" name="done">
              			   `;
	      		}
	      		else if (row.client_status=='reject') 
	      		{
	      			return `<input type="submit" class="btn btn-danger" onclick="confirm('Do you really want to delete this record? ')" value="Delete" name="delete">
              			    <input type="submit" class="btn btn-primary" value="Re-confirm" name="open">
              			   `;
	      		
	      		}
	      		else if (row.client_status=='done') 
	      		{
	      			return `<input type="submit" class="btn btn-danger" onclick="confirm('Do you really want to delete this record? ')" value="Delete" name="delete">
              			   `;
	      		
	      		}
              }
           
            }
        ],
        "order": [[1, 'asc']]
    } );	


	//GET THE ID OF PARTICULAR CLICK BUTTON
	$(`#example`).on('click', `td.getIdToProcess`, function () 
    {		

	        var tr = $(this).closest('tr');
	        var row = table.row( tr );
		    var dataId=row.data().id;

		    var inners=$(`td.getIdToProcess`).append(`
			    	<input type="hidden" value="${dataId}" name="clientid">`);	
							
    });
    $(`#example`).on('click', `td.open`, function () 
    {		

	        var tr = $(this).closest('tr');
	        var row = table.row( tr );
		    var dataId=row.data().id;

		    var inners=$(`td.open`).append(`
			    	<input type="hidden" value="${dataId}" name="clientid">`);	
							
    });
    $(`#example`).on('click', `td.open`, function () 
    {		

	        var tr = $(this).closest('tr');
	        var row = table.row( tr );
		    var dataId=row.data().id;

		    var inners=$(`td.open`).append(`
			    	<input type="hidden" value="${dataId}" name="clientid">`);	
							
    });


	$(`#example`).on('click',`td.orders`, function ()
	{	
		  var tr = $(this).closest('tr');
	      var row = table.row( tr );
		  var dataId=row.data().id;
		  var modal = document.getElementById("myModal");
		  var span = document.getElementsByClassName("close")[0];   
			$('.modal-body').html('');

	 $.ajax({
       url: 'js/productsNComment.json',
       dataType: 'json',
       success: function(data) 
       {
       		  var items = [];
       	 $.each(data, function(key, val) {

       	 		if (val.id==dataId) 
       	 		{	
       	 				items.push(val)
       	 		}
            //items.push('<li id="' + key + '">' + val + '</li>');    
          });
     	var peste ='';
     	var total=0;
       	for(var i=0;i<items.length;i++)
       	{	var comment=items[i]['comments'].split('=');
       		var multiply=parseInt(items[i]['quantity'])*parseInt(items[i]['product_price']);
       			 total+=multiply;
       		 peste+=`
	       		  	<tr>
	       		  		<td>${items[i]['product_name']}</td>
	       		  		<td>${items[i]['quantity']}</td>
	       		  		<td>${items[i]['product_price']}</td>
	       		  		<td>${comment[1]}</td>
	       		  		<td>P ${multiply}</td>
	       		  		
	       		  	</tr>
       		   `;
       		  
       	}
       			peste+=`<tr>
	       		  		<td></td>
	       		  		<td></td>
	       		  		<td></td>
	       		  		<td></td>
	       		  		<td>P ${total}</td>
	       		  	</tr>`;

			       	$('.modal-body').html(`
			       		<table class="table">
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
		  span.onclick = function() 
		  {
		  modal.style.display = "none";
		  }
		  window.onclick = function(event) {
		  if (event.target == modal) {
		    modal.style.display = "none";
		    }
		  }
		});



} );

	
/*// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
*/














	function updateInlineEdit(idFromRow,colSourceNDestination)
	{
		 
		 
		for(var i=0;i<colSourceNDestination.length;i++)
		{
			var result=colSourceNDestination[i].split("@");
			document.getElementById(`${result[1]}`).innerText=
			document.getElementById(`${result[0]}`).innerText;

	
			
		}
	}

