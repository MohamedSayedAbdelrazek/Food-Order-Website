<?php
include ('../config/constants.php');
//1.Get The Id From Admin To Be Deleted
$id=$_GET['id'];

//Create SQL Query To Delete Admin
$sql="DELETE FROM tbl_admin where ID=$id";

//Execute SQL Query
$res=mysqli_query($conn,$sql);

//Check Wether The Query Is Executed Successfully Or Not

if($res==true) :
    //Query Executed Successfully and Admin Deleted
  
    //Create Session Variable to Display the messege
    $_SESSION['deleted']="<div class='success'>Admin Deleted Successfully</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
     

else:
    //Failed To Delete Admin
    $_SESSION['deleted']="<div class='error'>Failed To Delete Admin. Try Again Later</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');

endif;

