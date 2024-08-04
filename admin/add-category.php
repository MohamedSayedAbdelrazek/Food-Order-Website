<?php
$pageName='Add Category';
 include ('partials/menu.php');
 ?>
<div class="main-content">
    <div class="wrapper">

        <h1>Add Category</h1>
        </br></br>
        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
</br></br>
    <!--Add Category Form Starts-->
   <form action="" method="POST" enctype="multipart/form-data">
     <table class='tbl-30'>

          <tr>
            <td>Title : </td>
            <td>
                <input type="text" name="title" placeholder="Category Title">
            </td>
          </tr>

          <tr>
            <td> Select Image : </td>
            <td>
             <input type="file" name="image">
            </td>
          </tr>


          <tr>
            <td>Featured : </td>
            <td>
                <input type="radio" name="featured" value="Yes">Yes
                <input type="radio" name="featured" value="No" >No
            </td>
          </tr>

          <tr>
            <td> Active : </td>
            <td>
                <input type="radio" name="active" value="Yes">Yes
                <input type="radio" name="active" value="No">No
            </td>
          </tr>

          <tr>
            <td colspan="2">
            <input type="submit" name ="submit" value="Add Category"  class="btn-secondary">
            </td>
          </tr>
          
     </table>

   </form>

    <!--Add Category Form ends-->
<?php


// Process The Value From Form And Save It In DataBase

// Check whether the submit button is clicked or not 
if(isset($_POST['submit'])):
// Button Clicked

      // Get The Data From The Form
    $title=$_POST['title'];

    //for radion input , We need to check wether the button is selected or not
    if(isset($_POST['featured']))
    {
        //Get The Value From Form 
        $featured=$_POST['featured'];
    }
    else
    {
        //Set The Default Value
        $featured="No";
    }

    if(isset($_POST['active']))
    {
        //Get The Value From Form 
        $active=$_POST['active'];
    }
    else
    {
        //Set The Default Value
        $active="No";
    }
    
    
    //Check Wether The Image Is Selected Or Not and set the value for image name


//    print_r($_FILES['image']);
//    die(); //Break The Code here
if(isset($_FILES['image']['name']))
{

    //Upload The File
    //To Upload Image , We Need image name, source path and destination path
    
    $image_name=$_FILES['image']['name']; 
    //upload the image only if image is selected
    if($image_name!="")
    {
    //Auto Rename Our Page
    //Get The Extension Of Our Image
    $ext=end(explode('.',$image_name));

    //Rename The Image

    $image_name="Food_Category_".rand(000,999).'.'.$ext;

    $source_path=$_FILES['image']['tmp_name'];
    $destination_path="../images/category/".$image_name;

    //Finally Upload The Image
    $upload=move_uploaded_file($source_path,$destination_path);

    //Check wether the image is uploaded or not
    //and if the image is not uploaded then we will stop the process and redirect with error messege
    if($upload==false)
    {
        //set the error message
        $_SESSION['upload']="<div class='error'> Failed To Upload Image.</div>";
        header('location:'.SITEURL.'admin/add-category.php');

            //stop the process if the image failed to upload because we do not need the data to be inserte into DB
        die();
    }
    }
   }
else
{
//Do not Upload The image and set the image_name value as blak

//or I have already made the image_name as NOT NULL in SQL
$image_name=""; 
}

     // SQL Query To Insert Category   Into DataBase
    $sql="INSERT INTO tbl_category SET
    title='$title',
    image_name='$image_name',
    featured='$featured',
    active='$active' ";

    // execute query and save the data into database
    $res=mysqli_query($conn,$sql);

    //check wether (the query is executed) data is inserted or not 
    if($res==true)
    {
        //Query Executed and Category Added
        $_SESSION['add']="<div class='success'>Category Added Successfully</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        $_SESSION['add']="<div class='error'>Failed To Add Category</div>";
        header('location:'.SITEURL.'admin/add-category.php');
    }
endif;
?>

    </div>
</div>




<?php include ('partials/footer.php');?>