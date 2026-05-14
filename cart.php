<!--connect file-->
<?php

include('includes/connect.php');
include('function/common_function.php');
session_start();
if (!isset($_SESSION['username'])) {
   header("Location: ./user_area/user_login.php");
    exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce website-cart-detalis</title>
    <!--bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" /><body>

    <!--css file link-->
    <link rel="stylesheet" href="style.css">
     <style>
      body{
      overflow-x:hidden;
      }
    </style>
    <style>
        /* cart_image */
.cart_img{
    width: 80px;
    height: 80px;
    object-fit: contain;
}
    </style>
</head>
    <body>
   <!--navber-->
   <div class="container-fluid p-0">
    <!---first child-->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
    <img src="./image/logo.png" alt="" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">products</a>
        </li>
        <?php
        if(isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link' href='./user_area/profile.php'>My Account</a>
        </li>";
        }else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='./user_area/user_registration.php'>Register</a>
        </li>";
        }
        ?>
        <li class="nav-item">
          <a class="nav-link" href="#">contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class='fa-solid fa-cart-shopping'></i><sup><?php cart_item(); ?></sup></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!--calling cart function-->
<?php
cart();
?>
<section>
<!--second child-->
<nav class="navbar navbar-expand-lg navbar-dark bg-blue">
    <ul class="navbar-nav me-auto">
     <?php
     if(!isset($_SESSION['username'])){
            echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Wellcome Guest</a>
        </li>";
        }else{
            echo "<li class='nav-item'>
            <a class='nav-link' href='#'>wellcome ".$_SESSION['username']."</a>
        </li>";
        }
        if(!isset($_SESSION['username'])){
            echo "<li class='nav-item'>
            <a class='nav-link' href='./user_area/user_login.php'>Login</a>
        </li>";
        }else{
            echo "<li class='nav-item'>
            <a class='nav-link' href='./user_area/logout.php'>Logout</a>
        </li>";
        }
        ?>
    </ul>
</nav>


<!--third child-->
<div class="bg-blue text-light">
    <h3 class="text-center"> &/Home page\&</h3>
    <p class="text-center">Communication is at the heart of e-commerce and community</p>
</div>

<!--forth child-->
<div class="container">
    <div class="row">
    <form action="" method="post">
        <table class="table table-brodered text-center">
            <tbody>
              <!-- php code to display dynamic data -->
               <?php 
               global $con;
  $ip = getIPAddress();
  $total_price=0;
  $cart_query="select * from `cart_detalis` where ip_address='$ip'";
  $result=mysqli_query($con,$cart_query);
  $result_count=mysqli_num_rows($result);
  if($result_count>0){
    echo "<thead>
                <tr>
                    <th>product Title</th>
                    <th>product image</th>
                    <th>Quantity</th>
                    <th>total price</th>
                    <th>Remove</th>
                    <th colspan='2'>operattions</th>
                </tr>
            </thead>";
  while($row=mysqli_fetch_array($result)){
    $product_id=$row['product_id'];
    $select_products="select * from `products` where product_id='$product_id'";
    $result_products=mysqli_query($con,$select_products);
  while($row_product_price=mysqli_fetch_array($result_products)){
    $product_price=array($row_product_price['product_price']);
    $price_table=$row_product_price['product_price'];
    $product_title=$row_product_price['product_title'];
    $product_Image1=$row_product_price['product_Image1'];
    $product_values=array_sum($product_price);
    $total_price+=$product_values;

$get_cart="Select * from `cart_detalis` where ip_address='$ip' and product_id='$product_id'";
$run_cart=mysqli_query($con,$get_cart);
$get_item_quantity=mysqli_fetch_array($run_cart);
$quantity=$get_item_quantity['quanthy'];

// agar quantity 0 ya empty ho to default 1 rakho
if($quantity==0){
    $quantity=1;
}

 
               ?>
                <tr>
                    <td><?php echo $product_title ?></td>
                    <td><img src="./admin_area/product_images/<?php echo $product_Image1 ?>" alt="" class="cart_img"></td>
                    <td><input type="text" name="qty" class="form-input w-50" value="<?php echo $quantity; ?>"></td>
                    <?php
                     $ip = getIPAddress();
                     if(isset($_POST['update_cart'])){
                     $quantities=$_POST['qty'];
                    $update_cart="update `cart_detalis` set quanthy=$quantities where ip_address='$ip' AND product_id=$product_id";
                    $result_products_quantity=mysqli_query($con,$update_cart);
                    $total_price=$price_table*$quantities; 
                    }

                    ?>
                    <td><?php echo $price_table ?>/-</td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id?>"></td>
                    <td><!--<button class="bg-black px-3 mx-3 text-light">Update</button>-->
                    <input type="submit" value="Update cart" class="bg-black px-3 mx-3 text-light" name="update_cart">
                    <!--<button class="bg-black px-3 mx-3 text-light">Remove</button></td>-->
                    <input type="submit" value="Remove card" class="bg-black px-3 mx-3 text-light" name="Remove_card">
                </tr>
                <?php
                 }}}
                 else{
                    echo "<h2 class='text-center text-danger'>card is empty</h2>";
                 }
                ?>
            </tbody>
        </table>
        <!-- subtotal-->
         <div class="text-black d-flex mb-3 ">
            <?php
             $ip = getIPAddress();
             $cart_query="select * from `cart_detalis` where ip_address='$ip'";
             $result=mysqli_query($con,$cart_query);
             $result_count=mysqli_num_rows($result);
             if($result_count>0){
            echo "<h4 class='px-3 bg-black text-light '>subtotal:<strong>$total_price /-</strong></h4>;
            <input type='submit' value='continue sopping' class='bg-black px-3 mx-3 text-light' name='continue_sopping'>;
            <input type='submit' value='checkout' class='bg-black px-3 text-light' name='checkout'>";
             }
             else{
                echo "<input type='submit' value='continue sopping' class='bg-black px-3 mx-3 text-light' name='continue_sopping'>";
             }
             if(isset($_POST['continue_sopping'])){
                echo "<script>window.open('index.php','_self')</script>";
             }
             if(isset($_POST['checkout'])){
                echo "<script>window.open('./user_area/checkout.php','_self')</script>";
             }
            ?>
            
         </div>
    </div>
</div>
</form>

<!-- function to remove item -->
 <?php
 function Remove_card_item(){
    global $con;
    if(isset($_POST['Remove_card'])){
        foreach ($_POST['removeitem'] as $remove_id) {
            echo $remove_id;
            $delete_query="delete from `cart_detalis` where product_id=$remove_id";
            $run_delete=mysqli_query($con,$delete_query);
            if($run_delete){
                echo "<script> window open('cart.php','_self')</script>";
            }
        }
    }
 }
 echo $remove_item=Remove_card_item();
 ?>

<!--last child-->
<!--include footer-->
<?php
include("./includes/footer.php");
?>
   </div>




</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>