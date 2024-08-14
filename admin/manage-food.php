<?php 
$pageName='Foods';
include ('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Food</h1>
    </br></br>
     <?php
      if (isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }

     if (isset(  $_SESSION['remove'])){
        echo   $_SESSION['remove'];
        unset(  $_SESSION['remove']);
    }
    if (isset(  $_SESSION['remove2'])){
        echo   $_SESSION['remove2'];
        unset(  $_SESSION['remove2']);
    }
    if (isset( $_SESSION['failed-remove'])){
        echo $_SESSION['failed-remove'];
        unset( $_SESSION['failed-remove']);
    }
    if (isset( $_SESSION['failed-remove2'])){
        echo $_SESSION['failed-remove2'];
        unset( $_SESSION['failed-remove2']);
    }

    if (isset( $_SESSION['upload'])){
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }
    if (isset( $_SESSION['upload2'])){
        echo $_SESSION['upload2'];
        unset($_SESSION['upload2']);
    }

    if (isset(    $_SESSION['update'])){
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }
 
     ?>
     </br></br>
    <!-- Button To Add Admin-->
     <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
</br></br></br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Evaluation</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql="SELECT * FROM tbl_food ";
            $res=mysqli_query($conn,$sql);

            $count=mysqli_num_rows($res);
            if($count>0)
            {
                //We Have Foods In DataBase
                $sn=1;
                while($row=mysqli_fetch_assoc($res)):
                    $id=$row['ID'];
                    $title=$row['title'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $image_name=$row['image_name'];
                    $evaluation_name=$row['evaluation_name'];
                    $category=$row['category_id'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                    ?>
                    <tr>
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $title;?></td>
                        <td>$<?php echo $price;?></td>
                        <td> 
                            <?php
                            // check wether we have image or not
                            if($image_name=="")
                            {
                                //We dont have image
                                echo "<div class='error'>Image Not Added</div>";
                            }
                            else
                            {
                                ?>
                                  <img src="../images/food/<?php echo $image_name;?>" width="100px">
                                <?php
                            }
                            ?>
                      
                    <td>
                        <?php
                        if($evaluation_name=="")
                        {
                            echo"<div class='error'>Evaluation Image Not Added.</div>";
                        }
                        else
                        {
                            ?>
                            <img src="../images/food/food-evaluation/<?php echo $evaluation_name;?>" width="100px">
                            <?php
                        }
                        ?>
                    </td>
                    </td>
                        <td><?php echo $featured;?></td>
                        <td><?php echo $active;?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                            <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?> &image_name=<?php echo $image_name;?>&evaluation_name=<?php echo $evaluation_name;?>" class="btn-danger">Delete Food</a>
                        </td>
                        
                    </tr>
                    <?php

                endwhile;
            }
            else
            {
                //We Donot Have Any Food In DB
                ?>
                <tr>
                    <td colspan="7"> <div class="error">Food Not Added Yet.</div></td>
                </tr>
                <?php
            }
            
            ?>
          
        </table>
    </div>
   
</div>

<?php include ('partials/footer.php'); ?>