<?php 
$pageName='Update Order';
include ('partials/menu.php');
?>
<?php
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql="SELECT * FROM tbl_order WHERE ID=$id";
    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);
    if($count==1)
    {
        $row=mysqli_fetch_assoc($res);
        $food=$row['food'];
        $price=$row['price'];
        $qty=$row['qty'];
        $status=$row['status'];
        $custmoer_name=$row['customer_name'];
        $custmoer_contact=$row['customer_contact'];
        $custmoer_email=$row['customer_email'];
        $custmoer_address=$row['customer_address'];
    }
    else 
    {
        //Detailes Are Not Available
        header('location:'.SITEURL.'admin/manage-order.php');
    }
   
}
else
{
    header('location:'.SITEURL.'admin/manage-order.php');
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update order</h1>
</br></br>
<form action="" method="POST">
    <table class="tbl-30">

      <tr>
        <td>Food Name : </td>
        <td> <b><?php echo $food;?> </b></td>
      </tr>

      <tr>
        <td>Price : </td>
        <td><b>$<?php echo $price;?></b> </td>
        
      </tr>

       <tr>
        <td>Quantity : </td>
        <td><input type="number" name="qty" value="<?php echo $qty;?>"></td>
       </tr>

      <tr>
        <td>Status : </td>
        <td>
        <select name="status">
        <option   <?php if($status=='Ordered'){echo "selected";}?> value="Ordered">Ordered</option>
        <option <?php if($status=='On Delivery'){echo "selected";}?> value="On Delivery">On Delivery</option>
        <option  <?php if($status=='Delivered'){echo "selected";}?> value="Delivered">Delivered</option>
        <option  <?php if($status=='Cancelled'){echo "selected";}?> value="Cancelled">Cancelled</option>
        </select>
        </td>
      </tr>


      <tr>
        <td>Customer Name : </td>
        <td> <input type="text" name="customer_name" value="<?php echo $custmoer_name;?>"></td>
      </tr>

      <tr>
        <td>Customer contact : </td>
        <td> <input type="text" name="customer_contact" value="<?php echo $custmoer_contact;?>"></td>
      </tr>

    

      <tr>
        <td>Customer email : </td>
        <td> <input type="email" name="customer_email" value="<?php echo $custmoer_email;?>"></td>
      </tr>


      <tr>
        <td>Customer address : </td>
        <td> <textarea rows="" cols="30"name="customer_address" > <?php echo $custmoer_address;?></textarea> </td>
      </tr>


      <tr>
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="hidden" name="price" value="<?php echo $price;?>">
        <td colspan="2"> <input type="submit" name="submit" value="update order" class='btn-secondary'></td>
      </tr>
    </table>
</form>
    </div>
</div>
<?php
if(isset($_POST['submit']))
{
    $id=$_POST['id'];
    $price=$_POST['price'];
    $qty=$_POST['qty'];
    $total=$price * $qty;
    $status=$_POST['status'];
    $custmoer_name=filter_var($_POST['customer_name'],FILTER_SANITIZE_STRING); 
    $custmoer_contact=filter_var( $_POST['customer_contact'],FILTER_SANITIZE_NUMBER_INT);
    $custmoer_email=filter_var($_POST['customer_email'],FILTER_SANITIZE_EMAIL); 
    $custmoer_address=filter_var($_POST['customer_address'],FILTER_SANITIZE_STRING); 

    $sql2="UPDATE tbl_order SET 
    qty=$qty,
    total=$total,
    status='$status',
    customer_name='$custmoer_name',
    customer_contact='$custmoer_contact',
    customer_email='$custmoer_email',
    customer_address='$custmoer_address'
    WHERE ID =$id";

    $res2=mysqli_query($conn,$sql2);

    if($res2)
    {
        $_SESSION['update']="<div class='success'>Order Updated Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }
    else 
    {
        $_SESSION['update']="<div class='error'>Failed To Update Order.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }
}
?>
<?php include ('partials/footer.php'); ?>