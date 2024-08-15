<?php include_once('../config/constants.php'); ?>
<?php

if(isset($_GET['id'])):
    $id=$_GET['id'];
    $sql="DELETE FROM tbl_order WHERE ID=$id";
    $res=mysqli_query($conn,$sql);
    if($res):
        $_SESSION['delete']="<div class='success'>Order Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    else:
        $_SESSION['delete']="<div class='error'>Failed To Delete Order.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    endif;
else:
    header('location:'.SITEURL.'admin/manage-order.php');
    die;
endif;
?>