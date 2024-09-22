<?php

include_once "config.php";

   
    $brand_id=$_POST['record'];
    //echo $order_id;
    $sql = "SELECT brand_status from brands where brand_id='$brand_id'"; 
    $result=$con-> query($sql);
  //  echo $result;

    $row=$result-> fetch_assoc();
    
   // echo $row["pay_status"];
    if($row["brand_status"]==0){
         $update = mysqli_query($con,"UPDATE brands SET brand_status=1 where brand_id='$brand_id'");
    }
    else if($row["brand_status"]==1){
         $update = mysqli_query($con,"UPDATE brands SET brand_status=0 where brand_id='$brand_id'");
    }
    
        
 
    // if($update){
    //     echo"success";
    // }
    // else{
    //     echo"error";
    // }
    
?>