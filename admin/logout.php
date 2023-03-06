<?php

session_start();
$_SESSION['success']= "Logged out";
session_unset();
header("location:login.php");

?>