<?php include("config.php");

session_start();

$password_err  = $confirm_password_err = $secu_err="" ;



    ?>
<style>
body{
	background:url(./img/fp3.jpg);
	background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
         font-family: Nunito Sans;
}
.wrapper{
	color:white;
  margin: auto;
  width: 60%;
  background-color:rgb(0,0,0,0.7);
  padding: 10px;
  margin-top:150px;
 
}
.btn{
	background:#4caf50;
	margin-top:5%;
	margin-left:37%;
}
.btn:hover{
	background:#3e8e34;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: #90EE90;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}

/* The message box is shown when the user clicks on the password field */
#message {
	
  display:none;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 10px 35px;
  font-size: 18px;
}

span{

font-size:20px;
}
</style>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <?php
                if (isset($_GET['key']) && isset($_GET['token'])) {
                    $email = $_GET['key'];
                    $token = $_GET['token'];
                    $query = mysqli_query($con,
                        "SELECT * FROM `user_info` WHERE `reset_link_token`='".$token."' and `email`='".$email."';"
                    );
                   
                ?>
        <form action="resetpassword.php" method="post">
        <input type="hidden" name="email" value="<?php echo $email;?>">
        <input type="hidden" name="reset_link_token" value="<?php echo $token;?>">
        <label>New Password</label>
				<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <input id="myInput" type="password" name="password" class="form-control"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
				<br>
				<input type="checkbox" onclick="myFunction()">Show Password			
				<span class="help-block" style="color:red"><?php echo $password_err; ?></span>
				</div>
				
				
			 <div id="message">
				  <h3 style="color:white;text-align:center;">Password must contain the following:</h3>
				  <p id="letter" class="invalid">A lowercase letter</p>
				  <p id="capital" class="invalid">A capital (uppercase) letter</p>
				  <p id="number" class="invalid">A number</p>
				  <p id="length" class="invalid">Minimum 8 characters</p>
				</div>
				<br>
        <br>
        <label>Confirm Password</label>
				<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
        <input id="myinput" type="password" name="confirm_password" class="form-control">
				<br>
        <input type="checkbox" onclick="myfunction()">Show Password
				<br>
        <br>
				<span class="help-block" style="color:red"><?php echo $confirm_password_err; ?></span>	
				</div>
				<br>
	           
            <div class="form-group">
               <button id="submitbtn" name="submitbtn" class="btn" type="submit"><i class="fa fa-check"></i> Submit</button>
            </div>
        </form>
        <?php
                        }
                    
        ?>
    </div>    

<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

var myInput = document.getElementById("myInput");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}

</script>
   

</body>
</html>

 <?php


if(isset($_POST["submitbtn"]))
{
  $emailId = $_POST['email'];
  $token = $_POST['reset_link_token'];
  $pass1 = mysqli_real_escape_string($con, $_POST["password"]);
  $password = $pass1;
	$np = $_POST["password"];
  $cp = $_POST["confirm_password"];
  $query = mysqli_query($con,"SELECT * FROM `admin_info` WHERE `password`='$pass1'");
  $row = mysqli_num_rows($query);
  if($row){
  mysqli_query($con,"UPDATE admin_info SET  `password`='$np' WHERE email='$emailId'");
  }

	 if(empty($password_err) && empty($confirm_password_err) ){
			
    if (!empty($np) && !empty($cp) && $np === $cp) {
                  $query = mysqli_query($con,"SELECT * FROM `admin_info` WHERE `reset_link_token`='".$token."' and `email`='".$emailId."'");
                  $row = mysqli_num_rows($query);
                  if($row){
									mysqli_query($con,"UPDATE admin_info SET  `password`='" . $np . "', reset_link_token='" . NULL . "' ,exp_date='" . NULL . "' WHERE email='" . $emailId . "'");
									?>
									<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
									<script type="text/javascript">
									swal({title: "Successful !",
										  text : "You Password Has Been Update Please Relogin!",
										  icon: "success",
										  button: "Relogin"}).then(function(){window.location.href = "login.php";});
									</script>
									<?php
                  }
                }
                  
							}

else{
}
}
?>

