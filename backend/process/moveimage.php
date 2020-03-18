<?php

/* Getting file name */
$filename = $_FILES['image1']['name'];
$filename1 = $_FILES['image2']['name'];

echo $filename1;
/* Location */
$location = '../../pimage/'.$filename;
$location2 = '../../pimage/'.$filename1;

$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
$imageFileType1 = pathinfo($location2,PATHINFO_EXTENSION);

/* Valid Extensions */
$valid_extensions = array("jpg","jpeg","png");
/* Check file extension */
if( !in_array(strtolower($imageFileType),$valid_extensions) && !in_array(strtolower($imageFileType1),$valid_extensions) ) {
   $uploadOk = 0;
}

if($uploadOk == 0){

	echo 'return$gfdbJSON$Unsupported File';


}
else{
   /* Upload file */
   if(move_uploaded_file($_FILES['image1']['tmp_name'],$location))
   {

   }
   if(move_uploaded_file($_FILES['image2']['tmp_name'],$location2))
   {

   }
   if(move_uploaded_file($_FILES['image1']['tmp_name'],$location) && move_uploaded_file($_FILES['image2']['tmp_name'],$location2) ){
   
   }
}