<?php include ('../partials-front/menu.php') ;?>
<?php
if(!(isset($_GET['search'])))
 {
    header('location:'.SITEURL.'front');
}

?>
            <!--.......................results......................-->
            <div class="search">
             <p class="psear">Foods on</p>  <span class="spsear">   <a href="#" class="text-white " >"<?php echo $_GET['search'];?>"</a></span>
           
            </form>
            </div>
            <!--.........................................................-->
            <div class="foodmenu">
                <h2 class="h2menu">Food Menu</h2>



                <?php
                
                    $search=$_GET['search'];

                    $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
                    $res=mysqli_query($conn,$sql);
                    $count=mysqli_num_rows($res);

                    if($count>0) {
                        while($row=mysqli_fetch_assoc($res)):
                            $id=$row['ID'];
                            $title=$row['title'];
                            $price=$row['price'];
                            $description=$row['description'];
                            $image_name=$row['image_name'];
                            ?>
                                 <div class="pictur1">
                                   
                                        <?php
                                        if($image_name=="")  {
                                            echo"<div class='error'>Image Not Available .</div>";
                                        }
                                        else {
                                            ?>
                                             <div class="img_menu1">
                                             <img src="<?php echo SITEURL?>images/food/<?php echo $image_name;?>" class="imgmen">
                                             </div>
                                            <?php
                                        }
                                        ?>
                                  
                                  
                                    <div class="tex_men1">
                                    <h4 class="h4menu"><?php echo $title;?></h4>
                                    <br>
                                    <p class="price">$<?php echo $price?></p>
                                    
                                    <p class="discribe"><?php echo $description; ?></p>
                                    <br>
                                    <a href="<?php echo SITEURL;?>front/order.php?id=<?php echo $id;?>">
                                        <input type="submit" value="Order Now" class='bu_order'>
                                        
                                    </a>
                                    
                                    </div>
                                    </div>
                            <?php
                        endwhile;
                    }
                    else {
                        echo "<div class='error'>Food Not Found.</div>";
                    }
                    
                
                ?>


               
                
                   <p class="text-center">
                <a href="#">See All Food</a>
                   </p>
                </div>
                </div>
                
                <?php include ('../partials-front/footer.php'); ?>