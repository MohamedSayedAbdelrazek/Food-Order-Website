<?php
$pageName="Categories";
 include ('partials/menu.php');
 ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Category</h1>
</br></br>
    <?php

        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['remove']))
        {
            echo  $_SESSION['remove'];
            unset( $_SESSION['remove']);
        }

        if(isset( $_SESSION['delete']))
        {
            echo  $_SESSION['delete'];
            unset( $_SESSION['delete']);
        }

        if(isset($_SESSION['no-category-found']))
        {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        
        if(isset( $_SESSION['update']))
        {
            echo  $_SESSION['update'];
            unset( $_SESSION['update']);
        }
        if(isset($_SESSION['upload']))
        {
            echo  $_SESSION['upload'];
            unset( $_SESSION['upload']); 
        }
        if(isset($_SESSION['failed-remove']))
        {
            echo   $_SESSION['failed-remove'];
            unset ($_SESSION['failed-remove']);
        }
        
        ?>
    </br></br>
     
    <!-- Button To Add Admin-->
     <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
</br></br></br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql="SELECT * FROM tbl_category";

            $res=mysqli_query($conn,$sql);
            if ($res==true)
     {

            
            $count=mysqli_num_rows($res);

            if($count>0)
            {
                $sn=1;
                while($rows=mysqli_fetch_assoc($res)):
                    ?>
                    <tr>
                        <td><?php echo $sn++;?>.</td>
                        <td><?php echo $rows['title'];?></td>
                        <td>

                        <?php 
                        //Check wether the image name is available or not
                        if($rows['image_name']!="")
                        {
                            //Display The Image
                            ?>
                            <img src="<?php echo SITEURL ;?>images/category/<?php echo $rows['image_name'];?>"width="100px" >
                            <?php
                        }
                        else
                        {
                            //Display The message
                            echo "<div class='error'>Image Not Added.</div>";
                        }
                        ?>
                        
                        </td>
                        <td><?php echo $rows['featured'];?></td>
                        <td><?php echo $rows['active'];?></td>
                        <td>
                        <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $rows['ID'];?>& image_name="<?php echo $rows['image_name'];?> class="btn-secondary">Update Category</a>
                        <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $rows['ID'];?>& image_name=<?php echo $rows['image_name']; ?>" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>
                    <?php
                endwhile;
            }
            else
            {
                // We Do Not have data in data base
                //we'll display the message inside table
                ?>
                <tr>
                    <td colspan="6">
                        <div class="error">Not Category Added.</div>
                    </td>
                </tr>
                <?php
            }
    }
            ?>
          
        </table>
    </div>
   
</div>

<?php include ('partials/footer.php'); ?>