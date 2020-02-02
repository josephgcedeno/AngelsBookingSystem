<?php
    
        require_once('../run.php');
        session_start();
       
   
        if (!isset($_POST['sendItems'])) 
        {
          header('location: list.php');
        }

        if (isset($_POST['sendItems'])) 
        {
          $productIds=$_POST['idProduct'];
          $productQuan=$_POST['quanProduct'];
          $proComment=$_POST['proComment'];
          $args = dissectAndGroupIntoIdNQuantity($productIds,$productQuan);
          $_SESSION['comment']=dissectAndGroupIntoIdNComment($productIds,$proComment);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Payment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="css/payment.css">
</head>
<body>
  <main class="page payment-page">
    <section class="payment-form dark">
      <div class="container">
        <form method="POST" action="process/insertClientData.php">
          <div class="products">
                <h3 class="title">Checkout</h3>
<?php 


    $productTotal=0;
    $counter=0; //this will count how many product bought for jQuery purposes 
    foreach ($args as $row) //accessing multi dimension array
    { 
        $resultsToDisect=explode('$gf@', $gfdb->getResultProductNameNProductTotalPrice('pm_product',$row['id'],$row['quantity']));
 
         echo' <div class="item" id="items'.$counter.'">
                  <input type="hidden" name="quantityFromBoughted[]" value="'.$row['quantity'].'">
                  <input type="hidden" name="idFromBoughted[]" value="'.$row['id'].'">
                  <span class="price">$'.moneyFormater($resultsToDisect[1]) .'</span>
                  <p class="item-name">'.$resultsToDisect[0].'</p>
                  <p class="item-description">'.$resultsToDisect[2].'</p>
                  <p class="item-description">Price:'.$resultsToDisect[3].' </p>
                  <p class="item-description">Qty:'.$row['quantity'].' </p>
                </div>';
        $productTotal+=$resultsToDisect[1];      
        $counter++;
    }
 

        echo'

         <div class="total">Total<span class="price">$'.moneyFormater($productTotal).'</span></div>
          <input type="hidden" name="totalPriceToPay" value="'.$productTotal.'">
          <input type="hidden" value="'.$counter.'" id="countcontent">
          </div>';
  } ?> <center><a href="#" id="show" >See all</a></center> 
          <hr>

          <div class="card-details">
            <h3 class="title">Payment Details</h3>
            <div class="row">
              
              <div class="form-group col-sm-7">
                <label for="card-holder">Full Name</label>
                <input id="card-holder" type="text" class="form-control" placeholder="Full Name" aria-label="Full Name" aria-describedby="basic-addon1" name="fullName">
              </div>
              <div class="form-group col-sm-5">
                <label for="">Facebook Name</label>
                <input id="card-holder" type="text" class="form-control" placeholder="Facebook Name" aria-label="Facebook Name" aria-describedby="basic-addon1" name="fbacc">
              </div>
              <div class="form-group col-sm-12">
                <label for="card-number">Email</label>
                <input id="card-number" type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" name="emailadd">
              </div>
              <div class="form-group col-sm-6">
                <label for="cvc">Phone Number</label>
                <input id="cvc" type="text" class="form-control" placeholder="Phone Number" aria-label="Phone Number" aria-describedby="basic-addon1" name="phonenumber">
              </div>
                
                <div class="form-group col-sm-6">
                <label for="cvc">Book Date</label>
              <input id="cvc" type="date" class="form-control" name="date1" value="<?php echo  date('Y-m-d'); ?>"  min="<?php echo  date('Y-m-d'); ?>" >
              </div>

              <div class="form-group col-sm-12">
                <button type="submit" class="btn btn-primary btn-block" onclick="confirm('Do you really want to proceed? ')" name="buyproduct">Proceed</button>
              </div>
            </div>
          </div>
         </form>
      </div>
    </section>
  </main>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

<script type="text/javascript">
  
  $(document).ready(function()
  {     

      $('#show').hide();
      var contents=$('#countcontent').val();
      if (contents>3) 
      {
        $('#show').show();

        for(var i=contents;i>2;i--)
        {
            $(`#items${i}`).hide();
        }

  

        $('#show').on('click',function()
        {
            if ($('#show').text()=='hide') 
            { 
                $('#show').text('show all');
                for(var i=contents;i>2;i--)
                {

                    $(`#items${i}`).hide("slow");
                }
            }
            else
            {
                $('#show').text('hide')
                 for(var i=0;i<contents;i++)
                 {
                      $(`#items${i}`).show("slow");
                 }
            }
        });
        

      }   


   

  });

</script>