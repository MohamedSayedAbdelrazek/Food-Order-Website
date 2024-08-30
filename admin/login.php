<?php 
include ('../config/constants.php'); 

// Initialize the error message variable
$error_message = '';

// Check Whether The Submit Button Is Clicked Or Not
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])):

    // Get The Data From The Form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $real_password= $password;
    // Check for empty fields
    if(empty($username) || empty($password)):
        $error_message = "<div class='error text-center'>User name or Password did not match.</div>";
    else:  
        // SQL Query To Check Whether The User With username and password exists or Not
        $password = mysqli_real_escape_string($conn, md5($password));
        $sql = "SELECT * FROM tbl_admin WHERE userName='$username' AND password='$password'";

        // Execute The Query
        $res = mysqli_query($conn, $sql);

        if($res == true):
            // Count The Rows To Check Whether The User Exists Or Not
            $count = mysqli_num_rows($res);
            if($count == 1):
                // User Available And Login Success
                $_SESSION['login'] = "<div class='success'>Welcome ".$username.". </div> ";
                $_SESSION['user'] = $username; 
                // Redirect To home Page (dashboard)
                header('location:'.SITEURL.'admin/'); // Automatically go to index.php
                exit();
            else:
                // User Not Available And Login Failure
                $error_message = "<div class='error text-center'>User name or Password did not match.</div>";
            endif;
        else:
            $error_message = "<div class='error text-center'>Login failed. Please try again.</div>";
        endif;
    endif;
endif;
?>

<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/cate.css">
</head>
<body>
    <div class="login" id="border">
        <h1 class="text-center" id="log">Admin Login</h1>
        <br>

        <?php
            // Display the login messages and error messages if set
            if(isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }

            if (!empty($error_message)) {
                echo $error_message;
            }
        ?>
        <br><br>
        <!--Login Form Starts Here-->
        <form action="" method="POST" class="text-center">
            <div>
                <label for="usern" class="lab"> Username:</label>
                <input type="text" name="username" id="usern" placeholder="Enter Your Username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">
            </div>
            <br>
            <label for="userp" class="lab"> Password:</label>
            <div class="icon">
                <input type="password" name="password" id="userp" placeholder="Enter Your Password" value="<?php if(isset($_POST['password'])) echo $_POST['password']; else echo ''; ?>" >
                <img src="hidden.png" alt="" onclick="pass()" class="pass-icon" id="pass-icon">
            </div>
            <br>
            <input type="submit" value="Login" name="submit" class="btn-primary" id="but1">
            <br><br>
        </form>
        <!--Login Form Ends Here-->
        <p class="text-center" id="footer">Created By <a href="https://www.linkedin.com/in/mohamed-sayed-01b02a287/">Mohamed Sayed</a> <span>&</span> <a href="https://www.linkedin.com/in/aya-kamal-b19b022b0/">Aya Kamal</a></p>
    </div>
    <script src="pass.js"></script>
</body>
</html>
