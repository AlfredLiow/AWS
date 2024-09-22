<?php

include_once "config.php";

   
    $cat_id=$_POST['record'];
    //echo $order_id;
    $sql = "SELECT cat_status from categories where cat_id='$cat_id'"; 
    $result=$con-> query($sql);
  //  echo $result;

    $row=$result-> fetch_assoc();
    
   // echo $row["pay_status"];
    if($row["cat_status"]==0){
         $update = mysqli_query($con,"UPDATE categories SET cat_status=1 where cat_id='$cat_id'");
    }
    else if($row["cat_status"]==1){
         $update = mysqli_query($con,"UPDATE categories SET cat_status=0 where cat_id='$cat_id'");
    }
    
        
 
    // if($update){
    //     echo"success";
    // }
    // else{
    //     echo"error";
    // }
    
?>