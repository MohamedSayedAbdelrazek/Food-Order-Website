    <?php include ('../config/constants.php'); ?>
<html>
    <head>
        <title>Admin Login</title>
        
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="../css/login.css">
        <link rel="stylesheet" href="../css/cate.css">
     
    </head>

    <body>
        
        <div class="login" id="border">
            <h1 class="text-center" id="log">Admin Login</h1> </br>

            <?php

                if(isset( $_SESSION['login']))
                {
                    echo  $_SESSION['login'];
                    unset( $_SESSION['login']);
                }

                if(isset( $_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset( $_SESSION['no-login-message']);
                }
            ?>
            </br></br>
         <!--Login Form Starts Here-->

         <form action="" method="POST" class="text-center">
            <div>

            <label for="usern" class="lab"> Username:</label>
            <input type="text" name="username" id="usern" placeholder="Enter Your Username">
            </div></br>
            <label for="userp" class="lab"> Password:</label>
            <div class="icon">
           
            <input type="password" name="password" id="userp" placeholder="Enter Your Password" req>
            <img src="eye.png" alt="" onclick="pass()"
class="pass-icon" id="pass-icon">

        </div> </br>
           <input type="submit" value="Login" name="submit" class="btn-primary" id="but1"> </br></br>
         </form>
         <!--Login Form Ends Here-->
            <p class="text-center" id="footer">Created By <a href="#">Mohamed Sayed</a> <span>&</span> <a href="#">Aya Kamal</a></p>
        </div>
        <script src="pass.js"></script>
    </body>
</html>


<?php
//Check Wether The Submit Button Is Clicked Or Not
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])):

    //Get The Data From The Form
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=mysqli_real_escape_string($conn,md5($_POST['password']));

    //SQL Query To Check Wether The User With username and password exist or Not
    $sql="SELECT * FROM tbl_admin WHERE userName='$username' AND password='$password'";

    //Execute The Query
    $res=mysqli_query($conn,$sql);

    if($res==true):
        
        //Count The Rows To Check Wether The User Exist Or Not
        $count=mysqli_num_rows($res);
        if($count==1)
        {
            //User Available And Login Success
            $_SESSION['login']="<div class='success'>Welcome ".$username.". </div> ";

            $_SESSION['user']=$username; 
             //To Check Wether The User Is Logged In Or Not & Logout Will unset it

            //Redirect To home Page (dashboard)
            header('location:'.SITEURL.'admin/'); // automatically go to index.php
        }
        else 
        {
           //User Not Available And Login Success
           $_SESSION['login']="<div class='error text-center' calss='text-center'>User name or Password did not match.</div> ";

           //Redirect To home Page (dashboard)
           header('location:'.SITEURL.'admin/login.php'); // automatically go to index.php
        }
       

    endif;

endif;

?>