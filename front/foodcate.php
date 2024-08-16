<?php include ('../partials-front/menu.php') ;?>
            <!--.......................results......................-->
            <div class="search">
             <p class="psear">Foods on Your Search</p>  <span class="spsear">   <a href="#" class="text-white " >"<?php echo $_POST['search'];?>"</a></span>
           
            </form>
            </div>
            <!--.........................................................-->
            <div class="foodmenu">
                <h2 class="h2menu">Food Menu</h2>



                <?php
                if($_SERVER['REQUEST_METHOD']=='POST')
                 {
                     //Protect Us From SQL Injection By make any special character as a part of a string
                    $search=mysqli_real_escape_string($conn,$_POST['search']);
                   
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
                            $evaluation_name=$row['evaluation_name'];
                            ?>
                           <div class="pictur1">
                                   
                                        <?php
                                        if($image_name=="")  {
                                            echo"<div class='error'>Image Not Added.</div>";
                                        }
                                        else {
                                            ?>
                                            
                                             <img src="<?php echo SITEURL?>images/food/<?php echo $image_name;?>" class="imgmenu1">
                                             
                                            <?php
                                        }
                                        ?>
                                      
                                  
                                  
                                    <div class="tex_men1">
                                    <h4 class="h4menu"><?php echo $title;?></h4>
                                    <br>
                                    <?php
                                    if($evaluation_name==""){
                                        echo "<div class='error'>Evaluation Image Not Added.</div>";
                                    }
                                    else 
                                    {
                                        ?>
                                <img src="<?php echo SITEURL;?>images/food/food-evaluation/<?php echo $evaluation_name;?>" class="imgmen" >
                                <?php
                                    }
                                    ?>
                                    <p class="price">$<?php echo $price?></p>
                                    
                                    <p class="discribe"><?php echo $description; ?></p>
                                    <br>
                                    <a href="order.php?id=<?php echo $id;?>"><button class="bu_order">Order Now</button></a>
                                    
                                    </div>
                                    </div>
                            <?php
                        endwhile;
                    }
                    else {
                        echo "<div class='error'>Food Not Found.</div>";
                    }
                    
                }
                ?>


               
                
                   <p class="text-center">
                <a href="#">See All Food</a>
                   </p>
                </div>
                </div>
                
                <?php include ('../partials-front/footer.php'); ?>