<?php include("config.php");

session_start();

if (isset($_SESSION["adminid"])) {
    // Redirect to another page
    header("Location: dashboard.php");
    exit; // Make sure to exit after redirection
}
?>

<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

<link href="./disk/slidercaptcha.css" rel="stylesheet" />
	
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>

<style>
body{
  margin: 0;
  padding: 0;
  font-family: sans-serif;
  background: url(./img/fp2.jpg);
         background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
}
.box{
  width: 300px;
  padding: 40px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  background: #191919;
  text-align: center;
}
.box h1{
  color: white;
  text-transform: uppercase;
  font-weight: 500;
}
.box input[type = "text"],.box input[type = "password"]{
  border:0;
  background: none;
  display: block;
  margin: 20px auto;
  text-align: center;
  border: 2px solid #3498db;
  padding: 14px 10px;
  width: 200px;
  outline: none;
  color: white;
  border-radius: 24px;
  transition: 0.25s;
}
.box input[type = "text"]:focus,.box input[type = "password"]:focus{
  width: 280px;
  border-color: #2ecc71;
}
.box input[type = "submit"]{
  border:0;
  background: none;
  display: block;
  margin: 20px auto;
  text-align: center;
  border: 2px solid #2ecc71;
  padding: 14px 40px;
  outline: none;
  color: white;
  border-radius: 24px;
  transition: 0.25s;
  cursor: pointer;
}
.box input[type = "submit"]:hover{
  background: #2ecc71;
}

span{
color:white;
}


  
   
.slidercaptcha {

    width: 314px;
    height: 250px;
    border-radius: 4px;
     box-shadow: 0 0 20px rgba(0, 0, 0, 0.125);
      margin-top: 20px;
	  background-color:white;
        }

            .slidercaptcha .card-body {
                padding: 1rem;
            }

            .slidercaptcha canvas:first-child {
                border-radius: 2px;
                border: 2px solid #e6e8eb;
            }

            .slidercaptcha.card .card-header {
				height:30px;
                background-image: none;
                background-color: grey;
            }

            .refreshIcon {
                top: -46px;
				color:white;
            }
</style>
<html>
  <head>
    <meta charset="utf-8">
		<div class="background-color">
	<title>FYP Login Form</title>

<body>
 <form method="GET" class="box">
<div class="login-box">
    <h1>Login</h1>
    
	<div class="textbox">
        <input type="text" placeholder="Email" name="email">	
	</div>
	
	<div class="textbox">
        <input type="password" placeholder="Password" name="password">
	</div>
	
<div class="slidercaptcha card">
						<div class="card-header">
							<span>Drag To Verify</span>
						</div>
												
						<div class="card-body">
								<div id="captcha"></div>
						</div>
						<input name="capcha" id="capcha2" value="" style="display:none;" >
					</div>
					<script src="./disk/longbow.slidercaptcha.js"></script>
					<script>
					$('#captcha').sliderCaptcha({
					onSuccess:function() 
					{
						document.getElementById('capcha2').value = 1;
					}
					});

					$('#captcha').sliderCaptcha({
					width: 280,
					height: 155,
					sliderL: 42,
					sliderR: 9,
					offset: 5,
					loadingText:'Loading...',
					failedText:'Try It Again',
					barText:'Slide the Puzzle',
					repeatIcon:'fa fa-repeat',
					maxLoadCount: 3,
					localImages:function () {// uses local images instead
					return 'images/Pic' + Math.round(Math.random() * 4) +'.jpg';
					}
					});
					</script>	
	
	 
<input class="btn" type="submit" name="login-btn" value= "Login">	
</div>
 <a class="left" href="admin_forgetpassword.php" style="color:yellow;">forgot password?</a>
</form>

   </div> 
</body>
</html>

<?php
if(isset($_GET["login-btn"]))
{
	$email=$_GET["email"];
	$pass=$_GET["password"];
	$S = $_GET["capcha"];
	
	

    if($S==1)
	{
	$email=mysqli_real_escape_string($con,$email);
	$pass=mysqli_real_escape_string($con,$pass);
		
	$result=mysqli_query($con,"SELECT * from admin_info where email='$email' AND password='$pass' AND admin_status='1'");
		
	$count = mysqli_num_rows($result);
	
	if($count==1)
	{
                            
		$row = mysqli_fetch_assoc($result);
		$_SESSION["adminid"]=$row["admin_id"];
	
	
	
		?>
		
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
				<script type="text/javascript">
				swal({title: "Success Login",
					  text : "Go to customer main page",
					  icon: "success",
					  button: "Main Page"}).then(function(){window.location.href = "dashboard.php";});
				  </script>
		
		<?php
	}
	else
	{
		?>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
				<script type="text/javascript">
				swal({title: "Please Try Again",
					  text : "Invalid email or password!",
					  icon: "error",
					  button: "Retry"}).then(function(){window.location.href = "login.php";});
				  </script>
	
	<?php
	}
	}
	else{
	?>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
				<script type="text/javascript">
				swal({title: "Please Try Again",
					  text : "Please Complete The Captcha!",
					  icon: "error",
					  button: "Retry"}).then(function(){window.location.href = "login.php";});
				  </script>
				  
	<?php
	}
	

}?>

