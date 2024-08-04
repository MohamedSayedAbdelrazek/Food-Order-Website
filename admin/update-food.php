<?php
ob_start(); // Start output buffering
$pageName='Update Food';
include('partials/menu.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Food</title>
</head>
<body>
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Category</h1>
            </br></br>
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_food WHERE ID = $id";
                $res = mysqli_query($conn, $sql);

                if ($res) {
                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $current_image = $row['image_name'];
                    $category_id = $row['category_id'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                } else {
                    $_SESSION['fetch-failed'] = "<div class='error'>Failed to fetch data.</div>";
                    header('location: ' . SITEURL . 'admin/manage-food.php');
                    ob_end_flush();
                    exit();
                }
            } else {
                header('location: ' . SITEURL . 'admin/manage-food.php');
                ob_end_flush();
                exit();
            }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class='tbl-30'>
                    <tr>
                        <td>Title : </td>
                        <td><input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>"></td>
                    </tr>

                    <tr>
                        <td>Description : </td>
                        <td><textarea name="description" cols="20" rows="5"><?php echo htmlspecialchars($description); ?></textarea></td>
                    </tr>

                    <tr>
                        <td>Price : </td>
                        <td><input type="number" name="price" value="<?php echo htmlspecialchars($price); ?>"></td>
                    </tr>

                    <tr>
                        <td>Current Image : </td>
                        <td>
                            <?php
                            if ($current_image != "") {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo htmlspecialchars($current_image); ?>" width="100px" alt="<?php echo htmlspecialchars($title); ?>">
                                <?php
                            } else {
                                echo "<div class='error'>Image Not Available.</div>";
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New Image : </td>
                        <td><input type="file" name="new_image"></td>
                    </tr>

                    <tr>
                        <td>Category : </td>
                        <td>
                            <select name="category">
                                <?php
                                $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res2 = mysqli_query($conn, $sql2);
                                $count = mysqli_num_rows($res2);

                                if ($count > 0) {
                                    while ($row = mysqli_fetch_assoc($res2)) {
                                        $ca_id = $row['ID'];
                                        $ca_title = $row['title'];
                                        ?>
                                        <option value="<?php echo $ca_id; ?>" <?php if ($category_id == $ca_id) { echo "selected"; } ?>><?php echo htmlspecialchars($ca_title); ?></option>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option value="0">Category Not Available</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured : </td>
                        <td>
                            <input type="radio" name="featured" <?php if ($featured == 'Yes') { echo "checked"; } ?> value="Yes">Yes
                            <input type="radio" name="featured" <?php if ($featured == 'No') { echo "checked"; } ?> value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active : </td>
                        <td>
                            <input type="radio" name="active" <?php if ($active == 'Yes') { echo "checked"; } ?> value="Yes">Yes
                            <input type="radio" name="active" <?php if ($active == 'No') { echo "checked"; } ?> value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($current_image); ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" value="Update Category" name="submit" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
            if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $active = $_POST['active'];
                $featured = $_POST['featured'];

                if (isset($_FILES['new_image']['name']) && $_FILES['new_image']['name'] != "") {
                    $image_name = $_FILES['new_image']['name'];
                    $image_name_parts = explode('.', $image_name);
                    $ext = end($image_name_parts);
                    $image_name = uniqid("Food-Name-", true) . "." . $ext;

                    $source_path = $_FILES['new_image']['tmp_name'];
                    $destination_path = "../images/food/" . $image_name;

                    $upload = move_uploaded_file($source_path, $destination_path);

                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed To Upload New Image.</div>";
                        header('location: ' . SITEURL . 'admin/manage-food.php');
                        ob_end_flush();
                        exit();
                    }

                    // Remove current image if available
                    if ($current_image != "" && file_exists('../images/food/' . $current_image)) {
                        $remove = unlink('../images/food/' . $current_image);
                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed To Remove Current Image.</div>";
                            header('location: ' . SITEURL . 'admin/manage-food.php');
                            ob_end_flush();
                            exit();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }

                $sql3 = "UPDATE tbl_food SET 
                title='$title',
                description='$description',
                price='$price',
                image_name='$image_name',
                category_id='$category',
                active='$active',
                featured='$featured'
                WHERE ID=$id";

                $res3 = mysqli_query($conn, $sql3);

                if ($res3) {
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                    header('location: ' . SITEURL . 'admin/manage-food.php');
                } else {
                    $_SESSION['update'] = "<div class='error'>Failed To Update Food.</div>";
                    header('location: ' . SITEURL . 'admin/manage-food.php');
                }
                ob_end_flush();
                exit();
            }
            ?>
        </div>
    </div>
</body>
</html>
<?php
ob_end_flush(); // Flush the output buffer
include('partials/footer.php');
?>
