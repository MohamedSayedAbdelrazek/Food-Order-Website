<?php
include ('../config/constants.php');
if(isset($_GET['id'])) {
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    $evaluation_name=$_GET['evaluation_name'];
 
    if($image_name!="")
        {
            if(file_exists('../images/food/'.$image_name)) 
            {
                $remove=unlink('../images/food/'.$image_name);
                if(!$remove)
                {
                    $_SESSION['remove']="<div class='error'> Failed To Remove Food Image.</div>";
                    header('location:' . SITEURL.'/admin/manage-food.php');
                    die(); // to stop the process
                }
            }
        }
        
        if($evaluation_name!="")
        {
            if(file_exists('../images/food/food-evaluation/'.$evaluation_name))
            {
                $remove2=unlink('../images/food/food-evaluation/'.$evaluation_name);
                if(!$remove2)
                {
                    $_SESSION['remove2']="<div class='error'> Failed To Remove Food Evaluation Image.</div>";
                        header('location:' . SITEURL.'/admin/manage-food.php');
                        die(); // to stop the process
                }
            }
        }

    $sql="DELETE FROM tbl_food Where ID=$id";
    $res=mysqli_query($conn,$sql);
       if($res) {
          $_SESSION['remove']="<div class='success'> Food Deleted Successfuly.</div>";
          header('location:' . SITEURL.'/admin/manage-food.php');
       }
       else {
        $_SESSION['remove']="<div class='error'> Failed To Delete Food.</div>";
        header('location:' . SITEURL.'/admin/manage-food.php');
       }
        
    }
    else {
       
        header('location:'.SITEURL.'admin/manage-food.php');
    }


?>