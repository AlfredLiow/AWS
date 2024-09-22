<?php
if(isset($_POST['password']) && $_POST['reset_link_token'] && $_POST['email'])
{
include "config.php";
$emailId = $_POST['email'];
$token = $_POST['reset_link_token']; $error = "";
$pass1 = mysqli_real_escape_string($con, $_POST["password"]);
$pass2 = mysqli_real_escape_string($con, $_POST["cpassword"]);
if ($pass1 != $pass2) {
    $error .= "<p>Password do not match, both password should be same.<br /><br /></p>";
}
if ($error != "") {
    echo $error;
} else{
    $password = md5($pass1);
    $query = mysqli_query($con,"SELECT * FROM `admin_info` WHERE `reset_link_token`='".$token."' and `email`='".$emailId."'");
    $row = mysqli_num_rows($query);
    if($row){
    mysqli_query($con,"UPDATE admin_info SET  `password`='" . $password . "', reset_link_token='" . NULL . "' ,exp_date='" . NULL . "' WHERE email='" . $emailId . "'");
    echo '<p>Congratulations! Your password has been updated successfully.<a href="localhost/new_admin/login.php">Back to Login</a></p>';
    }else{
    echo "<p>Something goes wrong. Please try again</p>";
    }
}

}
?>

