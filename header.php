<?php

session_start();
include 'config/dbcon.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>food website
    </title>

    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome5.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main.css">

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow fixed-top">
            <div class="container-lg px-sm-3">
                <a class="navbar-brand" href="#">FO0ODIE.</a>
                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-2 py-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="categories.php">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="">Food</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="#">Stokists</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="#">Contact</a>
                        </li>
                    </ul>
                    <div class="others d-flex justify-content-center">
                        <div class="dropdown">
                            <?php
                            if (isset($_SESSION['user_id'])) {
                                $id = $_SESSION['user_id'];
                                $user = $con->query("select * from users where id='$id'")->fetch_assoc();
                            ?>
                                <a class="btn  dropdown-toggle shadow-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $user['name'] ?>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="login.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="register.php">Orders</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                        </div>
                    <?php }else{
                       ?>
                         <div class="others d-flex justify-content-center">
                         <div class="dropdown">
                         <a class="btn  dropdown-toggle shadow-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Account
                                </a>
                                
 
                                 <ul class="dropdown-menu">
                                     <li><a class="dropdown-item" href="login.php">Login</a></li>
                                     <li><a class="dropdown-item" href="register.php">Register</a></li>
                                     <li>
                                         <hr class="dropdown-divider">
                                     </li>
                                     <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                 </ul>
                         </div>
                 
                    
                    <?php
                    }
                    ?>







                    <?php
                     if (isset($_SESSION['user_id'])){
                    $sqll = $con->query("SELECT * FROM cart") or die("Qesry Faild");
                    $countt = mysqli_num_rows($sqll);
                    ?>
                    <a href="cart.php">
                        <div class="order btn btn-warning border">Cart &nbsp;<span class="bg-light text-dark px-2 rounded-pill"> <?php echo $countt ?></span></div>
                    </a>
                    </div>
                    <?php
                     }
                     else{
                        ?>
                         <a href="login.php">
                        <div class="order btn btn-warning border">Cart &nbsp;<span class="bg-light text-dark px-2 rounded-pill"> 0</span></div>
                    </a>
                        <?php
                        $_SESSION['cart']="Login To access the Cart";
                     }
                     
                    ?>

                </div>

            </div>
        </nav>
    </header>