<?php
include 'config/dbcon.php';

session_start();
if (isset($_POST['register_btn'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    if ($password == $confirm_password) {
        // Check Email
        $checkemail = "SELECT email FROM users WHERE email='$email' LIMIT 1";
        $checkemail_run = mysqli_query($con, $checkemail);

        if (mysqli_num_rows($checkemail_run) > 0) {
            // Already Email Exists
            $_SESSION['success'] = "Already Email Exists";
            header("Location: register.php");
            exit(0);
        } else {
            $user_query = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')";
            $user_query_run = mysqli_query($con, $user_query);

            if ($user_query_run) {
                $_SESSION['success'] = "Registered Successfully";
                header("Location: index.php");
                exit(0);
            } else {
                $_SESSION['success'] = "Something Went Wrong!";
                header("Location: register.php");
                exit(0);
            }
        }
    } else {
        $_SESSION['success'] = "Password and Confirm Password does not Match";
        header("Location: signup.php");
        exit(0);
    }
}
?>

<?php include 'header.php' ?>
<div class="container" style="margin-top:10%">
    <div class="row">
        <h4 class="pt-5 text-center">Register</h4>
        <?php
        // Your success code
        if (isset($_SESSION['success'])) {
            echo '<h4 class="alert alert-warning w-25">' . $_SESSION['success'] . '</h4>';
            unset($_SESSION['success']);
        } // Your message code
        ?>
           
        <form id="contact_form" class="p-5 border" action="" method="post" novalidate="novalidate">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="mb-3">
                        <input name="name" required class="form-control" type="text" placeholder="First Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <input name="email" required class="form-control" type="email" placeholder="email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <input name="password" required class="form-control required email" type="password" placeholder=" Change password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <input name="confirm_password" required class="form-control required email" type="password" placeholder="Confrim password">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col start-end">
                    <div class="mb-3 mb--0 m-auto">
                        <input name="form_botcheck" class="form-control" type="hidden" value="">
                        <button name="register_btn" type="submit" class="btn btn-md btn-warning" data-loading-text="Please wait...">Register ➞</button>
                    </div>
                </div>

            </div>
        </form>

    </div>

</div>

<?php include 'footer.php' ?>