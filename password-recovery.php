<?php
session_start();
error_reporting(0);
include_once('includes/config.php');
if(isset($_POST['submit'])) {
    $username = $_POST['emailid'];
    $cnumber = $_POST['phoneno'];
    $newpassword = md5($_POST['inputPassword']);
    $ret = mysqli_query($con, "SELECT id FROM users WHERE email='$username' and contactno='$cnumber'");
    $num = mysqli_num_rows($ret);
    if($num > 0) {
        $query = mysqli_query($con, "update users set password='$newpassword' WHERE email='$username' and contactno='$cnumber'");
        echo "<script>alert('Password reset successfully.');</script>";
        echo "<script type='text/javascript'> document.location ='login.php'; </script>";
    } else {
        echo "<script>alert('Invalid Email or Reg Contact Number');</script>";
        echo "<script type='text/javascript'> document.location ='password-recovery.php'; </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Shopping | User Sign up</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/jquery.min.js"></script>
        <script type="text/javascript">
            function valid() {
                if(document.passwordrecovery.inputPassword.value != document.passwordrecovery.cinputPassword.value) {
                    alert("Password and Confirm Password Field do not match  !!");
                    document.passwordrecovery.cinputPassword.focus();
                    return false;
                }
                return true;
            }
        </script>
    </head>
    <style type="text/css">
        input { border:solid 1px #000; }
    </style>
    <body>
        <?php include_once('includes/header.php'); ?>
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">User Password Recovery </h1>
                </div>
            </div>
        </header>
        <section class="py-5">
            <div class="container px-4 mt-5">
                <form method="post" name="passwordrecovery" onSubmit="return valid();">
                    <div class="row mt-3">
                        <div class="col-2">Email Id</div>
                        <div class="col-6"><input type="email" name="emailid" id="emailid" class="form-control" required></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">Reg. Contact No.</div>
                        <div class="col-6"><input type="text" name="phoneno" id="phoneno" class="form-control" required></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">Password</div>
                        <div class="col-6"><input type="password" name="inputPassword" id="inputPassword" class="form-control" required></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">Password Recovery</div>
                        <div class="col-6"><input type="password" name="cinputPassword" id="cinputPassword" class="form-control" required></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">&nbsp;</div>
                        <div class="col-6"><input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit" required></div>
                    </div>
                </form>
            </div>
        </section>
        <?php include_once('includes/footer.php'); ?>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
