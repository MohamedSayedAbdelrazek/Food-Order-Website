<?php
$pageName='Update Admin';
 include ('partials/menu.php');
 ?>



<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
</br></br>

<?php
//Get The ID Of Selected Admin
$id=$_GET['id'];

//Create SQL Query to Get The Details
$sql="SELECT * FROM tbl_admin WHERE ID=$id";

//Execute The Query 
$res=mysqli_query($conn,$sql);

//Check Wether The Query Is Executed Or Not
if($res==TRUE) {
    //CHEK WETHER THE DATa IS AVAILABLE OR NOT
    $count=mysqli_num_rows($res);

    //CHECK WETHER WE HAVE ADMIN DATE OR NOT
    if($count==1)
    {
        //Get The Details
        echo "Admin Available</br>";

        $row=mysqli_fetch_assoc($res);

        $full_name=$row['fullName'];
        $user_name=$row['userName'];
    }
    else
    {
        //Redirect to manage-admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}


?>


<form action="" method="POST" class="tbl-30">
    <tr>
        <td>FullName :</td>
        <td><input type="text" name="fullName" value="<?php echo $full_name; ?>"></td>
</tr>
</br></br>
<tr>
        <td>UserName : </td>
        <td><td><input type="text" name="userName" value="<?php echo $user_name;?>"></td></td>
        </tr>
</br></br>
        <tr>
         <td colspan="2"> 
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" value="Update admin" name="submit" class="btn-secondary">
        </td>
        </tr>
        
   
</form>
<?php
//CHECK WETHER THE SUBMIT BUTTON IS CLICKED OR NOT
 if(isset($_POST['submit'])) 
 {
    //GET ALL THE VALUES FROM FORM TO UBDATE
      $user_name=$_POST['userName'];
      $full_name=$_POST['fullName'];
      $id       =$_POST['id'];

      //create sql query to update admin
      $sql="UPDATE tbl_admin SET
      fullName='$full_name',
      userName='$user_name'
      WHERE ID='$id'";

      //Execute The Query
      $res=mysqli_query($conn,$sql);

      //check wether the query executed successfully or not
      if($res==true) 
      {
        //query executed and admin updated
        $_SESSION['update']="<div class='success'>Admin Updated Successfully</div>";

        //Redirect To Manage Admin Page
        header('location:'.SITEURL.'/admin/manage-admin.php');
      }
      else
      {
        //failed to update admin
        $_SESSION['update']="<div class='error'>failed to update admin</div>";
      }
 }
?>
    </div>
</div>














<?php include ('partials/footer.php'); ?> 
