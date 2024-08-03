<?php
//include constants.php for SITEURL
include ('../config/constants.php');

//Destroy The Session
session_destroy();     //unsests $_SESSION['user']

//Redirect To Login Page
header('location:'.SITEURL.'admin/login.php');



?>