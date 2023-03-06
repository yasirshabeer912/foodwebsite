<?php
session_start();
require_once("config/dbcon.php");
if (isset($_POST['login_button'])) {
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $password = mysqli_real_escape_string($con, $_POST['password']);


  $sql = $con->query("select * from users where email='$email'  AND password='$password'");


  if ($sql->num_rows > 0) {
    $query_fetch = $sql->fetch_assoc();
    $_SESSION['user_id'] = $query_fetch['id'];
    $_SESSION['success'] = "Logged in Successfully";
    // check the user's role
    if ($query_fetch['role_as'] == '1') {
      header('Location: admin/index.php');
    } else {
      header('Location: index.php');
    }
  } else {
    $_SESSION['error'] = " not registered"; //message to show
    header("Location: login.php");
    exit(0);
  }
}

?>

<?php include 'header.php' ?>


<div class="container">
  <div class="row">
    <h4 class="pt-5">Login</h4>
    <?php

    // Your message code
    if (isset($_SESSION['message'])) {
      echo '<h4 class="alert alert-warning w-25 mx-auto">' . $_SESSION['message'] . '</h4>';
      unset($_SESSION['message']);
    }

    ?>

    <form id="contact_form" name="" class="p-5" action="" method="post" novalidate="novalidate">
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <input name="email" class="form-control" type="email" placeholder="email">
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <input name="password" class="form-control required email" type="password" placeholder="password">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col start-end">
          <div class="mb-3 mb--0 m-auto">
            <input name="form_botcheck" class="form-control" type="hidden" value="">
            <button name="login_button" type="submit" class="btn btn-md btn-theme-colored2" data-loading-text="Please wait...">Login ➞</button>
          </div>
        </div>
        <a class="text-dark" href="signup.php">Create New Account</a>
      </div>
    </form>

  </div>

</div>