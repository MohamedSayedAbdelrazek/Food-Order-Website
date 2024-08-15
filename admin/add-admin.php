<?php 
$pageName='Add Admin';
include ('partials/menu.php');
 ?>

<div class="main-content">
    <div class="wrapper">
       
        <h1>Add Admin</h1>
</br> </br>
<?php
        if(isset($_SESSION['add'])) {
            echo $_SESSION['add'] . "</br></br></br>";  // Display The Session Messege If Is Set
            unset($_SESSION['add']);  // Remove The Session Messege
        }
        ?>
        <form action="" method="POST">

           <div>
            <label for="fl">Full Name :   </label>
            
            <input type="text" name="full_name" id="fl" placeholder="Your Full Name" required>
            </div>
</br>
           <div>

            <label for="un">userName: </label>
            <input type="text" name="user_name" id="un" placeholder="Your User Name" required>
           </div>
           </br>

           <div>
            <label for="ps">Password : </label>
            <input type="password" name="password" id="ps" placeholder="Your Password" required minlength="6" maxlength="16">
           </div>
</br>
           <input type="submit" value="Add Admin" name="submit" class="btn-secondary">
        </form>
    </div>
</div>

<?php include ('partials/footer.php');?>

<?php
// Process The Value From Form And Save It In DataBase

// Check whether the submit button is clicked or not 
if(isset($_POST['submit'])) {
    // Button Clicked

    // Get The Data From The Form
  
    $full_name =filter_var($_POST['full_name'],FILTER_SANITIZE_STRING);
    $user_name =filter_var($_POST['user_name'],FILTER_SANITIZE_STRING); 
    $password = md5($_POST['password']);   // Password Encryption with md5

    // SQL Query To Save The Data Into DataBase
    $sql = 
    "INSERT INTO tbl_admin SET
   fullName='$full_name',
   userName='$user_name',
   password='$password'";
           

    // execute query and save the data into database
   $res=mysqli_query($conn,$sql) or die(mysqli_error());


   //check wether (the query is executed) data is inserted or not 

   if($res==TRUE) {
    //create a session variable to display  message
    $_SESSION['add']="<div class='success'>Admin Added Successfully</div>";
    //redirect page to manage admin
    header('location:'.SITEURL .'admin/manage-admin.php');
   }
   else {
     //create a session variable to display  message
     $_SESSION['add']="<div class='error'>Failed To Add Admin</div>";
     //redirect page to add admin
     header('location:'.SITEURL .'admin/add-admin.php');
   }
}
?>
