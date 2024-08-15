<?php 
$pageName='Add Food';
include ('partials/menu.php'); 
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
</br></br>
<?php
if(isset($_SESSION['upload'])) {
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}
if (isset($_SESSION['add'])){
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
?>
<form action="" method="POST" enctype="multipart/form-data">
    <table class="tbl-30">
        
        <tr>
            <td>Title: </td>
            <td>
                <input type="text" name="title" placeholder="Title Of The Food ">
            </td>
        </tr>


        <tr>
            <td>Description: </td>
            <td>
                <textarea name="description" cols="30" rows="5" placeholder="Description Of The Food"></textarea>
            </td>
        </tr>


        <tr>
            <td>Price: </td>
            <td>
                <input type="number" name="price"  placeholder="Food Price" >
            </td>
        </tr>
        
        <tr>
            <td>Select_Image: </td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>

        <tr>
            <td> Category: </td>
            <td>
                <select name="category">
                    <?php
                    //Create PHP Code To Display Categories From Data Base

                    //create Sql to get all active categories from Data Base
                    $sql="SELECT * FROM tbl_category WHERE active='Yes' ";
                    $res=mysqli_query($conn,$sql);
                    $count=mysqli_num_rows($res);

                        if($count>0)
                        {
                            //we have Categories
                            while($row=mysqli_fetch_assoc($res)):
                                $id=$row['ID'];
                                $title=$row['title'];
                                ?>
                                <option value="<?php echo $id?>"><?php echo $title;?></option>
                                <?php
                            endwhile;
                        }
                        else {
                            //We Do Not Have Categories
                            ?>
                            <option value="0">No Category Found</option>
                            <?php

                        }
                    
                   
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <td> Featured: </td>
            <td>
                <input type="radio" name="featured" value="Yes">Yes
                <input type="radio" name="featured"value="No">No
            </td>
        </tr>
        
        <tr>
            <td> Active: </td>
            <td>
                <input type="radio" name="active" value="Yes">Yes
                <input type="radio" name="active"value="No">No
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <input type="submit" value="Add Food" name="submit" class="btn-secondary">
            </td>
       
      </tr>
    </table>
    
</form>

<?php
if(isset($_POST['submit'])) 
{
    //1.Get The Data From Form
    $title=filter_var($_POST['title'],FILTER_SANITIZE_STRING); 
    $description=filter_var($_POST['description'],FILTER_SANITIZE_STRING); 
    $price=filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_INT); 
    $category=$_POST['category'];
    // $image_name=$_POST['image'];
    
    //Check Wether radio button for featured and active are checked or not
    if(isset($_POST['featured'])){
        $featured=$_POST['featured'];
    }
    else{
        $featured="No";
    }
   
    if(isset($_POST['active'])){
        $active=$_POST['active'];
    }
    else{
        $active="No";
    }
   
   

    //2.Upload The Image If Selected
    //Check Wether The Select Image Is Clicked Or Not And Upload Image Only If The Image Is selected
    if(isset($_FILES['image']['name'])) {
        //Get the Details Of The Selected Image
        $image_name=filter_var($_FILES['image']['name'],FILTER_SANITIZE_STRING); 

        //Check Wether The Image Is Selected Or Not and Upload Image If Selected
        if($image_name!=""){
            //image selected 

            //A.Rename The Image
            $ext=pathinfo($image_name,PATHINFO_EXTENSION);
            // $ext=end(explode('.',$image_name));
            $image_name=uniqid("Food-Name-" , TRUE).".".$ext;
            

            //B.Upload The Image 
            
            //Get The src Path and Destination Path 

            //The source Path is the current location Of the Image
            $src=$_FILES['image']['tmp_name'];

            //Destination Path For The image To be Uploaded
             $dst="../images/food/".$image_name;

             //Finally Upload The Image Food
             $upload=move_uploaded_file($src,$dst);
             
             if(!$upload)
             {
                //Failed To Upload Image 
                $_SESSION['upload']="<div class='error'>Failed To Upload Image.</div>";
                header('location:'.SITEURL.'admin/add-food.php');
                die();   // to stop the process
             }
        }
    }
    else {
        $image_name="";
    }
    //3. Insert Into Data Base
$sql2="INSERT INTO tbl_food (title, description, price, image_name, category_id, featured, active) 
                     VALUES ('$title', '$description', '$price', '$image_name', '$category', '$featured', '$active')";

$res2=mysqli_query($conn,$sql2);

if($res2==true){
$_SESSION['add']="<div class='success'> Food Added Successfuly.</div>";
header('location:'.SITEURL.'admin/manage-food.php');
}
else {
    $_SESSION['add']="<div class='error'> Failed To Add Food.</div>";
    header('location:'.SITEURL.'admin/add-food.php');
}

}
?>
    </div>
</div>

<?php include ('partials/footer.php'); ?>