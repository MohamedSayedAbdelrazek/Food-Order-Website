<?php
//this page has been included in menu.php


//Authorization Access Control

//Check Wether The User Is Logged In Or Not

if(!isset($_SESSION['user'])) // If User Session Is Not Set
{
//User Is Not Logged In
//Redirect With Login Page With Message
$_SESSION['no-login-message']="<div class='error text-center'>Please Login To Access Admin Panel.</div>";

header('location:'.SITEURL.'admin/login.php');
}
?>
