<?php
$pageName='Admins';
include ('partials/menu.php');

?>

<!--main content section Starts-->
<div class="main-content">
    <div class="wrapper" > 

    <h1>Manage Admin</h1>
</br></br>
<?php 
    if(isset($_SESSION['add'])) 
    {
        echo $_SESSION['add']."</br></br></br>";
        unset($_SESSION['add']); // Removing Session Messege (display the messega only once)
    }
    if(isset($_SESSION['deleted'])) 
    {
        echo $_SESSION['deleted']."</br></br></br>";
        unset($_SESSION['deleted']);
    }
    if(isset($_SESSION['update']))
    {
        echo $_SESSION['update']."</br></br></br>";
        unset($_SESSION['update']);
    }
    if(isset($_SESSION['user-not-found'])) 
    {
        echo $_SESSION['user-not-found']."</br></br></br>";
        unset($_SESSION['user-not-found']);
    }
    if(isset($_SESSION['psw-not-match'])) 
    {
        echo $_SESSION['psw-not-match']."</br></br></br>";
        unset($_SESSION['psw-not-match']);
    }
    if(isset($_SESSION['change-psw'])) 
    {
        echo $_SESSION['change-psw']."</br></br></br>";
        unset($_SESSION['change-psw']);
    }
?>
    <!-- Button To Add Admin-->
     <a href="add-admin.php" class="btn-primary">Add Admin</a>
</br></br></br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Actions</th>
            </tr>
            <?php
            //Query To Get All Admin
            $sql="SELECT * FROM tbl_admin";
            
            //Execute The Query
            $res=mysqli_query($conn,$sql);

            //Check Wether The Query Is Executed Or Not
            if($res==TRUE) :

                //Count Rows To Check Wether We Have Data In Database
                $count=mysqli_num_rows($res); //Function To Get All The Rows From DB

                if($count>0):
                    //We Have Data in Data base

                    $sn=1;   //create a value and assign the value=1 
                    //instead of ID wich is may make a problem when we remove a row from database

                    while ($rows=mysqli_fetch_assoc($res)):
                        //Using while loop To Get All The Data From Data base
                        // And while loop will run as long as we have data in data base
                       $id=$rows['ID'];
                       $user_name=$rows['userName'];
                       $full_name=$rows['fullName'];
                       ?>
                        <tr>
                            <td><?php echo $sn++ ;?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $user_name; ?></td>
                            <td>
                            <a href="<?php echo SITEURL;?>/admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                            <a href="<?php echo SITEURL;?>/admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                            <a href="<?php echo SITEURL;?>/admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                            
                            </td>
                        </tr>
                     <?php
                    endwhile;
                endif;
            endif;
            ?>
        </table>
    </div>
</div>
<!--main content section ends-->


<?php include ('partials/footer.php');?>