<?php include ('../partials-front/menu.php') ;?>
<!--...................sec2.................-->

<div class="search">
    <form action="<?php echo SITEURL;?>front/foodcate.php" method="POST">
<input type="text"   name='search' placeholder="Search for food.." required id="field" class="input1">
<input type="submit" name='submit' value="Search" class="but1" >
</form>
</div>

<!--............................menu...................................................-->
<div class="foodmenu">
<h2 class="h2menu">Food Menu</h2>
<?php
//Display All Foods that are Active 
$sql="SELECT * FROM tbl_food WHERE active='Yes'";
$res=mysqli_query($conn,$sql);
$count=mysqli_num_rows($res);

if($count>0) {
//Foods Available 
        while($row=mysqli_fetch_assoc($res)):
            $id=$row['ID'];
            $title=$row['title'];
            $description=$row['description'];
            $price=$row['price'];
            $image_name=$row['image_name'];
            $evaluation_name=$row['evaluation_name'];
            ?>
            <div class="pictur1">
<div class="img_menu1">

<img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="<?php echo 'Image Not Added.'?>" class="imgmenu1">

</div>
<div class="tex_men1">
<h4 class="h4menu"><?php echo $title;?></h4>
<br>
<img src="<?php echo SITEURL ; ?>images/food/food-evaluation/<?php echo $evaluation_name?>" alt="Evaluation Image Not Available."  class="imgmen">

<p class="price">$<?php echo $price ;?></p>

<p class="discribe"> <?php echo $description; ?></p>
<br>
<a href="order.php?id=<?php echo $id;?>"><button class="bu_order">Order Now</button></a>

</div>
</div>
            <?php

        endwhile;
}
else {
    //Foods Not Available 
    echo "<div class='error'>Food Not Found.</div>";
}

?>


   <p class="text-center">
<a href="#">See All Food</a>
   </p>
</div>

</div>

<?php include ('../partials-front/footer.php'); ?>