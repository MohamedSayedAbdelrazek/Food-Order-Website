<?php
include ('../config/constants.php');

if(isset($_GET['id']) AND isset($_GET['image_name']))
{
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];
        
            //Remove the physical image_file if is available
            if($image_name!="")
            {

                //Image Is Available . So Reomove it 
                $imagePath="../images/category/".$image_name;

                //Remove The Image 
                $remove=unlink($imagePath);

                //if failed to remove the image then add an error messege and stop the process
                if(!$remove)
                {
                    $_SESSION['remove']="<div class='error'> Failed To Remove Category Image.</div>";
                    header('location:' . SITEURL.'/admin/manage-category.php');
                    die(); // to stop the process
                }
            }

            $sql="DELETE FROM tbl_category WHERE ID=$id";
            $res=mysqli_query($conn,$sql);
            if($res==true):
                    $_SESSION['delete']="<div class='success'>Category Deleted Successfully.</div>";
                    header('location:'.SITEURL."admin/manage-category.php");
               
        else :
                $_SESSION['deleted']="<div class='error'>Failed To Delete Category. Try Again Later</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
        
        endif;
}
else
{
  header('location:'.SITEURL.'admin/manage-category.php');
}
?>