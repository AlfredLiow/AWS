<?php include("config.php");

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

?>

<html lang="en">
  <head>
    <title>Forget Password</title>
	 </head>

<meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300i,400,700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
 <style>
         body {
         background: url(./img/fp1.jpg);
         background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
         font-family: Nunito Sans;
         }
         .btn {
         width: 100%;
         color: #fff;
         padding: 10px;
         font-size: 18px;
         }
         .btn:hover {
         background-color: #2d3436;
         color: #fff;
         }
         input {
         height: 50px !important;
         }
         .form-control:focus {
         background-color:lightblue;
         box-shadow: none;
         }
         h3 {
         color: #99ddff;
         font-size: 36px;
         }
         .cw {
         width: 35%;
         }
         @media(max-width: 1200px) {
         .cw {
         width: 60%;
         }
         }
         @media(max-width: 768px) {
         .cw {
         width: 80%;
         }
         }
         @media(max-width: 492px) {
         .cw {
         width: 90%;
         }
         }
      </style>

<body>
<div class="container d-flex justify-content-center align-items-center vh-100">
         <div class="bg-white text-center p-5 mt-3 center">
		
        <h3><b>Forget Password</b></h3>
		<form class="pb-3" method="post" name="mail" enctype="multipart/form-data">
      </br>
										<div class="form-group">
											<input type="text" id="email" name="email" class="form-control" placeholder="Enter Your Email Address" required>
										</div>
								
                                                            </br>
					
						
									
						  <button id="submitbtn" name="submitbtn" class="btn btn-lg btn-primary btn-block text-uppercase signup" type="submit"> Send</button>
					
						

				</form>
				<a href="login.php"><button class="btn btn-lg btn-primary btn-block text-uppercase signup"><span>Back</span></button></a>
		 </div>
      </div>
</div>
</body>
   
   <?php
		
	if(isset($_POST["submitbtn"]))
	{
		$email = $_POST["email"];
		
		//$_SESSION['useremail'] = $email;
		
		$qrySel = "SELECT * from admin_info where email= '$email' ";
		$result = mysqli_query($con,$qrySel);
	
		
		if (mysqli_num_rows($result)!= 0)
		{
         $token = md5($email).rand(10,9999);
         
        
        
           $expDate = date("Y-m-d H:i:s", strtotime("+1 day"));

         $password = "";

         //$_SESSION['password'] = $password;

       $update = mysqli_query($con,"UPDATE admin_info SET  `password`='" . $password . "', reset_link_token='" . $token . "' ,exp_date='" . $expDate . "' WHERE email='" . $email . "'");
        
         $con = "<a href='localhost/Final/new_admin/resetpassword.php?key=".$email."&token=".$token."'>Click To Reset password</a>";
			
         //Load Composer's autoloader
         require 'vendor/autoload.php';
      
         $mail = new PHPMailer(true);
      
         $mail->CharSet =  "utf-8";
         $mail->IsSMTP();
         // enable SMTP authentication
         $mail->SMTPAuth = true;                  
         // GMAIL username
         $mail->Username = "fongzhiliow@gmail.com";
         // GMAIL password
         $mail->Password = 'rjshsrbknsnmhnlk';
         $mail->SMTPSecure = "ssl";  
         // sets GMAIL as the SMTP server
         $mail->Host = "smtp.gmail.com";
         // set the SMTP port for the GMAIL server
         $mail->Port = "465";
         $mail->From='fongzhiliow@gmail.com';
         $mail->FromName='The Core';
         $mail->AddAddress($email);
         $mail->Subject  =  'Reset Password';
         $mail->IsHTML(true);
         $mail->Body    = 'You may click on this link to reset password '.$con.'';
         if($mail->Send())
         {
            ?>
			<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>		
			<script type="text/javascript">
				   swal({
					   title: "Successful!",
					   text:"You can check your email to reset password.",
					   icon:"success"
					   });
			</script>
			<?php
         }
         else
         {
            ?> 
					<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
					<script type="text/javascript">
					swal({title: "Please Register",
						  text : "Your Account is not valid!",
						  icon: "error",
						  button: "Retry"}).then(function(){window.location.href = "admin_forgetpassword.php";});
					  </script>
			<?php
            echo "Mail Error - >".$mail->ErrorInfo;
         }
         }
		}
	?>