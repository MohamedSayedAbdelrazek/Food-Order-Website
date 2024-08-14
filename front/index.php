<?php include ('../partials-front/menu.php') ;?>


<!--...................sec2.................-->
<div class="search">
    <form action="<?php echo SITEURL;?>front/foodcate.php" method="POST">
<input type="text" name ="search" placeholder="Search for food.." required id="field" class="input1">
<input type="submit" name="submit"  value="Search" class="but1" >
</form>
</div>

<?php
if(isset($_SESSION['order']))
{
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>
<!---..............sec3............-->
<h1 id="h1sec3">Explore Foods</h1>
<div class="sec3">
<?php
    //Create SQL QUERY TO DISPLAY CATEGORIES FROM DATABASE
    $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count > 0) {
        // We Have Categories
        while ($row = mysqli_fetch_assoc($res)):
            $id = $row['ID'];
            $title = $row['title'];
            $image_name = $row['image_name'];
                ?>
           <a href="<?php echo SITEURL?>front/category-food.php?search=<?php echo $title;?>">
            <div class="box-3 float-container">
                <?php
                if($image_name=="")
                {
                    echo "<div class='error'>Image Not Available.</div>";
                }
                else
                {
                    //Image Available
                    ?>
                      <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve" >
                    <?php
                }
                ?>
                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
            </a>              
                <?php
        endwhile;
    }
    else 
    {
        // We Don't Have Any Category Available
        echo "<div class='error'>Category Not Added.</div>";
    }
?>
</div>

</div>

<!--............................menu...................................................-->
<div class="foodmenu">
<h2 class="h2menu">Food Menu</h2>
<?php
//Getting Foods From DataBase That Are Active & Featured
$sql2="SELECT * FROM tbl_food WHERE featured='Yes' and active='Yes' LIMIT 6";
$res2=mysqli_query($conn,$sql2);
$count2=mysqli_num_rows($res2);
if($count2>0) {
    while($row=mysqli_fetch_assoc($res2)):
        $id=$row['ID'];
        $title=$row['title'];
        $description=$row['description'];
        $price=$row['price'];
        $image_name=$row['image_name'];
        $evaluation_name=$row['evaluation_name'];
        ?>

        <div class="pictur1">


<img src="<?php echo SITEURL ; ?>images/food/<?php echo $image_name?>" alt="Image Not Available."  class="imgmenu1">
 

<div class="tex_men1">
<h4 class="h4menu"><?php echo $title;?></h4>
<br>

<img src="<?php echo SITEURL ; ?>images/food/food-evaluation/<?php echo $evaluation_name?>" alt="Evaluation Image Not Available."  class="imgmen">

<p class="price">$<?php echo $price; ?></p>

<p class="discribe"><?php echo $description; ?></p>
<br>
<a href="order.php?id=<?php echo $id;?>"><button class="bu_order">Order Now</button></a>

</div>
</div>
<?php
    endwhile;
}
else {
    // We Don't Have Food Available
    echo "<div class='error'>No Foods Available.</div>";
}
?>

    
   <p class="text-center">
<a href="#">See All Food</a>
   </p>
</div>

</div>

<?php include ('../partials-front/footer.php'); ?> 