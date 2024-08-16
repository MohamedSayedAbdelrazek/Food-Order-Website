<?php 
    include ('../config/constants.php'); 
    include ('login-check.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/cate.css">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($pageName)) {echo $pageName;}?></title>
</head>
<body>
<!--menu section starts-->
<div class="menu text-center">
    <div class="wrapper">  
        <ul>
            <li><a <?php if($pageName=='Dashboard')  {echo "class='success'"; }?> href="index.php" >Home</a></li>
            <li><a <?php if($pageName=='Admins')     {echo "class='success'"; }?> href="manage-admin.php">Admin</a></li>
            <li><a <?php if($pageName=='Categories') {echo "class='success'"; }?> href="manage-category.php">Category</a></li>
            <li><a <?php if($pageName=='Foods')      {echo "class='success'"; }?> href="manage-food.php">Food</a></li>
            <li><a <?php if($pageName=='Orders')     {echo "class='success'"; }?> href="manage-order.php">Order</a></li>
            <li><a  href="logout.php">Logout</a></li>
        </ul>
    </div>
  
</div>
<!--menu section ends-->
