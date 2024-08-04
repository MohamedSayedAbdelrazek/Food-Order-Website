<?php 
$pageName='Update Password';
include ('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
</br></br>

<?php
    if(isset($_GET['id']))
    {
        //Get The ID Of Selected Admin
        $id=$_GET['id'];
    }


?>
<form action="" method="POST">
    <table class="tbl-30">
        <tr>
            <td>Current Password : </td>
            <td> <input type="password" name="current_password" placeholder="Current Password"></td>
        </tr>
    <tr>
        <td>New Password : </td>
        <td> <input type="password" name="new_password" placeholder="New Password"  > </td>
</br></br>
    </tr>
    <tr>
            <td>Confirm Password : </td>
            <td colspan="2"> 
                <input type="password" name="confirm_password" placeholder="Confirm Password">
            </td>
        </tr>
        <tr>
          <input type="hidden" name="id" value="<?php echo $id;?>">
            <td> <input type="submit" value="Change Password" name="submit" class="btn-secondary"></td>
        </tr>
    </table>
   
</form>
</div>
</div>


<?php
//Check Wether The Submit Button Is Clicked Or Not
    if(isset($_POST['submit'])):
        //1.Get The Data From The Form
        $id=$_POST['id'];
        $current_password=md5($_POST['current_password']);
        $new_password=md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);
        //2.Check Wether The User With  Current ID and Current Password Exists Or Not

        //Create SQL Query To Get The Details
$sql="SELECT * FROM tbl_admin WHERE ID=$id AND password='$current_password'";

//Execute The Query 
$res=mysqli_query($conn,$sql);

//Check Wether The Query Is Executed Or Not

if($res==true):
    //CHEK WETHER THE DATA IS AVAILABLE OR NOT
    $count=mysqli_num_rows($res);
    if($count==1)
    {
        //User Exists And Password Can Be Changed

        //Check Wether The New Password And Confirm Password Match Or Not
        if($new_password==$confirm_password)
        {
            //Update The Password
            $sql2="UPDATE tbl_admin SET
            password='$new_password'
            WHERE ID=$id";

            //Execute The Query
            $res2=mysqli_query($conn,$sql2);

            //Check Wether The Query Is Executed Or Not
            if($res2==true) 
            {
                $_SESSION['change-psw']="<div class='success'>Password Change Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            else
            {
                $_SESSION['change-psw']="<div class='error'>Failed To Change Password.</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        } 
        else
        {
            $_SESSION['psw-not-match']="<div class='error'>Password Did Not match.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
    else 
    {
    //User Does Not Exist , Set Messege And Redirect 
    $_SESSION['user-not-found']="<div class='error'>User Not Found.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
    }
endif;


endif;
?>
<?php include ('partials/footer.php'); ?>

