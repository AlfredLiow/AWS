<?php

include_once "config.php";

   
    $prod_id=$_POST['record'];
    //echo $order_id;
    $sql = "SELECT prod_status from products where product_id='$prod_id'"; 
    $result=$con-> query($sql);
  //  echo $result;

    $row=$result-> fetch_assoc();
    
   // echo $row["pay_status"];
    if($row["prod_status"]==0){
         $update = mysqli_query($con,"UPDATE products SET prod_status=1 where product_id='$prod_id'");
    }
    else if($row["prod_status"]==1){
         $update = mysqli_query($con,"UPDATE products SET prod_status=0 where product_id='$prod_id'");
    }
    
        
 
    // if($update){
    //     echo"success";
    // }
    // else{
    //     echo"error";
    // }
    
?>