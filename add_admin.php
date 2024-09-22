<?php include("config.php");

session_start();

include('includes/header.php'); 
include('includes/navbar.php'); 


$id = $_SESSION["adminid"];

 $result = mysqli_query($con,"SELECT * FROM admin_info WHERE admin_id='$id'");
 $row = mysqli_fetch_array($result);
 
 $admintype =$row['admin_type'];
 $type="SuperAdmin";
 
// Define variables and initialize with empty values
$email = $password  = $confirm_password = $username = "";
$email_err = $password_err  = $confirm_password_err = $username_err =$phonenum_err = "";
 $status="";
// Processing form data when form is submitted
if(isset($_POST["submit"])){
 
 if($admintype == $type){
    // Validate username
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT admin_id FROM admin_info WHERE email = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
	
 // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT admin_id FROM admin_info WHERE admin_name = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	
	 if(empty(trim($_POST["phonenum"]))){
        $phonenum_err = "Please enter a phone number.";     
    }else{
        $phonenum = trim($_POST["phonenum"]);
    }
	

	$status = '1';
	$type='Admin';
    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err)&&empty($phonenum_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO admin_info (admin_name, password, email, contact,admin_status,admin_type) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_password ,$param_email,$param_phone,$param_status,$param_type);
            
            // Set parameters
            $param_username = $username;
			$param_email = $email;
			$param_phone = $phonenum;
            $param_password = $password; 
            $param_status = $status;
			$param_type = $type;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
				?>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script type="text/javascript">
			swal({title: "Success Add Admin",
			text:"View new admin in admin list",
			icon: "success",
			button: "Back"}).then(function(){window.location.href = "admin_list.php";});
		</script>
				<?php
            } else{
                $status="Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
   
}else
{
	?>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script type="text/javascript">
			swal({title: "Cannot Add Admin",
			text:"You are not Super Admin",
			icon: "error",
			button: "Back"}).then(function(){window.location.href = "admin_list.php";});
		</script>
	<?php
}
}
?>
<style>
.help-block{
color:red;
}

input[type=text], input[type=password], input[type=name], input[type=phone] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
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



</style>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
 
   
  <div class="card-body">

	
    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        
        <tbody>
     
          <tr>
          
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="	margin-left:350px; margin-right:500px;">
  
    <h1>Add Admin</h1>
    <hr>
	<div class="container">

	<label for="Name"><b>Name</b></label>
	<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
    <input type="text" placeholder="Enter Name" name="username" value="<?php echo $username; ?>">
	<br>
	<span class="help-block"><?php echo $username_err; ?></span>
	</div>
    <br>
	<label for="email"><b>Email</b></label>
	<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
    <input type="text" placeholder="Enter Email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $email; ?>">
	<br>
	<span class="help-block"><?php echo $email_err; ?></span>
	</div>
	<br>
	<label for="phone"><b>Phone</b></label>
	<div class="form-group <?php echo (!empty($phonenum_err)) ? 'has-error' : ''; ?>">
    <input type="text" placeholder="Enter phone number" name="phonenum" pattern="^(\+?6?01)[0-46-9]-*[0-9]{7,8}$" title="Please enter valid phone number, exp:011-1234567" title="digit only">
	<span class="help-block"><?php echo $phonenum_err; ?></span>
	<br>
	</div>
	<br>
    <label for="psw"><b>Password</b></label>
	<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
    <input id="myInput" type="password" placeholder="Enter Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
	<input type="checkbox" onclick="myFunction()">Show Password
	<br>
    <span class="help-block"><?php echo $password_err; ?></span>
	</div>
	
	<div id="message">
	  <h3 >Password must contain the following:</h3>
	  <p id="letter" class="invalid">A lowercase letter</p>
	  <p id="capital" class="invalid">A capital (uppercase) letter</p>
	  <p id="number" class="invalid">A number</p>
	  <p id="length" class="invalid">Minimum 8 characters</p>
	</div>
	
	
	<br>
    <label for="psw-repeat"><b>Repeat Password</b></label>
	<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
    <input type="password" placeholder="Repeat Password" name="confirm password" id="myinput">
	
	 <input type="checkbox" onclick="myfunction()">Show Password
	 <br>
	<span class="help-block"><?php echo $confirm_password_err; ?></span>
</div>
<br><br><br>
	<input type="submit" class="btn btn-primary" name="submit" value="Add Admin">
</form>
             <a href="admin_list.php"><button type="button" class="btn btn-primary" >
             Back
            </button></a>
          </tr>
  
        </tbody>
      </table>

                            </div>
                     </div>
              </div>
       </div>
</div>


<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>

<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function myfunction() {
  var x = document.getElementById("myinput");
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