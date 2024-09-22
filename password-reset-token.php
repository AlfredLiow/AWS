<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include("config.php");

if(isset($_POST['password-reset-token']) && $_POST['email'])
{
		$email = $_POST["email"];
		
		//$_SESSION['useremail'] = $email;
		
		$qrySel = "SELECT * from admin_info where email= '$email' ";
		$result = mysqli_query($con,$qrySel);
	
		
		if (mysqli_num_rows($result)!= 0)
		{
         $token = md5($email).rand(10,9999);
 
         $expFormat = mktime(
         date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
         );
 
         $expDate = date("Y-m-d H:i:s",$expFormat);

         $password = "";

         //$_SESSION['password'] = $password;

       $update = mysqli_query($con,"UPDATE admin_info SET  `password`='" . $password . "', reset_link_token='" . $token . "' ,exp_date='" . $expDate . "' WHERE email='" . $email . "'");
        
         $con = "<a href='localhost/Main/new_admin/resetpassword.php?key=".$email."&token=".$token."'>Click To Reset password</a>";
			
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