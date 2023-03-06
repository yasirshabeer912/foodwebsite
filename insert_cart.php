<?php
session_start();
include 'config/dbcon.php';

if(isset($_POST['add-to-cart']))
$title = $_POST['title'];
$price = $_POST['price'];
$image = $_POST['image'];
$quantity = 1;

$check_item =$con->query("SELECT * FROM cart WHERE title ='$title' ");
if(mysqli_num_rows($check_item) > 0){
    $_SESSION['error']= "Item Already Exists";
    header('location:index.php');
} 
else{
    $sql =$con->query("INSERT INTO `cart`(`title`, `price`, `image`, `quantity`) VALUES ('$title','$price','$image','$quantity')") ;
    if($sql){
        $_SESSION['success']="Item Added To Cart successfully";
        header('location: index.php');
    }
    else{
        $_SESSION['error']= "Something Went Wrong";
        header('location:index.php');
    }
}



?>