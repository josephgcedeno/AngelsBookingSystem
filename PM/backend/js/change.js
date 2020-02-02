
    $(document).ready(function()
    { 
      

      // this will get the radio button value on change
      $('input[type=radio][name=tabs]').change(function()
      { 


        if (this.value=='open') 
        {    
                   $(`#content1`).html('');
                   $(`#content2`).html('');
                   $(`#content3`).html('');
                   $(`#content4`).html(``);
          req= $.ajax(
          {   
              type:'POST',
              url:'process/changetablecontent.php',
              data :
              {
                client_status:"open"
              }, 
              success : function(response)
              {
                   $(`#content1`).html(`

                          <script type="text/javascript" src="js/tableQueries.js"></script>       
                                <form method="POST" action="process/tableRequest.php">
                                <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client Name</th>
                                        <th>Contact Details</th>
                                        <th>Ordered in - Expected on</th>
                                        <th>Orders</th>
                                        <th>Open Booking</th>
                                       
                                    </tr>
                                </thead>
                                <tfoot>
                            <tr>
                                  <th>ID</th>
                                  <th>Client Name</th>
                                  <th>Contact Details</th>
                                  <th>Ordered in - Expected on</th>
                                  <th>Orders</th>
                                  <th>Open Booking</th>
                              
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
                      </div>  
                   `);
                    $(`#content1`).hide();
                    $(`#content1`).fadeIn("slow");



              }
          });
    
        
        }
        else if (this.value=='confirm') 
        {
            $(`#content1`).html(``);
            $(`#content2`).html(``);
            $(`#content3`).html(``);
            $(`#content4`).html(``);
          req= $.ajax(
          {   
              type:'POST',
              url:'process/changetablecontent.php',
              data :
              {
                client_status:"confirm"
              }, 
              success : function(response)
              {
                   
                   $(`#content2`).html(`
                          <script type="text/javascript" src="js/tableQueries.js"></script>       
                <form method="POST" action="process/tableRequest.php">
                                <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client Name</th>
                                        <th>Contact Details</th>
                                        <th>Ordered in - Expected on</th>
                                        <th>Orders</th>
                                        <th>Open Booking</th>
                                    </tr>
                                </thead>
                                <tfoot>
                            <tr>
                                  <th>ID</th>
                                  <th>Client Name</th>
                                  <th>Contact Details</th>
                                  <th>Ordered in - Expected on</th>
                                  <th>Orders</th>
                                  <th>Open Booking</th>
                              
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
                      </div>  
                   `);
                    $(`#content2`).hide();
                    $(`#content2`).fadeIn("slow");

              }
          });
        }
        else if (this.value=='reject') 
        {

            $(`#content1`).html(``);
            $(`#content2`).html(``);
            $(`#content3`).html(``);
            $(`#content4`).html(``);
          req= $.ajax(
          {   
              type:'POST',
              url:'process/changetablecontent.php',
              data :
              {
                client_status:"reject"
              }, 
              success : function(response)
              {
                   
                   $(`#content3`).html(`
                <form method="POST" action="process/tableRequest.php">
                                <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client Name</th>
                                        <th>Contact Details</th>
                                        <th>Ordered in - Expected on</th>
                                        <th>Orders</th>
                                        <th>Open Booking</th>
                                    </tr>
                                </thead>
                                <tfoot>
                            <tr>
                                  <th>ID</th>
                                  <th>Client Name</th>
                                  <th>Contact Details</th>
                                  <th>Ordered in - Expected on</th>
                                  <th>Orders</th>
                                  <th>Open Booking</th>
                              
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
                      </div>  
                <script type="text/javascript" src="js/tableQueries.js"></script>       

                   `);
                    $(`#content3`).hide();
                    $(`#content3`).fadeIn("slow");

              }
          });
        }
        else if (this.value=='done') 
        {

            $(`#content1`).html(``);
            $(`#content2`).html(``);
            $(`#content3`).html(``);
            $(`#content4`).html(``);
          req= $.ajax(
          {   
              type:'POST',
              url:'process/changetablecontent.php',
              data :
              {
                client_status:"done"
              }, 
              success : function(response)
              {
                   
                   $(`#content4`).html(`
                <form method="POST" action="process/tableRequest.php">
                                <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client Name</th>
                                        <th>Contact Details</th>
                                        <th>Ordered in - Expected on</th>
                                        <th>Orders</th>
                                        <th>Open Booking</th>
                                    </tr>
                                </thead>
                                <tfoot>
                            <tr>
                                  <th>ID</th>
                                  <th>Client Name</th>
                                  <th>Contact Details</th>
                                  <th>Ordered in - Expected on</th>
                                  <th>Orders</th>
                                  <th>Open Booking</th>
                              
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
                      </div>  
                <script type="text/javascript" src="js/tableQueries.js"></script>       
                      
                   `);
                    $(`#content4`).hide();
                    $(`#content4`).fadeIn("slow");
                   /*<span class="close">Close</span> close icon*/ 

              }
          });
        }
           

      });


    });