<?php
    include_once "config.php";
    
    if(isset($_POST['upload']))
    {
        $product_id= $_POST['product_id'];
        $ProductName = $_POST['p_name'];
        $desc= $_POST['p_desc'];
        $price = $_POST['p_price'];
        $category = $_POST['category'];
        $brand = $_POST['brand'];
            
        $name = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
    
        $location="./product_images/";
        $image=$location.$name;

        $target_dir="../product_images/";
        $finalImage=$target_dir.$name;

        move_uploaded_file($temp,$finalImage);

         $insert = mysqli_query($conn,"INSERT INTO products
         (product_id,product_title,product_image,product_price,product_desc,product_cat,product_brand) 
         VALUES ('$product_id','$ProductName','$image',$price,'$desc','$category','$brand')");
 
         if(!$insert)
         {
             echo mysqli_error($con);
         }
         else
         {
            echo '<script>alert("Records added successfully.")';
            header("Location: viewAllProduct.php?item=success");
         }
     
    }
        
?>