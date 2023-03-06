<?php session_start();
if (isset($_SESSION['admin_id'])) {
header('location: index.php');
}
                            


require("../config/dbcon.php");
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = $con->query("select * from admin where email='$email' AND password='$password'");
    if ($sql->num_rows > 0) {
        $admin = $sql->fetch_assoc();
        $_SESSION['admin_id'] = $admin['id'];
        header("location:index.php");
    } else {
        $_SESSION['error'] = "Your Login detail invalid";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- PAGE TITLE HERE -->
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="includes/assets/css/bootstrap.min.css">
    <!-- Favicon icon -->
<style>
    body{
        background: linear-gradient(140deg , #277a00 , 50% , #7be271);   
        background-size: cover;
        background-repeat: no-repeat;
        height: 100vh;
    }
    .container{
        padding-top: 190px;
    }
</style>
</head>

<body class="body ">
    <div class="container mx-auto " >
        <div class="row  align-items-center justify-contain-center  mx-auto">
            <div class="col-xl-5 mx-auto">
                <div class="card">
                    <div class="card-body ">
                        <div class="row ">

                            <?php
                            if (isset($_SESSION['success'])) {
                            ?>
                                <h4 class="alert alert-success w-50 text-center m-auto mt-3"><?php echo $_SESSION['success'] ?></h4>
                            <?php
                                unset($_SESSION['success']);
                            }
                            ?>

                            <div class="col-xl-12 col-md-12">
                                <div class="sign-in-your py-4 px-2">
                                    <h3 class="mx-auto text-center mb-3">Admin <span class="text-danger"> Login</span></h3>
                                    <hr class="mx-auto" width="80px" style="height:3px; color:red; background-color:red">

                                    <form method="post">
                                        <div class="mb-6">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" name="email" class="form-control shadow-none">
                                        </div>
                                        <div class="mb-6">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control shadow-none" >
                                        </div>
                                        <div class="row d-flex justify-content-between mt-4 mb-6">


                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/dlabnav-init.js"></script>


</body>

</html>