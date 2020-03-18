
$(document).ready(function()
{ 

  
  $(document).on('click','input[type="file"]',function(e)
  {   

      var id=(this.id).split("inputGroupFile"); 


      $(`#${this.id}`).change(function() {
          RecurFadeIn();
          readURL(this,id[1]);

    
      });        


  });

});

function readURL(input,which) 
{

    var reader = new FileReader();
    
    var filename;
    var imageId;
    var customFileLabel;

    if (input.files && input.files[0]) 
    {   
        if (which=='02' || which =='01') 
        { 
              filename= $(`#inputGroupFile${which}`).val();
              imageId=`image${which}`;
              customFileLabel=`custom-file${which}-label`;
               filename = filename.substring(filename.lastIndexOf('\\')+1);
              reader.onload = function(e) 
              {
                $(`.${customFileLabel}`).html(``);
                $(`.${customFileLabel}`).html(`<img src="../pimage/icons/upload.png" width="20px"><br>`);             
                $(`.${customFileLabel}`).text(filename);
                $(`#${imageId}`).attr('src', e.target.result);
                $(`#${imageId}`).hide();
                $(`#${imageId}`).fadeIn(500);
              }

        }
        else
        {

              var identifier=which.split('ff');
              
              if(identifier[0]==1)
              {
                  filename= $(`#inputGroupFile1ff${identifier[1]}`).val();
                  imageId=`imageone${identifier[1]}`;
                  customFileLabel=`custom-file1${identifier[1]}-label`;
                   filename = filename.substring(filename.lastIndexOf('\\')+1);
                  reader.onload = function(e) 
                  {
                    $(`.${customFileLabel}`).html(``);
                    $(`.${customFileLabel}`).html(`<img src="../pimage/icons/upload.png" width="20px"><br>`);             
                    $(`.${customFileLabel}`).text(filename);
                    $(`#${imageId}`).attr('src', e.target.result);
                    $(`#${imageId}`).hide();
                    $(`#${imageId}`).fadeIn(500);
                     $(`.${customFileLabel}`).html(`<img src="../pimage/icons/editpen.png" width="20px"><br> ${filename}`);             

                  }
              }
              else
              {
                  filename= $(`#inputGroupFile2ff${identifier[1]}`).val();
                  imageId=`imagetwo${identifier[1]}`;
                  customFileLabel=`custom-file2${identifier[1]}-label`;
                   filename = filename.substring(filename.lastIndexOf('\\')+1);
                  reader.onload = function(e) 
                  {
                    $(`.${customFileLabel}`).html(``);
                    $(`.${customFileLabel}`).html(`<img src="../pimage/icons/upload.png" width="20px"><br>`);             
                    $(`.${customFileLabel}`).text(filename);
                    $(`#${imageId}`).attr('src', e.target.result);
                    $(`#${imageId}`).hide();
                    $(`#${imageId}`).fadeIn(500);
                     $(`.${customFileLabel}`).html(`<img src="../pimage/icons/editpen.png" width="20px"><br> ${filename}`);             

                  }
              }
             

        }

      reader.readAsDataURL(input.files[0]);    
    } 
  $(".alert").removeClass("loading").hide();
}
function RecurFadeIn(){ 
  FadeInAlert("Wait for it...");  
}
function FadeInAlert(text){
  $(".alert").show();
  $(".alert").text(text).addClass("loading");  
}