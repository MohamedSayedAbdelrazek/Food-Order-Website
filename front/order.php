<?php include ('../partials-front/menu.php') ;?>

<!--......................forms........................-->
<?php
if(isset($_GET['id']))
{
    $id=$_GET['id'];
}
else
{
    header('location:'.SITEURL.'front/index.php');
}
?>
    <?php
    $sql="SELECT * FROM tbl_food WHERE ID=$id";
    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);

    if($count==1) {
        //Food Available
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $description=$row['description'];
        $price=$row['price'];
        $image_name=$row['image_name'];
    } 
    else {
        // Food Not Available 
        header('location:'.SITEURL.'front/index.php');
    }

?>


<div class="forms">

<h2 class="h2form">Fill this form to confirm your order.</h2>
</br>

<div class="for1">
<form action="" method="POST" class="form">
    <fieldset>
<legend>Selected Food</legend>
</br></br></br>
<div class="cont">
    
<div class="forimg">
    <?php
    if($image_name=="")
    {
        echo "<div class='error'> Image Not Available.</div>";
    }
    else
    {
        ?>
 <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>"  id="imgfor">
        <?php
    }
    ?>
   
</div>

<div class="text">
<h3 class="h3for1"><?php echo $title;?></h3>
<br></br>
<p class="pfor">$<?php echo $price;?></p>
<br>
<h3 class="h3for12">Quantity</h3>
<br>
    <input type="number" value="1" name='qty' required class="inpt">
</div>
</div>
    </fieldset>

<div class="for2">
<fieldset class="field">
<legend>Delivery Details</legend>
</br>
<h4 class="h4for2">Full Name</h4>
<input type="text" name='full_name' placeholder="your name" class="inpt2">

<h4 class="h4for2">Phone Number</h4>
<input type="tel" name='phone'placeholder="your phone" class="inpt2">

<h4 class="h4for2">Email</h4>
<input type="email" name='email' placeholder="your phone" class="inpt2">

<h4 class="h4for2">Address</h4>
<textarea name="address" id="txt" cols="30" rows="7" placeholder="E.g. Street, city, country"></textarea>

<br>
<input type="submit" name='submit'value="Confirm Order" class="btn">

</fieldset>

</form>
</div>
</div>
</div>
<?php
if(isset($_POST['submit'])) {
    $qty=$_POST['qty'];
    $full_name=filter_var($_POST['full_name'],FILTER_SANITIZE_STRING); 
    $phone=filter_var($_POST['phone'],FILTER_SANITIZE_NUMBER_INT); 
    $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL); 
    $address=filter_var($_POST['address'],FILTER_SANITIZE_STRING); 
    $order_date=date("y-m-d h:i:sa");
    $status="Ordered";     // Ordered , on Delivery , Delivered , Cancelled
    $sql2="INSERT INTO tbl_order SET 
      food='$title',
      price=$price,
      qty=$qty,
      total=$qty*$price,
      order_date='$order_date',
      status='$status',
      customer_name='$full_name',
      customer_contact='$phone',
      customer_email='$email',
      customer_address='$address'";

      $res2=mysqli_query($conn,$sql2);

      if($res2==true) {
        //Query Executed & Order Saved
        $_SESSION['order']="<div class='success text-center'> Food Ordered Successfully.</div>";
        header('location:'.SITEURL."front/index.php");

      }
      else {
        //Failed To Save Order
        $_SESSION['order']="<div class='error'>Failed To Order Food</div>";
        header('location:'.SITEURL."front/index.php");
      }

     
}
?>


<?php include ('../partials-front/footer.php'); ?>