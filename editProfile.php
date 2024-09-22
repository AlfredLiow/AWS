<?php
include("config.php");

session_start();

include('includes/header.php');
include('includes/navbar.php');
?>

<!DOCTYPE html>
<html>

<style>
    .img {
        border-style: ridge;
        border-radius: 50%;
        width: 250px;
    }

    .box {
        max-width: 1100px;
        height: 500px;

    }

    .top {
        position: relative;
        margin: auto;


    }

    .hover {
        padding: 15px;
        background: blue;
        text-decoration: none;
        margin-top: 0px;
        margin-right: -140px;
        border-radius: 2px;
        font-size: 15px;
        font-weight: 600;
        color: #fff;
        transition: 0.8s;
        transition-property: background;
    }

    .hover:hover {
        background: #25149c;
    }

    input[type=text] {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
</style>

<head>
    <title>Profile</title>
</head>

<body>
    <div class="box">
        <div class="container">
            <?php
            $id = $_GET["id"];
            $result = mysqli_query($con, "SELECT * FROM admin_info WHERE admin_id='$id'");

            if ($row = mysqli_fetch_array($result)) {
                $admin_name = $row["admin_name"];
                $email = $row["email"];
                $contact = $row["contact"];
            }
            ?>
            <div class="top">
                <div class="centerlize center">
                    <form action="" method="POST">
                        <br>
                        <label for="username">Name:</label>
                        <input type="text" name="admin_name" class="form-control" required pattern="[a-zA-Z ]+" value="<?php echo $admin_name ?>">
                        <br>
                        <br>
                        <label for="Email">Email:</label>
                        <input type="text" name="email" class="form-control" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" value="<?php echo $email ?>">
                        <br>
                        <br>
                        <label for="PhoneNum">Phone Number:</label>
                        <input type="text" name="contact" class="form-control" required pattern="[0-9]{9}" value="<?php echo $contact ?>">
                        <br>
                        <br>
                        <br>
                        <a href="admin_list.php"><button type="button" class="btn btn-primary">Back</button></a>
                        <input type="hidden" name="admin_id" value="<?php echo $id ?>">
                        <input type="submit" name="update" value="Update Admin" class="btn btn-primary">
                        <br>
                        <br>
                    </form>

                    <?php
                    if (isset($_POST['update'])) {
                        $admin_id = $_POST['admin_id'];
                        $admin_name = $_POST['admin_name'];
                        $email = $_POST['email'];
                        $contact = $_POST['contact'];

                        $name = "/^[a-zA-Z ]+$/";
                        $emailValidation = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{3,6})+$/";
                        $number = "/^[0-9]+$/";

                        $check_query = "SELECT * FROM admin_info WHERE admin_id != '$admin_id' AND (admin_name = '$admin_name' OR email = '$email' OR contact = '$contact')";
                        $check_result = mysqli_query($con, $check_query);
                        $check_row = mysqli_num_rows($check_result);

                        $isValidEmail = true;

                        if (!preg_match($emailValidation, $email)) {
                            echo "
                            <div class='alert alert-warning'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                <b>This email is not valid..!</b>
                            </div>
                            ";
                            $isValidEmail = false;
                        }

                        if ($isValidEmail) {
                            if ($check_row > 0) {
                                $existingAdmin = mysqli_fetch_array($check_result);
                                if ($existingAdmin['admin_name'] == $admin_name) {
                                    echo "
                                    <div class='alert alert-warning'>
                                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                        <b>An admin with the same name already exists.</b>
                                    </div>
                                    ";
                                }
                                if ($existingAdmin['email'] == $email) {
                                    echo "
                                    <div class='alert alert-warning'>
                                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                        <b>An admin with the same email already exists.</b>
                                    </div>
                                    ";
                                }
                                if ($existingAdmin['contact'] == $contact) {
                                    echo "
                                    <div class='alert alert-warning'>
                                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                        <b>An admin with the same contact already exists.</b>
                                    </div>
                                    ";
                                }
                            } else {
                                if (empty($admin_name) || empty($email) || empty($contact)) {
                                    echo "
                                    <div class='alert alert-warning'>
                                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill all fields..!</b>
                                    </div>
                                    ";
                                } else {
                                    if (!preg_match($name, $admin_name)) {
                                        echo "
                                        <div class='alert alert-warning'>
                                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                            <b>This name is not valid..!</b>
                                        </div>
                                        ";
                                    }
                                    if (!preg_match($number, $contact)) {
                                        echo "
                                        <div class='alert alert-warning'>
                                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                            <b>Mobile number contact is not valid</b>
                                        </div>
                                        ";
                                    }
                                    if (!(strlen($contact) == 9)) {
                                        echo "
                                        <div class='alert alert-warning'>
                                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                            <b>Mobile number must be 9 digits excluding the first digit 0</b>
                                        </div>
                                        ";
                                    }

                                    if ($admin_name == $row['admin_name'] && $email == $row['email'] && $contact == $row['contact']) {
                                        echo "
                                        <div class='alert alert-info'>
                                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                            <b>No changes were made.</b>
                                        </div>
                                        ";
                                    } else {
                                        $update_admin = "UPDATE admin_info SET admin_name='$admin_name',email='$email',contact='$contact' where admin_id='$admin_id'";
                                        $run_admin = mysqli_query($con, $update_admin);

                                        if ($run_admin) {
                                            echo "<script>alert('Admin Has Been Updated successfully')</script>";
                                            echo "<script>window.open('admin_list.php','_self')</script>";
                                        }
                                    }
                                }
                            }
                        } else {
                            echo "
                            <div class='alert alert-warning'>
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                <b>Please enter a valid email address.</b>
                            </div>
                            ";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<div style="margin-top:450px;">
    <?php
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>
</div>