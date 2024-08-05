<?php 
$pageName='Update Category';
include ('partials/menu.php'); 
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php

        if(isset($_GET['id']) AND isset($_GET['image_name']))
         {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_category WHERE ID=$id";
            $res = mysqli_query($conn, $sql);

            if ($res == true) 
            {
                $count = mysqli_num_rows($res);

                if ($count == 1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $active = $row['active'];
                    $featured = $row['featured'];
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                } 
                else
                {
                    $_SESSION['no-category-found'] = "<div class='error'>Category Not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                    exit();
                }
            } 
            else
            {
                header('location:'.SITEURL.'admin/manage-category.php');
                exit();
            }
        } else 
        {
            header('location:'.SITEURL.'admin/manage-category.php');
            exit();
        }
        ?>

        <form action="" enctype="multipart/form-data" method="POST">
            <table class="tbl-30">

                <tr>
                    <td> Title : </td>
                    <td> <input type="text" name="title" value="<?php echo $title; ?>" required></td>
                </tr>
                <br><br>

                <tr>
                    <td>Current Image : </td>
                    <td>
                        <?php
                        if ($current_image != "") 
                        {
                            // Display The Image
                            ?>
                            <img src="<?php echo SITEURL ;?>images/category/<?php echo $current_image ?>" width="150px">
                            <?php
                        } else 
                        {
                            // Display Message
                            echo "<div class='error'> Image Not Added.</div>";
                        }
                        ?>
                    </td>
                </tr>
                <br><br>

                <tr>
                    <td>New Image : </td>
                    <td>
                        <input type="file" name="new-image">
                    </td>
                </tr>
                <br><br>

                <tr>
                    <td> Featured : </td>
                    <td> 
                        <input <?php if ($featured == "Yes") { echo "checked"; } ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if ($featured == "No") { echo "checked"; } ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <br><br>

                <tr>
                    <td> Active : </td>
                    <td> 
                        <input <?php if ($active == "Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($active == "No") { echo "checked"; } ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <br><br>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" value="Update Category" name="submit" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) 
        {
            $id = $_POST['id'];
            $title=filter_var($_POST['title'],FILTER_SANITIZE_STRING); 
            $current_image = $_POST['current_image'];
            $active = $_POST['active'];
            $featured = $_POST['featured'];

            // Handle new image upload
            if (isset($_FILES['new-image']['name']) && $_FILES['new-image']['name'] != "")
             {
                $image_name=filter_var($_FILES['image']['name'],FILTER_SANITIZE_STRING);

                // Get the extension of the new image
                $ext = end(explode('.', $image_name));

                // Rename the image
                $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

                $source_path = $_FILES['new-image']['tmp_name'];
                $destination_path = "../images/category/" . $image_name;

                // Upload the new image
                $upload = move_uploaded_file($source_path, $destination_path);

                // Check if the image was successfully uploaded
                if ($upload == false)
                {
                    $_SESSION['upload'] = "<div class='error'> Failed To Upload Image.</div>";
                    header('location:' . SITEURL . 'admin/manage-category.php');
                    exit();
                }

                // Remove the current image if available
                if ($current_image != "") 
                {
                    $remove = unlink('../images/category/' . $current_image);
                    if ($remove == false)
                     {
                        $_SESSION['failed-remove'] = "<div class='error'>Failed To Remove Current Image.</div>";
                        header('location:' . SITEURL . 'admin/manage-category.php');
                        exit();
                    }
                }
            } 
            else 
            {
                $image_name = $current_image;
            }

            // Update the database
            $sql2 = "UPDATE tbl_category SET 
                title='$title',
                image_name='$image_name',
                active='$active',
                featured='$featured' WHERE ID=$id";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) 
            {
                $_SESSION['update'] = "<div class='success'> Category Updated Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            } 
            else
            {
                $_SESSION['update'] = "<div class='error'> Failed To Update Category.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        }
        ?>

    </div>
</div>

<?php include ('partials/footer.php'); ?>
