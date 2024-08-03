<?php include ('../partials-front/menu.php') ;?>

<h1>Explore Foods</h1>
<?php
//Display All Categories That Are Active
$sql="SELECT * FROM tbl_category WHERE active='Yes'";
$res=mysqli_query($conn, $sql);
$count=mysqli_num_rows($res);

if($count>0) {
//Categories Available
while($row=mysqli_fetch_assoc($res)):
    $id=$row['ID'];
    $title=$row['title'];
    $image_name=$row['image_name'];
    if($image_name==""){
        echo "<div class='error'>Image Not Found.</div>";
    }
    else {
?>
<div class="cont">
<div class="img">

        <a href="<?php echo SITEURL?>front/category-food.php?search=<?php echo $title;?>"><img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" class="imge1"></a>
    </div>
    <div class="h3">
    <h3><?php echo $title?></h3>
    </div>
    
    </div>
    
<?php
    }
endwhile;
}
else{
    //Categories Not Availble
echo "<div class='error'>Category Not Found.</div>";
}

?>

<?php include ('../partials-front/footer.php'); ?>